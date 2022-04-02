<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $admin = new User();
        $admin->name = "Admin";
        $admin->email = "admin@admin.com";
        $admin->role = "admin";
        $admin->password = Hash::make('admin123@');
        $admin->save();
    }
}
