<form action="/api/products/submit" method="post" enctype="multipart/form-data" id="submit_product">
    <input type="hidden" name="company_id" id="company_id" value="1">
    <input type="hidden" name="funnel_id" id="funnel_id" value="3">
    <label>Nome</label><br>
    <input type="text" name="first_name" id="first_name"><br>
    <label>Sobrenome</label><br>
    <input type="text" name="last_name" id="last_name"><br>
    <label>Contacto</label><br>
    <input type="text" name="phone" id="phone"><br>
    <label>Email</label><br>
    <input type="text" name="email" id="email"><br>
    <label>Para onde se candidata</label><br>
    <select name="district" id="district">
        <option selected disabled>Selecionar</option>
        <option value="1">Aveiro</option>
        <option value="2">Beja</option>
        <option value="3">Braga</option>
        <option value="4">Bragança</option>
        <option value="5">Castelo Branco</option>
        <option value="6">Coimbra</option>
        <option value="7">Évora</option>
        <option value="8">Faro</option>
        <option value="9">Guarda</option>
        <option value="10">Leiria</option>
        <option value="11">Lisboa</option>
        <option value="12">Portalegre</option>
        <option value="13">Porto</option>
        <option value="14">Santarém</option>
        <option value="15">Setúbal</option>
        <option value="16">Viana do Castelo</option>
        <option value="17">Vila Real</option>
        <option value="18">Viseu</option>
    </select><br>
    <label>Anexar CV</label><br>
    <input type="file" name="file" id="file"><br>
    <button type="submit" class="btn btn-primary mt-4">Submeter</button>
</form>
<script src="https://we-work.pt/api/submit_product.js?v=2"></script>