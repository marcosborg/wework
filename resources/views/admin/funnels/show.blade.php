@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.funnel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.funnels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.funnel.fields.id') }}
                        </th>
                        <td>
                            {{ $funnel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.funnel.fields.name') }}
                        </th>
                        <td>
                            {{ $funnel->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.funnel.fields.description') }}
                        </th>
                        <td>
                            {!! $funnel->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.funnel.fields.category') }}
                        </th>
                        <td>
                            {{ $funnel->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.funnel.fields.file_text') }}
                        </th>
                        <td>
                            {{ $funnel->file_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.funnel.fields.file') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $funnel->file ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.funnel.fields.message_text') }}
                        </th>
                        <td>
                            {{ $funnel->message_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.funnel.fields.message') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $funnel->message ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.funnels.index') }}">
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
            <a class="nav-link" href="#funnel_steps" role="tab" data-toggle="tab">
                {{ trans('cruds.step.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#funnels_companies" role="tab" data-toggle="tab">
                {{ trans('cruds.company.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="funnel_steps">
            @includeIf('admin.funnels.relationships.funnelSteps', ['steps' => $funnel->funnelSteps])
        </div>
        <div class="tab-pane" role="tabpanel" id="funnels_companies">
            @includeIf('admin.funnels.relationships.funnelsCompanies', ['companies' => $funnel->funnelsCompanies])
        </div>
    </div>
</div>

@endsection