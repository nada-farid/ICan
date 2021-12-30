<?php

namespace App\Http\Requests;

use App\Models\PublicSubject;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePublicSubjectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('public_subject_create');
    }

    public function rules()
    {
        return [
            'subject_category_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'string',
                'required',
            ],
            'writer_name' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
