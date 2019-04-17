<?php
namespace App\Repositories\User;
    
use File;
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
        $token = $this->getToken();
    	DB::transaction(function() use ($data, $token) {
            $password = str_random(6);
    		$newUser = $this->_model->saveUser($data, $password);
            $newUser->confirm()->create(['token' => $token]);
            $this->sendActiveMail($token, $newUser);
    	});
    }

    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    protected function sendActiveMail($token, $newUser)
    {
        $activeLink = 'dogonoithat.test/auth/login/'. $token;
        try{
            Mail::to($newUser->email)
                    ->send(new ActiveMail($activeLink, $newUser->name, $newUser->username, $newUser->password));
        }catch (Exception $e){
            throw new MailException('progress.sentMailError');
        }        
    }

    // public function authLogin($id)
    // {
    //     $user = $this->_model->find($id);
    //     $user->update(['active' => ACTIVE]);
    // }

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
        $password = '123456';
        $userData = [
            'password' => bcrypt($password),
            'reset_password' => RESET_PASS    
        ];
        $this->_model->whereIn('id', $data->checked)->update($userData);
        foreach ($data->checked as $id) {
            $user = $this->_model->find($id);
            //dispatch(new SendResetMail($password, $user));
        }
    }
}