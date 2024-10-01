<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Define the fillable attributes
    protected $fillable = ['title', 'author', 'description', 'language', 'file_path', 'cover_image', 'tags'];
}