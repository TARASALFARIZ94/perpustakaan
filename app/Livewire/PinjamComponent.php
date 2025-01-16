<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PinjamComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $id, $user, $buku, $tgl_peminjaman, $tgl_pengembalian, $cari;
    public function render()
    {
        $data['member'] = User::where('jenis', 'admin')->get();
        $data['book'] = Buku::all();
        $data['pinjam'] = Pinjam::paginate(10);
        $layout['title'] = 'Borrow Books';

        if ($this->cari != "") {
            $data['pinjam'] = Pinjam::whereHas('buku', function ($query) {
                $query->where('judul', 'like', '%' . $this->cari . '%');
            })->paginate(10);
        } else {
            $data['pinjam'] = Pinjam::paginate(10);
        }

        return view('livewire.pinjam-component', $data)->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'buku' => 'required',
            'user' => 'required'
        ], [
            'buku.required' => 'Book Title Cannot Be Empty!',
            'user.required' => 'Member Name Cannot Be Empty!'
        ]);

        $this->tgl_peminjaman = date('Y-m-d');
        $this->tgl_pengembalian = date('Y-m-d', strtotime($this->tgl_peminjaman . '+7 days'));

        Pinjam::create([
            'user_id' => $this->user,
            'buku_id' => $this->buku,
            'tgl_peminjaman' => $this->tgl_peminjaman,
            'tgl_pengembalian' => $this->tgl_pengembalian,
            'status' => 'pinjam'
        ]);
        $this->reset();
        session()->flash('success', 'Success');
        return redirect()->route('pinjam');
    }

    public function edit($id)
    {
        $pinjam = Pinjam::find($id);
        $this->id = $pinjam->id;
        $this->user = $pinjam->user_id;
        $this->buku = $pinjam->buku_id;
        $this->tgl_peminjaman = $pinjam->tgl_peminjaman;
        $this->tgl_pengembalian = $pinjam->tgl_pengembalian;
    }

    public function update()
    {
        $kategori = Pinjam::find($this->id);
        $this->tgl_peminjaman = date('Y-m-d');
        $this->tgl_pengembalian = date('Y-m-d', strtotime($this->tgl_peminjaman . '+7 days'));
        $kategori->update([
            'user_id' => $this->user,
            'buku_id' => $this->buku,
            'tgl_peminjaman' => $this->tgl_peminjaman,
            'tgl_pengembalian' => $this->tgl_pengembalian,
            'status' => 'pinjam'
        ]);
        $this->reset();
        session()->flash('success', 'Successfully updated!');
        return redirect()->route('pinjam');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $pinjam = Pinjam::find($this->id);
        $pinjam->delete();
        $this->reset();
        session()->flash('success', 'Successfully deleted!');
        return redirect()->route('pinjam');
    }
}