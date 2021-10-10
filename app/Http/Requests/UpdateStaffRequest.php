<?php

namespace App\Http\Requests;

use App\Models\Staff;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStaffRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('staff_edit');
    }

    public function rules()
    {
        return [
            'photo' => [
                'required',
            ],
            'name' => [
                'string',
                'required',
            ],
            'job_tilte' => [
                'string',
                'required',
            ],
        ];
    }
}
