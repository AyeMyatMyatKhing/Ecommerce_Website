<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,HasSlug,SoftDeletes;

    protected $fillable = [
        'title','description','price','published','image','image_mime','image_size','created_by','updated_by'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                ->generateSlugsFrom('title')
                ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
