<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Models\UserConfirm;
use App\Mail\ActiveMail;
use App\Jobs\SendResetMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\EloquentRepository;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    public function createUser($data)
    {
        DB::transaction(function() use ($data) {
            $password = str_random(6);
            $newUser = $this->_model->saveUser($data, $password);
        });
    }

    public function changeData($data)
    {
        if (!is_null($data->email)) {
            $this->_model->updateUser($data);
        } else {
            $this->_model->changePassword($data);
        }
        
    }

    public function getDataUser()
    {
        return $this->_model->getAllUser();
    }

    public function resetPass($data)
    {
        foreach ($data->checked as $id) {
            $password = str_random(6);
            $userData = [
                'password' => bcrypt($password),
                'reset_password' => RESET_PASS
            ];
            $time = 60;
            $user = $this->_model->find($id);
            dispatch(new SendResetMail($password, $user))
                        ->delay(now()->addSeconds($time));
            $user->update($userData);
        }
    }
}