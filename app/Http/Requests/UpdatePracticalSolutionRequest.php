<?php

namespace App\Http\Requests;

use App\Models\PracticalSolution;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePracticalSolutionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
            'photo' => [
                'required',
            ],
            'photos' => [
                'array',
            ],
        ];
    }
}
