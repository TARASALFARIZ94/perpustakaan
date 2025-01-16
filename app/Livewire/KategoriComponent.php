<?php

namespace App\Livewire;

use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithPagination;

class KategoriComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $nama, $kategori_id, $deskripsi, $cari;

    protected $listeners = ['resetForm'];

    public function render()
    {
        $kategori = $this->cari != "" ?
            Kategori::where('nama', 'like', '%' . $this->cari . '%')->paginate(10) :
            Kategori::paginate(10);

        return view('livewire.kategori-component', [
            'kategori' => $kategori
        ]);
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        Kategori::create([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi
        ]);

        $this->reset(['nama', 'deskripsi']);
        session()->flash('success', 'Category successfully saved!');
    }

    public function edit($kategori_id)
    {
        $kategori = Kategori::find($kategori_id);
        $this->kategori_id = $kategori->id;
        $this->nama = $kategori->nama;
        $this->deskripsi = $kategori->deskripsi;
    }

    public function update()
    {
        $kategori = Kategori::find($this->kategori_id);
        $kategori->update([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi
        ]);
        session()->flash('success', 'Category successfully updated!');
        $this->reset(['nama', 'deskripsi']);
    }

    public function confirm($kategori_id)
    {
        $this->kategori_id = $kategori_id;
    }

    public function destroy()
    {
        $kategori = Kategori::find($this->kategori_id);
        $kategori->delete();
        session()->flash('success', 'Category successfully deleted!');
    }

    public function resetForm()
    {
        $this->reset(['nama', 'deskripsi', 'kategori_id']);
    }
}