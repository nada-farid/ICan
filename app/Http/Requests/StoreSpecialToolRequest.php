<?php

namespace App\Http\Requests;

use App\Models\SpecialTool;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSpecialToolRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('special_tool_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'photo' => [
                'required',
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
