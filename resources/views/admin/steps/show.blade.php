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