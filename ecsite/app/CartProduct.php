<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $fillable = ['user_id','product_id'];

    protected $table = 'cart_product';
}
