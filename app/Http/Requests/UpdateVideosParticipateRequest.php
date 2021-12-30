<?php

namespace App\Http\Requests;

use App\Models\VideosParticipate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVideosParticipateRequest extends FormRequest
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
            'type' => [
                'required',
            ],
        ];
    }
}