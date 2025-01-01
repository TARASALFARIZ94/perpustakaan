<?php

namespace App\Livewire;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $x['title'] = 'Home Library';
        $data['member']=user::where('jenis','member')->count();
        $data['buku']=buku::count();
        $data['pinjam']=pinjam::where('status','pinjam')->count();
        $data['kembali']=pengembalian::count();
        return view('livewire.home-component', $data)->layoutData($x);
          
    }
}
