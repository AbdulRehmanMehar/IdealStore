<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
    'name', 'details' , 'price' , 'views' , 'category' , 'images' , 'slug'
  ];
}
