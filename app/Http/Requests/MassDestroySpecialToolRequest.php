<?php

namespace App\Http\Requests;

use App\Models\SpecialTool;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySpecialToolRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('special_tool_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:special_tools,id',
        ];
    }
}
