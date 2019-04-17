<?php

namespace App\Models;

use App\Models\UserConfirm;
use App\Models\Store;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'is_root', 'reset_password'
    ];

    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function confirm()
    {
        return $this->hasOne(UserConfirm::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function saveUser($data, $password)
    {
        $newData = [
            'name' => $data->name,
            'username' => strtolower(str_random(6,10)),
            'email' => $data->email,
            'password' => bcrypt($password),
            'is_root' => NON_ROOT,
            'reset_password' => RESET_PASS
        ];
        return $this->create($newData);
    }

    public function changePassword($data)
    {
        $updateData = [
            'password' => bcrypt($data->password),
            'reset_password' => NO_RESET_PASS            
        ];
        return $this->find($data->id)->update($updateData);
    }

    public function updateUser($data)
    {
        $updateData = [
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'reset_password' => NO_RESET_PASS            
        ];
        return $this->find($data->id)->update($updateData);
    }

    public function findById($id)
    {
        return $this->with('stores')->where('id', $id)->get();
    }

    public function getAllUser()
    {
        return $this->with('stores')->where('is_root', NON_ROOT)->paginate(8);
    }
}
