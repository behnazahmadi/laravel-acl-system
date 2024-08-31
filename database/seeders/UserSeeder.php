<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(["name" => "Admin"]);
        $editorRole = Role::firstOrCreate(["name" => "Editor"]);
        $writerRole = Role::firstOrCreate(["name" => "Writer"]);
        $normalRole = Role::firstOrCreate(["name" => "Normal"]);

        User::create([
            'name' => 'admin',
            'email' => 'behnaz.ahmadi1996@gmail.com',
            'password' => Hash::make('11111111'),
        ])->assignRole($adminRole);

        User::create([
            'name' => 'editor',
            'email' => 'editor@example.com',
            'password' => Hash::make('11111111'),
        ])->assignRole($editorRole);

        User::create([
            'name' => 'writer',
            'email' => 'writer@example.com',
            'password' => Hash::make('11111111'),
        ])->assignRole($writerRole);

        User::create([
            'name' => 'normal',
            'email' => 'normal@example.com',
            'password' => Hash::make('11111111'),
        ])->assignRole($normalRole);
    }
}
