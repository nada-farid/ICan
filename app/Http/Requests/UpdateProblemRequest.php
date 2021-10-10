<?php

namespace App\Http\Requests;

use App\Models\Problem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProblemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('problem_edit');
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
                'unique:problems,email,' . request()->route('problem')->id,
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
