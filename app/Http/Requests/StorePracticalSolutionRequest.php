<?php

namespace App\Http\Requests;

use App\Models\PracticalSolution;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePracticalSolutionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('practical_solution_create');
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
