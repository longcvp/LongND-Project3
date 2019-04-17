<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
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
        $req = request();
        $type = $req->type;
        if ($type == 1) {
            return [
                'product_name' => 'required',
                'count' => 'required|numeric|min:0',
            ];
        } else {
            return [
                'product_id' => 'required',
                'count' => 'required|numeric|min:0',
            ];
        }
    }
}
