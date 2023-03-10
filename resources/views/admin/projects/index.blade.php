@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs">
            @foreach ($categories as $key => $cat)
            <li class="nav-item">
                <a class="text-uppercase nav-link {{ $category_id == $cat->id ? 'active' : '' }}" aria-current="page"
                    href="/admin/projects/{{ $cat->id }}">{{ $cat->name }}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="card-body" id="projects-body"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="addItem" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nova entrada</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Cliente</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Entrada</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Informação</label>
                    <textarea type="text" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Gravar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="form" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Formulário para incorporar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <code>
                    &lt;form action="/products/submit" method="post" enctype="multipart/form-data"&gt;
&lt;input type="hidden" name="_token" value="uR0rbDrRKInQ71T3BHoJp7x47vNEWqLnbo5kjllj"&gt;&lt;input type="hidden" name="company_id" value="1"&gt;
&lt;input type="hidden" name="funnel_id" value="3"&gt;
&lt;div class="row"&gt;
&lt;div class="col-md-6"&gt;
&lt;div class="form-group"&gt;
&lt;label&gt;Nome&lt;/label&gt;
&lt;input type="text" name="first_name" class="form-control"&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;div class="col-md-6"&gt;
&lt;div class="form-group"&gt;
&lt;label&gt;Sobrenome&lt;/label&gt;
&lt;input type="text" name="last_name" class="form-control"&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;div class="form-group"&gt;
&lt;label&gt;Contacto&lt;/label&gt;
&lt;input type="text" name="phone" class="form-control"&gt;
&lt;/div&gt;
&lt;div class="form-group"&gt;
&lt;label&gt;Email&lt;/label&gt;
                    &lt;input type="text" name="email" class="form-control"&gt;
                    &lt;/div&gt;
                    &lt;div class="form-group"&gt;
                    &lt;label&gt;Para onde se candidata&lt;/label&gt;
                    &lt;select name="district" class="form-control"&gt;
                    &lt;option selected="" disabled=""&gt;Selecionar&lt;/option&gt;
                    &lt;option value="1"&gt;Aveiro&lt;/option&gt;
                    &lt;option value="2"&gt;Beja&lt;/option&gt;
                    &lt;option value="3"&gt;Braga&lt;/option&gt;
                    &lt;option value="4"&gt;Bragança&lt;/option&gt;
                    &lt;option value="5"&gt;Castelo Branco&lt;/option&gt;
                    &lt;option value="6"&gt;Coimbra&lt;/option&gt;
                    &lt;option value="7"&gt;Évora&lt;/option&gt;
                    &lt;option value="8"&gt;Faro&lt;/option&gt;
                    &lt;option value="9"&gt;Guarda&lt;/option&gt;
                    &lt;option value="10"&gt;Leiria&lt;/option&gt;
                    &lt;option value="11"&gt;Lisboa&lt;/option&gt;
                    &lt;option value="12"&gt;Portalegre&lt;/option&gt;
                    &lt;option value="13"&gt;Porto&lt;/option&gt;
                    &lt;option value="14"&gt;Santarém&lt;/option&gt;
                    &lt;option value="15"&gt;Setúbal&lt;/option&gt;
                    &lt;option value="16"&gt;Viana do Castelo&lt;/option&gt;
                    &lt;option value="17"&gt;Vila Real&lt;/option&gt;
                    &lt;option value="18"&gt;Viseu&lt;/option&gt;
                    &lt;/select&gt;
                    &lt;/div&gt;
                    &lt;div class="form-group"&gt;
                    &lt;label&gt;Anexar CV&lt;/label&gt;
                    &lt;input type="file" name="file" class="form-control"&gt;
                    &lt;/div&gt;
                    &lt;button type="submit" class="btn btn-primary mt-4"&gt;Submeter&lt;/button&gt;
                    &lt;/form&gt;
                </code>
            </div>
        </div>
    </div>
</div>

@endsection
@section('styles')

@endsection
@section('scripts')
@parent
<script>
    $(() => {
        getProjectsAjax();
    });

    getProjectsAjax = () => {
        $.get('/admin/projectsAjax').then((resp) => {
            $('#projects-body').html(resp);
        });
    }

    drag = (ev) => {
        ev.dataTransfer.setData('id', ev.target.id);
    }

    drop = (ev) => {
        if (ev.target.getAttribute("droppable") == "false"){
            ev.dataTransfer.dropEffect = "none";
            ev.preventDefault();
        }
        else{
            ev.dataTransfer.dropEffect = "all";
            ev.preventDefault();
            var id = ev.dataTransfer.getData('id');
            ev.target.appendChild(document.getElementById(id));
            let item_id = id;
            let step_id = $(ev.target).data('step');
            var form = new FormData();
            form.append("item_id", item_id);
            form.append("step_id", step_id);
            var settings = {
                "url": "/admin/projectsUpdate",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };

            $.ajax(settings).done(function (response) {
            console.log(JSON.parse(response));
            });
        }
    }

    allowDrop = (ev) => {
        ev.preventDefault();
    }

    getForm = (funnel_id) => {
        console.log(funnel_id);
        $('#form').modal('show');
    }
</script>
@endsection