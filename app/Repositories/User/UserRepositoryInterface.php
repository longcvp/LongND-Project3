<?php
namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function createUser($data);

    public function resetPass($data);

    public function changeData($data);

    public function getDataUser();

}