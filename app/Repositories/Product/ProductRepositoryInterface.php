<?php
namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function changeData($data);
    public function updateImport($data);
}