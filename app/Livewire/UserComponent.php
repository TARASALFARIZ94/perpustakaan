<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $nama, $email, $password, $id, $search;
    public function render()
    {
        $layout['title'] = 'Manage Staff';
        if ($this->search != "") {
            $data['user'] = User::where('nama', 'like', '%' . $this->search . '%')->orwhere('email', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $data['user'] = User::where('jenis', 'admin')->paginate(10);
        }
        return view('livewire.user-component', $data)->layoutData($layout);
    }
    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'nama.required' => 'The Name Cannot Be Empty!',
            'email.required' => 'Email Must Be Filled!',
            'email.email' => 'Email Format Was Wrong!',
            'password.required' => 'The Password Cannot Be Empty!'
        ]);
        User::create([
            'nama' => $this->nama,
            'email' => $this->email,
            'password' => $this->password,
            'jenis' => 'admin'
        ]);
        session()->flash('success', 'Success Saved!');
        $this->reset();
        return redirect()->route('user');
    }
    public function edit($id)
    {
        $user = User::find($id);
        $this->nama = $user->nama;
        $this->email = $user->email;
        $this->id = $user->id;
    }
    public function update()
    {
        $user = User::find($this->id);
        if ($this->password == "") {
            $user->update([
                'nama' => $this->nama,
                'email' => $this->email
            ]);
        } else {
            $user->update([
                'nama' => $this->nama,
                'email' => $this->email,
                'password' => $this->password
            ]);
        }
        session()->flash('success', 'Edit Saved!');
        $this->reset();
        return redirect()->route('user');
    }
    public function confirm($id)
    {
        $this->id = $id;
    }
    public function destroy()
    {
        $user = User::find($this->id);
        $user->delete();
        session()->flash('success', 'Success Deleted!');
        $this->reset();
        return redirect()->route('user');
    }
}
