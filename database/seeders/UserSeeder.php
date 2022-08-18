<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin =   User::create([
            'name' => 'Johan Nasendi',
            'slug' => 'johan-nasendi',
            'email' => 'johannasendi@gmail.com',
            'password' => bcrypt('admin123'),
            'photo' => 'default.png',
        ]);
        $admin->attachRole('admin');

       $admin =   User::create([
            'name' => 'Iqbal',
            'slug' => 'iqbal',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123'),
            'photo' => 'default.png',
        ]);
        $admin->attachRole('user');
    }
}
