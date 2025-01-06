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
        $layout['title'] = 'Manage User';
        if ($this->search != "") {
            $data['user'] = User::where('nama', 'like', '%' . $this->search . '%')->orwhere('email', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $data['user'] = User::paginate(10);
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

        // Membuat user baru dengan password yang di-hash
        User::create([
            'nama' => $this->nama,
            'email' => $this->email,
            'password' => bcrypt($this->password), // Gunakan bcrypt
            'jenis' => 'admin' // Tentukan jenis user
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

        if (!empty($this->password)) {
            // Jika password diubah, hash dan update
            $user->update([
                'nama' => $this->nama,
                'email' => $this->email,
                'password' => bcrypt($this->password), // Hash password
            ]);
        } else {
            // Jika tidak ada perubahan password, hanya update nama dan email
            $user->update([
                'nama' => $this->nama,
                'email' => $this->email,
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
