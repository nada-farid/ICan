<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class Update_profileRequest extends FormRequest
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
    public function rules(){
     
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email,'.Auth::user()->id,
            ],
            'password' => [
                'required',
            ],
            'phone' => [
                'required',
                'size:10',
                'regex:/(05)[0-9]{8}/', 
            ],
        ];
    }
}