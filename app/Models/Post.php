<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $table="posts";

    protected $fillable=['category_id', 'title', 'body', 'image_url', 'price', 'option'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}