@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.step.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.steps.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.step.fields.id') }}
                        </th>
                        <td>
                            {{ $step->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.step.fields.name') }}
                        </th>
                        <td>
                            {{ $step->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.step.fields.funnel') }}
                        </th>
                        <td>
                            {{ $step->funnel->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.step.fields.state') }}
                        </th>
                        <td>
                            {{ $step->state->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.step.fields.sender') }}
                        </th>
                        <td>
                            {{ $step->sender }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.step.fields.notify_client') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $step->notify_client ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.step.fields.template_client') }}
                        </th>
                        <td>
                            {!! $step->template_client !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.step.fields.notify_company') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $step->notify_company ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.step.fields.template_company') }}
                        </th>
                        <td>
                            {!! $step->template_company !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.step.fields.notify_user') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $step->notify_user ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.step.fields.template_user') }}
                        </th>
                        <td>
                            {!! $step->template_user !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.steps.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#step_items" role="tab" data-toggle="tab">
                {{ trans('cruds.item.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="step_items">
            @includeIf('admin.steps.relationships.stepItems', ['items' => $step->stepItems])
        </div>
    </div>
</div>

@endsection