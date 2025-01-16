<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class BukuComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $kategori, $judul, $penulis, $penerbit, $isbn, $tahun, $jumlah, $cari, $id;
    public function render()
    {
        // Fetch books based on search
        if ($this->cari != "") {
            $data['buku'] = Buku::where('judul', 'like', '%' . $this->cari . '%')->paginate(10);
        } else {
            $data['buku'] = Buku::paginate(10);
        }

        // Fetch categories from the database
        $data['category'] = Kategori::all();

        $layout['title'] = 'Manage Books';

        return view('livewire.buku-component', $data)->layoutData($layout);
    }


    public function store()
{
    $this->validate([
        'judul' => 'required',
        'kategori' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'tahun' => 'required',
        'isbn' => 'required',
        'jumlah' => 'required'
    ], [
        'judul.required' => 'Book Title Cannot Be Empty!',
        'kategori.required' => 'Book Category Cannot Be Empty!',
        'penulis.required' => 'Book Author Cannot Be Empty!',
        'penerbit.required' => 'Book Publisher Cannot Be Empty!',
        'tahun.required' => 'Year Of Book Publication Cannot Be Empty!',
        'isbn.required' => 'Book ISBN Number Cannot Be Empty!',
        'jumlah.required' => 'Number Of Books Cannot Be Empty!'
    ]);

    Buku::create([
        'judul' => $this->judul,
        'kategori_id' => $this->kategori,
        'penulis' => $this->penulis,
        'penerbit' => $this->penerbit,
        'tahun' => $this->tahun,
        'isbn' => $this->isbn,
        'jumlah' => $this->jumlah
    ]);

    $this->resetInput(); // Panggil fungsi resetInput di sini
    session()->flash('success', 'Book is successfully saved!');
    return redirect()->route('buku');
}

    public function edit($id)
    {
        $buku = Buku::find($id);
        $this->id = $buku->id;
        $this->judul = $buku->judul;
        $this->kategori = $buku->kategori_id;  // Update to use kategori_id
        $this->penulis = $buku->penulis;
        $this->penerbit = $buku->penerbit;
        $this->tahun = $buku->tahun;
        $this->isbn = $buku->isbn;
        $this->jumlah = $buku->jumlah;
    }


    public function update()
{
    $buku = Buku::find($this->id);
    $buku->update([
        'judul' => $this->judul,
        'kategori_id' => $this->kategori,
        'penulis' => $this->penulis,
        'penerbit' => $this->penerbit,
        'tahun' => $this->tahun,
        'isbn' => $this->isbn,
        'jumlah' => $this->jumlah
    ]);

    $this->resetInput(); // Panggil fungsi resetInput di sini
    session()->flash('success', 'Book is successfully updated!');
    return redirect()->route('buku');
}

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $buku = Buku::find($this->id);
        $buku->delete();
        $this->reset();
        session()->flash('success', 'Book is successfully deleted!');
        return redirect()->route('buku');
    }

    public function resetInput()
{
    $this->judul = null;
    $this->kategori = null;
    $this->penulis = null;
    $this->penerbit = null;
    $this->tahun = null;
    $this->isbn = null;
    $this->jumlah = null;
    $this->cari = null;
    $this->id = null;
}

}