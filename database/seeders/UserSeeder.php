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
          User::create([
            'name' => 'Johan Nasendi',
            'slug' => 'johan-nasendi',
            'email' => 'test@gmail.com',
            'password' => bcrypt('admin123'),
        ]);
    }
}
