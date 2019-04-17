<?php

namespace App\Http\Requests;

use Auth;
use Hash;
use Lang;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $request = request();
        $value = $request->old_password;
        if (is_null($request->email)) {
            return [
                'old_password' => ['bail', 'required', function ($attribute, $value, $fail) {
                                    if (! Hash::check($value, Auth::user()->password)) {
                                        $fail(Lang::get('validation.update_custom.password'));
                                    }
                                }],
                'password'          =>  'required|different:old_password|min:6',
                'confirm_password'   =>  'required|same:password',
            ];            
        } else {
            return [
                'email'             =>  'bail|required|email|unique:users,email',
                'old_password' => ['required',function ($attribute, $value, $fail) {
                                    if (! Hash::check($value, Auth::user()->password)) {
                                        $fail(Lang::get('validation.update_custom.password'));
                                    }
                                }],
                'name'             =>  'required',
                'password'          =>  'required|different:old_password|min:6',
                'confirm_password'   =>  'required|same:password',
            ];            
        }
    }

    public function messages(){
        return [
            'confirm_password.required' => Lang::get('validation.update_custom.confirm_password_required'),
            'old_password.required' => Lang::get('validation.update_custom.old_password'),
            'confirm_password.same' => Lang::get('validation.update_custom.confirm_password_same'),
            'password.different' => Lang::get('validation.update_custom.password_different'),
        ];
    }
}
