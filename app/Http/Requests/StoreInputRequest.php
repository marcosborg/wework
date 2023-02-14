<?php

namespace App\Http\Requests;

use App\Models\Input;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInputRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('input_create');
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
            'item_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
