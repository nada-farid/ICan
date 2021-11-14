<?php

namespace App\Http\Requests;

use App\Models\PublicSubject;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPublicSubjectRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('public_subject_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:public_subjects,id',
        ];
    }
}
