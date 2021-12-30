<?php

namespace App\Http\Requests;

use App\Models\Champion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreChampionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('champion_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'age' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'photo' => [
                'required',
            ],
            'brief' => [
                'required',
                'max:255',
            ],
            'languages.*' => [
                'integer',
            ],
            'languages' => [
                'array',
            ],
            'degree' => [
                'required',
            ],
            'other_skills' => [
                'string',
                'nullable',
            ],
            'tournament_photo' => [
                'array',
            ],
            'tournament_videos' => [
                'array',
            ],
        ];
    }
}
