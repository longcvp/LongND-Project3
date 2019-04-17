<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class StoreExport implements FromCollection, WithMapping, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $store;

    public function __construct($store, $id)
    {
        $this->store = $store;
        $this->id = $id;

    }
    public function collection()
    {
        $store = $this->store->getProductStore($this->id);
        return $store->products;
    }

    public function map($store): array
    {
    	return [
    		$store->name,
    		$store->pivot->count,
    	];
    }

    public function headings(): array
    {
    	return [
    		'Tên sản phẩm',
    		'Số lượng',
    	];    	
    }

    public function title(): string
    {
    	$store = $this->store->getProductStore($this->id);
        return 'Store ' . $store->name;
    }
}
