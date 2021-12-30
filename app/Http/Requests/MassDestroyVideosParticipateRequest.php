<?php

namespace App\Http\Requests;

use App\Models\VideosParticipate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVideosParticipateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('videos_participate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:videos_participates,id',
        ];
    }
}