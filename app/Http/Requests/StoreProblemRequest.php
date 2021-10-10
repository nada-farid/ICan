<?php

namespace App\Http\Requests;

use App\Models\Problem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProblemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('problem_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:problems',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
