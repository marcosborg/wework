@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.step.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.steps.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.step.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.step.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="funnel_id">{{ trans('cruds.step.fields.funnel') }}</label>
                <select class="form-control select2 {{ $errors->has('funnel') ? 'is-invalid' : '' }}" name="funnel_id" id="funnel_id" required>
                    @foreach($funnels as $id => $entry)
                        <option value="{{ $id }}" {{ old('funnel_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('funnel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('funnel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.step.fields.funnel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="state_id">{{ trans('cruds.step.fields.state') }}</label>
                <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id" id="state_id" required>
                    @foreach($states as $id => $entry)
                        <option value="{{ $id }}" {{ old('state_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.step.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection