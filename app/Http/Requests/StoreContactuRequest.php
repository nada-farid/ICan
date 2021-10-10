<?php

namespace App\Http\Requests;

use App\Models\Contactu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContactuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contactu_create');
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
            ],
            'title' => [
                'string',
                'required',
            ],
            'message' => [
                'required',
            ],
        ];
    }
}
