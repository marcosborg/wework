<?php

namespace App\Http\Requests;

use App\Models\Funnel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFunnelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('funnel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:funnels,id',
        ];
    }
}
