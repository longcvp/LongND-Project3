<?php
namespace App\Repositories\Store;

use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\EloquentRepository;

class StoreEloquentRepository extends EloquentRepository implements StoreRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Store::class;
    }


    public function getDataStore()
    {   
        return $this->_model->getDataStore();
    }

    public function createStore($data)
    {   
        return $this->_model->createStore($data);
    }

    public function editStore($data)
    {
        return $this->_model->editStore($data);
    }

    public function getDataStoreUser($id)
    {
        return $this->_model->getDataStoreUser($id);
    }

    public function getProductStore($id)
    {
        return $this->_model->getProductStore($id);
    }

    public function updateExport($data)
    {
        return $this->_model->updateExport($data);
    }

    public function updateImport($data)
    {
        if ($data->type == 1) {
            return $this->_model->createImport($data);
        } else {
            return $this->_model->updateImport($data);
        }
        
    }
}