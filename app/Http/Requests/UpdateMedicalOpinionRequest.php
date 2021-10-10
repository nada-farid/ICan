<?php

namespace App\Http\Requests;

use App\Models\MedicalOpinion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMedicalOpinionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('medical_opinion_edit');
    }

    public function rules()
    {
        return [
            'doctor_id' => [
                'required',
                'integer',
            ],
            'photo' => [
                'required',
            ],
            'opinion' => [
                'required',
            ],
        ];
    }
}
