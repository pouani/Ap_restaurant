<?php

namespace App\Models;

use App\Models\Categorie;
use App\Models\Restaurant;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = ['name', 'price', 'active', 'categorie_id'];
    protected $appends = ["image"];

    public function categories()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function restaurants()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('total_quantity', 'total_price');
    }
    public function getImageAttribute(){
        $image = $this->getFirstMedia('images');
        $this->makeHidden('media');
        return $image;
    }
}
