<?php

namespace App\Http\Requests;

use App\Models\SubjectsCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubjectsCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('subjects_category_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
        ];
    }
}
