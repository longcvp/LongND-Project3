<?php
namespace App\Repositories\UserConfirm;

use App\Models\UserConfirm;
use Illuminate\Support\Facades\DB;
use App\Repositories\EloquentRepository;

class UserConfirmEloquentRepository extends EloquentRepository implements UserConfirmRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\UserConfirm::class;
    }

    // public function getUserByToken($token)
    // {
    // 	return $this->_model->findByToken($token);
    // }

    // public function deleteToken($token)
    // {
    //     return $this->_model->deleteByToken($token);
    // }

}