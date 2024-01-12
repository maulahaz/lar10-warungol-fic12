<?php

namespace Database\Seeders;

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
        \App\Models\User::create([
            'name' => 'Web Dev',
            'email' => 'webdev@email.com',
            'password' => Hash::make('1234qwer'),
            'roles' => 'webdev',
            'phone' => '081234567000',
        ]);

        \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            'password' => Hash::make('1234qwer'),
            'roles' => 'admin',
            'phone' => '081234567999',
        ]);

        \App\Models\User::create([
            'name' => 'Member One',
            'email' => 'member1@email.com',
            'password' => Hash::make('1234qwer'),
            'roles' => 'member',
            'phone' => '081234567555',
        ]);

        \App\Models\User::factory(10)->create();
    }
}
