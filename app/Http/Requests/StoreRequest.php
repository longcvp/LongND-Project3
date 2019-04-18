<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $id = $request->id;
        if ($request->getMethod() == 'POST') {
            return [
                'storename' => 'required|unique:stores,name',
                'manager' => 'required',
            ];
        } else { 
            return [
                'storename' => 'required|unique:stores,name,'.$id.',id',
                'manager' => 'required',
            ];
        }
    }
}
