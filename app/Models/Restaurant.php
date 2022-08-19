<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['name', 'price', 'active', 'categorie_id'];
    protected $appends = ["image"];


    //fonction relation one to many(ici une actegorie peut detenir plusieurs produits)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
