<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportRequest extends FormRequest
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
        $countMax = $req->count_product;
        return [
            'product_id' => 'required',
            'count' => 'required|numeric|min:0|max:' . $countMax,
        ];
    }
}
