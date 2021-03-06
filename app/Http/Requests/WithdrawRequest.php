<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WithdrawRequest extends Request
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
            'payment_gateway'       => 'required',
            'payment_account'       => 'required',
            'balance_type'          => 'required',
            'withdrawal_amount'     => 'required|integer',
            'pincode'               => 'required'
        ];
    }
}
