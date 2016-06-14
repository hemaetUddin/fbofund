<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;



class UplineChangeRequest extends Request
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
            'carry' => 'required',
            // 'suser' => 'required',
            'eupline'=> 'required',
            'nupline'=> 'required',
            'position'=> 'required'
        ];
    }


    public function messages()
{
    return [
        'carry.required' => 'Please select carries',
        'eupline.required' => 'Existing upline ID is required',
        'nupline.required' => 'New upline ID is required',
    ];
}
}
