<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\User\UserRepositoryInterface;


class AuthController extends Controller
{

    /**
        repository user/group/room
    */
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function getLogin()
    {
        if (!Auth::check()) {
            return view('auth.login');
        } else {
            return redirect()->route('admin.index');
        }
    }

    public function postLogin(LoginRequest $req)
    {
        $username = $req->username;
        $password = $req->password;
 
        if ( Auth::attempt(['username' => $username, 'password' => $password])) {
            return redirect()->route('admin.index'); 
        } else {
            $errors = new MessageBag(['errorlogin' => 'Tên đăng nhập hoặc mật khẩu không đúng']);
            return redirect()->back()->withInput()->withErrors($errors);
        }       
    }

    public function getLogOut() 
    {
        Auth::logout();
        return redirect()->route('login.index');
    }

    public function getResetPassword($id)
    {
        if (Auth::id() != $id){
            return redirect()->back();
        } else {
            return view('auth.reset');
        }
        
    }

    public function postResetPassword(ChangePasswordRequest $request, $id)
    {
        $this->user->changeData($request);
        return redirect()->route('admin.index')->with('success','Mật khẩu của bạn đã được thay đổi');
    }

    // public function authToken($token)
    // {
    //     $data = $this->active->getUserByToken($token);
    //     if (is_null($data)) {
    //         return redirect()->route('login.index')->with('error', 'Không thể xác thực tài khoản!');
    //     } else {
    //         $this->user->authLogin($data->user_id);
    //         $this->active->deleteToken($token);
    //         return redirect()->route('login.index')->with('success', 'Xác thực đăng kí thành công! Bạn có thể đăng nhập');
    //     }   
    // }

    // public function getReset()
    // {
    //     return view('auth.reset');
    // }

    // public function postReset(ResetPassRequest $req)
    // {
    //     $this->user->resetPass($req->email);
    //      return redirect()->route('login.index')->with('success', 'Đặt lại mật khẩu thành công! Kiểm tra email và đăng nhập');
    // }
}