<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Petugas BPJS'],
            ['name' => 'Pimpinan'] // Tambahan
        ];
        foreach ($roles as $role) {
            Roles::create($role);
        }
        // Create User
        User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'contact' => '082202020202',
            'role_id' => 1,
            'email' => 'admin@example.com',
            'jenis_kelamin' => 'Laki-Laki',
            'email_verified_at' => now(),
            'password' => Hash::make('123'), // Ganti dengan password yang aman
            'remember_token' => Str::random(10),
        ]);
        // petugas
        User::create([
            'name' => 'Petugas',
            'username' => 'Petugas BPJS',
            'contact' => '081234567890',
            'role_id' => 2, // Pimpinan
            'email' => 'petugas@example.com',
            'jenis_kelamin' => 'Laki-Laki',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
        ]);
        // Pimpinan
        User::create([
            'name' => 'Pimpinan',
            'username' => 'Pimpinan',
            'contact' => '081234567890',
            'role_id' => 3, // Pimpinan
            'email' => 'pimpinan@example.com',
            'jenis_kelamin' => 'Laki-Laki',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
        ]);
    }
}
