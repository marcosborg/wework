<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WeWork</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        @if($company->logo)
        <a href="{{ $company->logo->getUrl() }}" target="_blank" style="display: inline-block">
            <img src="{{ $company->logo->getUrl() }}">
        </a>
        @endif
        <div class="mb-5">
            {!! $funnel->description !!}
        </div>
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal">Fazer candidatura</button>
        <div class="mt-5">
            {!! $funnel->description_2 !!}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabel">Candidatura</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/products/submit" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                    <input type="hidden" name="funnel_id" value="{{ $funnel->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" name="first_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sobrenome</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Contacto</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Para onde se candidata</label>
                            <select name="district" class="form-control">
                                <option selected disabled>Selecionar</option>
                                @foreach ($districts as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Anexar CV</label>
                            <input type="file" name="cv" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Submeter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
<script>
    console.log({!! $districts !!})
</script>