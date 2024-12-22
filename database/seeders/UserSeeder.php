<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama'=>'admin',
            'alamat'=>'xxx',
            'telepon'=>'0859',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('admin1234'),
            'jenis'=>'admin'
        ]);
    }
}
