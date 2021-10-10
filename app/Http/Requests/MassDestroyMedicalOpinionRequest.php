<?php

namespace App\Http\Requests;

use App\Models\MedicalOpinion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMedicalOpinionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('medical_opinion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:medical_opinions,id',
        ];
    }
}
