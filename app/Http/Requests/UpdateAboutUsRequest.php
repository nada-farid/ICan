<?php

namespace App\Http\Requests;

use App\Models\AboutUs;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAboutUsRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('about_us_edit');
    }

    public function rules()
    {
        return [
            'phote' => [
                'required',
            ],
            'description' => [
                'required',
            ],
            'vision' => [
                'required',
            ],
            'message' => [
                'required',
            ],
            'goals' => [
                'required',
            ],
            'email' => [
                'string',
                'required',
            ],
            'phone_1' => [
                'string',
                'required',
            ],
            'phone_2' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'required',
            ],
            'time' => [
                'string',
                'required',
            ],
            'facebook' => [
                'string',
                'nullable',
            ],
            'twitter' => [
                'string',
                'nullable',
            ],
            'instegram' => [
                'string',
                'nullable',
            ],
            'youtube' => [
                'string',
                'nullable',
            ],
        ];
    }
}
