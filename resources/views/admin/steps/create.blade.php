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
                <label for="sender">{{ trans('cruds.step.fields.sender') }}</label>
                <input class="form-control {{ $errors->has('sender') ? 'is-invalid' : '' }}" type="email" name="sender" id="sender" value="{{ old('sender') }}">
                @if($errors->has('sender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.step.fields.sender_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('notify_client') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="notify_client" value="0">
                    <input class="form-check-input" type="checkbox" name="notify_client" id="notify_client" value="1" {{ old('notify_client', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="notify_client">{{ trans('cruds.step.fields.notify_client') }}</label>
                </div>
                @if($errors->has('notify_client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notify_client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.step.fields.notify_client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="template_client">{{ trans('cruds.step.fields.template_client') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('template_client') ? 'is-invalid' : '' }}" name="template_client" id="template_client">{!! old('template_client') !!}</textarea>
                @if($errors->has('template_client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('template_client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.step.fields.template_client_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('notify_company') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="notify_company" value="0">
                    <input class="form-check-input" type="checkbox" name="notify_company" id="notify_company" value="1" {{ old('notify_company', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="notify_company">{{ trans('cruds.step.fields.notify_company') }}</label>
                </div>
                @if($errors->has('notify_company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notify_company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.step.fields.notify_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="template_company">{{ trans('cruds.step.fields.template_company') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('template_company') ? 'is-invalid' : '' }}" name="template_company" id="template_company">{!! old('template_company') !!}</textarea>
                @if($errors->has('template_company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('template_company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.step.fields.template_company_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('notify_user') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="notify_user" value="0">
                    <input class="form-check-input" type="checkbox" name="notify_user" id="notify_user" value="1" {{ old('notify_user', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="notify_user">{{ trans('cruds.step.fields.notify_user') }}</label>
                </div>
                @if($errors->has('notify_user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notify_user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.step.fields.notify_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="template_user">{{ trans('cruds.step.fields.template_user') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('template_user') ? 'is-invalid' : '' }}" name="template_user" id="template_user">{!! old('template_user') !!}</textarea>
                @if($errors->has('template_user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('template_user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.step.fields.template_user_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.steps.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $step->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection