<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Membercomponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';   
    public $nama, $telepon, $email, $address, $password, $cari, $id;
    public function render()
    {   
        if($this->cari !=""){
            $data['member'] = User::where('name','like','%'.$this->cari.'%')
            ->paginate(10);  
        }else{
            $data['member'] = User::where('jenis','member')->paginate(10);
        }
        $layout['title'] = 'Manage Member';
        return view('livewire.member-component', $data)->layoutData($layout);
    }
    public function resetInput()
    {
        $this->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
            'address' => 'required',

        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'telepon.required' => 'Telepon tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'address.required' => 'Alamat tidak boleh kosong',
        ]);
        user::create([
            'name' => $this->nama,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'address' => $this->address,
            'jenis' => 'member',
        ]);
        session()->flash('success', 'Data Berhasil Disimpan');
        return redirect()->route('/member');
    }
    public function edit($id)
    {
        $member = User::find($id);
        $this->id = $member->id;
        $this->nama = $member->name;
        $this->telepon = $member->telepon;
        $this->email = $member->email;
        $this->address = $member->address;
    }
    public function update()
    {
        $member = User::find($this->id);
        $member->update([
            'name' => $this->nama,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'address' => $this->address,
            'jenis' => 'member'
        ]);
        session()->flash('success', 'Data Berhasil Diupdate');
        return redirect()->route('member');
    }
    public function confirm($id)
    {
        $this->id = $id;
    }
    public function destroy()
    {
        $member = User::find($this->id);
        $member->delete();
        session()->flash('success', 'Data Berhasil Dihapus');
        return redirect()->route('member');
    }
}
