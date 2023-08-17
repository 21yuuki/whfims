<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class FirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(
            [
                'name' => 'Administrator',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Employee',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        User::create([
            'role_id' => 1,
            'name' => 'Mhiko Patos',
            'email' => 'mhikoleeps@gmail.com',
            'password' => 'secret',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
