<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function collection()
    {
        return $this->user->getDataUser();
    }

    public function map($user): array
    {
    	
    	$data = [
    		$user->name,
    		$user->username,
    		$user->email,
    	];
    	foreach ($user->stores as $k => $store) {
    		$data[] = 'Kho '.($k+1).': '.$store->name;
    	}
    	return $data;
    }

    public function headings(): array
    {

    	$data = [
    		'Tên nhân viên',
    		'Tên đăng nhập',
    		'Địa chỉ email',
    	]; 	
    	return $data;	
    }

}
