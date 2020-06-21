<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryCompany extends Model
{
    protected $fillable = ['name', 'telephone', 'shipping_cost'];
}
