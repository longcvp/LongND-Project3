<?php

namespace App\Models;

use App\Models\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'store_id', 'count'
    ];

    protected $dates = ['deleted_at'];

    public function stores()
    {
        return $this->belongsToMany(Product::class, 'product_store')->withPivot('count');
    }

}
