<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'description', 'price', 'stock', 'status',
    ];

    /**
     * productのoptionを取得する
     */
    public function options()
    {
        return $this->hasMany('App\Models\Option');
    }

    /**
     * productのphotoを取得
     */
    public function photos()
    {
        return $this->hasMany('App\Models\Photo');
    }
}
