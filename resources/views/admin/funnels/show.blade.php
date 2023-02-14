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
                            {{ $funnel->description }}
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



@endsection