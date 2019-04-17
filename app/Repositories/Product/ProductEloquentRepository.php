<?php
namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Repositories\EloquentRepository;



class ProductEloquentRepository extends EloquentRepository implements ProductRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    public function changeData($data)
    {
       $rs = DB::table('product_store')->select('count')
                                ->where('store_id', $data->store_id)
                                ->where('product_id', $data->product_id)
                                ->first();
        return $rs->count;
    }
}