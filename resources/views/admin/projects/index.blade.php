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
                <code id="code">&lt;iframe src="https://we-work.pt/products/1/3" frameborder="0" width="100%" height="500px;"&gt;&lt;/iframe&gt;</code>
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