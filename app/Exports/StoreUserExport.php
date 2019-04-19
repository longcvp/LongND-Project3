<?php

namespace App\Exports;

use Auth;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class StoreUserExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $store;

    public function __construct($store)
    {
        $this->store = $store;
    }
    public function collection()
    {
        return $this->store->getDataStoreUser(Auth::id());
    }

    public function map($store): array
    {
        $data = [
            $store->name,
        ];
        foreach ($store->products as $k => $product) {
            $data[] = 'Sản phẩm '.($k+1).': '.$product->name;
            $data[] = 'Số lượng : '.$product->pivot->count;
        }
        return $data;
    }

    public function headings(): array
    {

        $data = [
            'Tên store',
        ];  
        return $data;   
    }
}
