<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
           'user_id' => 1,
           'name' => 'Catatan Harian',
           'slug' => 'catatan-harian',
        ]);
        
        Category::create([
           'user_id' => 1,
           'name' => 'Catatan Kuliah',
           'slug' => 'catatan-kuliah',
        ]);
    }
}