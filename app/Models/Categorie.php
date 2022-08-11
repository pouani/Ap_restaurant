<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use HasFactory, SoftDeletes;

    //fonction relation one to many(ici une actegorie peut detenir plusieurs produits)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
