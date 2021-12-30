<?php

namespace App\Http\Requests;

use App\Models\SubjectsCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySubjectsCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('subjects_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:subjects_categories,id',
        ];
    }
}
