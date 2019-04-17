<?php
namespace App\Repositories\Store;

interface StoreRepositoryInterface
{
	public function getDataStore();

	public function createStore($data);

	public function editStore($data);

	public function getDataStoreUser($id);

	public function getProductStore($id);

	public function updateExport($data);

	public function updateImport($data);
}