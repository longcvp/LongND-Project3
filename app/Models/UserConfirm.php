<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserConfirm extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['user_id', 'token'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function findByToken($token)
    {
        $data = '';
        $data = $this->where('token', $token)->firstOrFail();
        return $data;
    }

    public function deleteByToken($token)
    {
        return $this->where('token', $token)->delete();
    }
}
