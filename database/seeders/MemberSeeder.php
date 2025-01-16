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
            'nama' => 'member',
            'alamat' => 'xxx',
            'telepon' => '0859',
            'email' => 'member@gmail.com',
            'password' => Hash::make('member1234'),
            'jenis' => 'member'
        ]);
    }
}
