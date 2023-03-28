@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.form.title') }}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Funíl</label>
                    <select name="funnel_id" id="funnel_id" class="form-control select2">
                        <option selected disabled>Selecionar</option>
                        @foreach ($funnels as $funnel)
                        <option value="{{ $funnel->id }}">{{ $funnel->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Empresa</label>
                    <select name="company_id" id="company_id" class="form-control select2">
                        <option selected disabled>Selecionar</option>
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" name="description" id="description" class="form-control">
                </div>
                <div class="form-group">
                    <button onclick="getForm()" type="button" class="btn btn-success">Mostrar formulário</button>
                </div>
            </div>
            <div class="col-md-6" id="form-container">

            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    getForm = () => {
    let funnel_id = $('#funnel_id').val();
    let company_id = $('#company_id').val();
    let description = $('#description').val();
    if(!funnel_id || !company_id || !description){
        Swal.fire('Os campos são obrigatórios');
    } else {
        let html = '<div class="alert alert-info">';
        html += '<code>';
        html += '&lt;script src="https://we-work.pt/api/submit_product.js"&gt;&lt;/script&gt;';
        html += '&lt;form action="/api/products/submit" method="post" enctype="multipart/form-data" id="submit_product"&gt;';
        html += '&lt;input type="hidden" name="company_id" id="company_id" value="' + company_id + '"&gt;';
        html += '&lt;input type="hidden" name="funnel_id" id="funnel_id" value="' + funnel_id + '"&gt;';
        html += '&lt;input type="hidden" name="description" id="description" value="' + description + '"&gt;';
        html += '&lt;label&gt;Nome&lt;/label&gt;&lt;br&gt;';
        html += '&lt;input type="text" name="first_name" id="first_name"&gt;&lt;br&gt;';
        html += '&lt;label&gt;Sobrenome&lt;/label&gt;&lt;br&gt;';
        html += '&lt;input type="text" name="last_name" id="last_name"&gt;&lt;br&gt;';
        html += '&lt;label&gt;Contacto&lt;/label&gt;&lt;br&gt;';
        html += '&lt;input type="text" name="phone" id="phone"&gt;&lt;br&gt;';
        html += '&lt;label&gt;Email&lt;/label&gt;&lt;br&gt;';
        html += '&lt;input type="text" name="email" id="email"&gt;&lt;br&gt;';
        html += '&lt;label&gt;Para onde se candidata&lt;/label&gt;&lt;br&gt;';
        html += '&lt;select name="district" id="district"&gt;';
        html += '&lt;option selected disabled&gt;Selecionar&lt;/option&gt;';
        html += '&lt;option value="1"&gt;Aveiro&lt;/option&gt;';
        html += '&lt;option value="2"&gt;Beja&lt;/option&gt;';
        html += '&lt;option value="3"&gt;Braga&lt;/option&gt;';
        html += '&lt;option value="4"&gt;Bragança&lt;/option&gt;';
        html += '&lt;option value="5"&gt;Castelo Branco&lt;/option&gt;';
        html += '&lt;option value="6"&gt;Coimbra&lt;/option&gt;';
        html += '&lt;option value="7"&gt;Évora&lt;/option&gt;';
        html += '&lt;option value="8"&gt;Faro&lt;/option&gt;';
        html += '&lt;option value="9"&gt;Guarda&lt;/option&gt;';
        html += '&lt;option value="10"&gt;Leiria&lt;/option&gt;';
        html += '&lt;option value="11"&gt;Lisboa&lt;/option&gt;';
        html += '&lt;option value="12"&gt;Portalegre&lt;/option&gt;';
        html += '&lt;option value="13"&gt;Porto&lt;/option&gt;';
        html += '&lt;option value="14"&gt;Santarém&lt;/option&gt;';
        html += '&lt;option value="15"&gt;Setúbal&lt;/option&gt;';
        html += '&lt;option value="16"&gt;Viana do Castelo&lt;/option&gt;';
        html += '&lt;option value="17"&gt;Vila Real&lt;/option&gt;';
        html += '&lt;option value="18"&gt;Viseu&lt;/option&gt;';
        html += '&lt;/select&gt;&lt;br&gt;';
        html += '&lt;label&gt;Anexar CV&lt;/label&gt;&lt;br&gt;';
        html += '&lt;input type="file" name="file" id="file"&gt;&lt;br&gt;';
        html += '&lt;button type="submit" class="btn btn-primary mt-4"&gt;Submeter&lt;/button&gt;';
        html += '&lt;/form&gt;';
        html += '</code>';
        html += '</div>';
        $('#form-container').html(html);
    }
}
</script>
@endsection