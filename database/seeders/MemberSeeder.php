<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'nizar',
            'alamat' => 'xxx',
            'telepon' => '0859',
            'email' => 'nizar@gmail.com',
            'password' => Hash::make('nizar1234'),
            'jenis' => 'member'
        ]);
    }
}
