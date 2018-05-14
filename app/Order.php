<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'cart', 'buyer_name' , 'buyer_email' , 'buyer_address' , 'buyer_phone' , 'complete_status'
  ];
}
