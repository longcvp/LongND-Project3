<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class StoreDataExport implements FromCollection, WithMapping, WithHeadings
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
        return $this->store->getDataStore();
    }

    public function map($store): array
    {
    	$data = [
    		$store->name,
    		$store->user->name == '' ? $store->user->email : $store->user->name,

    	];
    	foreach ($store->products as $k => $product) {
    		$data[] = 'Sản phẩm '.($k+1).': '.$product->name.' Số lượng : '.$product->pivot->count;
    	}
    	return $data;
    }

    public function headings(): array
    {

    	$data = [
    		'Tên store',
    		'Quản lý kho'
    	]; 	
    	return $data;	
    }
}
