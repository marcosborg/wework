<?php

namespace App\Http\Requests;

use App\Models\Funnel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFunnelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('funnel_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
