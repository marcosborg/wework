<?php

namespace App\Http\Requests;

use App\Models\Step;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStepRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('step_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'funnel_id' => [
                'required',
                'integer',
            ],
            'state_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
