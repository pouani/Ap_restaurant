<?php

namespace App\Models;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = ['name', 'price', 'active', 'categorie_id'];
    protected $appends = ["image"];

    public function categories()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('total_quantity', 'total_price');
    }

    public function getImageAttribute(){
        if ($this->getFirstMedia('images')) {
            $arrayLinks = explode("public\\", $this->getFirstMedia('images')->getPath());
            $link = Storage::url($arrayLinks[count($arrayLinks) - 1]);
          } else {
            return null;
          }
          $this->makeHidden('media');
          return asset($link);
    }
}
