<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id', 'title', 'slug', 'content', 'is_published'];

    public function category(){
        //Una post pertenece a una categoria
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        //Un post pertenece a muchos tags
        return $this->belongsToMany(Tag::class);
    }

}
