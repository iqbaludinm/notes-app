<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'user_id'
    ];

    protected $table = "categories";
    
    public function notes ()
    {
        return $this->hasMany(Note::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}