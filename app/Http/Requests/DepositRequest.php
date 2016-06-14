<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;


class DepositRequest extends Request
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
        return [
            'deposit' => 'required|min:300|max:10000|integer',
            'pmethod' => 'required',
        ];
    }
}
