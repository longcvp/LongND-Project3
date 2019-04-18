<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_store')->withPivot('count');
    }

    public function getDataStore()
    {
        return $this->with('user', 'products')->paginate(8);
    }

    public function createStore($data)
    {
        $storeData = [
            'user_id' => $data->manager,
            'name' => $data->storename,
        ];

        return $this->create($storeData);
    }

    public function editStore($data)
    {
        $storeData = [
            'user_id' => $data->manager,
            'name' => $data->storename,
        ];

        return $this->find($data->id)->update($storeData);        
    }

    public function getDataStoreUser($id)
    {
        return $this->with('products')->where('user_id', $id)->paginate(8);
    }

    public function getProductStore($id)
    {
        return $this->with('products')->find($id);
    }

    public function updateExport($data)
    {
        $store = $this->find($data->store_id);
        $updateData = ['count' => ($data->count_product - $data->count)];
        return $store->products()->updateExistingPivot($data->product_id, $updateData);
    }

    public function updateImport($data)
    {
        $store = $this->find($data->store_id);
        $updateData = ['count' => ($data->count_product + $data->count)];
        return $store->products()->updateExistingPivot($data->product_id, $updateData);        
    }

    public function createImport($data)
    {
        $store = $this->with('products')->find($data->store_id);
        $product = Product::where('name', $data->product_name)->first();
        if (!$product) {
            $updateData = ['count' => $data->count];
            $product_id = Product::create(['name' => $data->product_name]);

            return $store->products()->attach($product_id, $updateData); 
        } else {
            $oldCount = $store->products->find($product->id)->pivot->count;
            $updateData = ['count' => $data->count + $oldCount];
            $product_id = $product->id;
            
            return $store->products()->updateExistingPivot($product_id, $updateData); 
        }

                
    }
}
