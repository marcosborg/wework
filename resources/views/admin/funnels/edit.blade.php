@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.funnel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.funnels.update", [$funnel->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.funnel.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $funnel->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.funnel.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.funnel.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $funnel->description) !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.funnel.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.funnel.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $funnel->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.funnel.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_text">{{ trans('cruds.funnel.fields.file_text') }}</label>
                <input class="form-control {{ $errors->has('file_text') ? 'is-invalid' : '' }}" type="text" name="file_text" id="file_text" value="{{ old('file_text', $funnel->file_text) }}">
                @if($errors->has('file_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.funnel.fields.file_text_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('file') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="file" value="0">
                    <input class="form-check-input" type="checkbox" name="file" id="file" value="1" {{ $funnel->file || old('file', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="file">{{ trans('cruds.funnel.fields.file') }}</label>
                </div>
                @if($errors->has('file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.funnel.fields.file_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="message_text">{{ trans('cruds.funnel.fields.message_text') }}</label>
                <input class="form-control {{ $errors->has('message_text') ? 'is-invalid' : '' }}" type="text" name="message_text" id="message_text" value="{{ old('message_text', $funnel->message_text) }}">
                @if($errors->has('message_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.funnel.fields.message_text_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('message') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="message" value="0">
                    <input class="form-check-input" type="checkbox" name="message" id="message" value="1" {{ $funnel->message || old('message', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="message">{{ trans('cruds.funnel.fields.message') }}</label>
                </div>
                @if($errors->has('message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.funnel.fields.message_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.funnels.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $funnel->id ?? 0 }}');
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