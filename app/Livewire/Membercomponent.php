<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MemberComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $nama, $telepon, $email, $address, $password, $cari, $id;
    public function render()
    {
        if ($this->cari != "") {
            $data['member'] = User::where('name', 'like', '%' . $this->cari . '%')
                ->paginate(10);
        } else {
            $data['member'] = User::where('jenis', 'member')->paginate(10);
        }
        $layout['title'] = 'Manage Member';
        return view('livewire.membercomponent', $data)->layoutData($layout);
    }
    public function edit($id)
    {
        $member = User::find($id);
        $this->id = $member->id;  // Ensure you set the id
        $this->nama = $member->nama;
        $this->address = $member->alamat;
        $this->telepon = $member->telepon;
        $this->email = $member->email;
    }

    public function update()
    {
        $member = User::find($this->id);
        $member->update([
            'nama' => $this->nama,
            'alamat' => $this->address,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'jenis' => 'member'
        ]);
        session()->flash('success', 'Data Successfully Updated');
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
        session()->flash('success', 'Data Successfully Deleted');
        return redirect()->route('member');
    }

    public function resetInput()
    {
        // Validate input, ensure email is unique
        $this->validate([
            'nama' => 'required',
            'address' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:users,email',  // Ensure email is unique
        ], [
            'nama.required' => 'Name is required',
            'address.required' => 'Address is required',
            'telepon.required' => 'Phone Number is required',
            'email.required' => 'Email is required',
            'email.unique' => 'The email has already been taken',  // Custom error message
        ]);

        // Create the user if email is unique
        User::create([
            'nama' => $this->nama,
            'alamat' => $this->address,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'jenis' => 'member',
        ]);

        session()->flash('success', 'Data Successfully Saved');
        return redirect()->route('member');
    }
}