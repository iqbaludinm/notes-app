<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Note::create([
            'user_id' => 1,
            'category_id' => 1,
            'title' => 'List Makanan yang musti dicobain di Malang',
            'content' => 'Mie Bakar Celaket, Ketan Susu Djoeang',
        ]);
    }
}
