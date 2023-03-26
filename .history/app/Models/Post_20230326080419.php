<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// Usando spatie
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

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
