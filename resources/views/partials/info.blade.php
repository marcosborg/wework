<div class="row">
    <div class="col">
        <h4>Dados pessoais</h4>
        <p><strong>Nome: </strong>{{ $item->client->first_name }} {{ $item->client->last_name }}</p>
        <p><strong>Empresa: </strong>{{ $item->client->company_name }}</p>
        <p><strong>Email: </strong>{{ $item->client->email }}</p>
        <p><strong>Contacto: </strong>{{ $item->client->phone }}</p>
        <p><strong>Website: </strong>{{ $item->client->website }}</p>
        <p><strong>Ao cuidado da empresa: </strong>{{ $item->client->company_id }}</p>
        <p><strong>Criado em: </strong>{{ $item->client->created_at }}</p>
    </div>
    <div class="col">
        <h4>Histórico</h4>
        <div class="well">
            A primavera chegou, trazendo consigo um clima mais ameno e colorido. As flores começam a
            desabrochar e os dias a ficar mais longos. É uma época de renovação e esperança, que nos
            convida a apreciar a beleza da natureza e a valorizar as coisas simples da vida. Que
            possamos aproveitar ao máximo essa estação e renovar nossas energias.
            <br><small>2023-02-03 12:00:30</small>
        </div>
        <div class="well">
            A primavera traz renovação e esperança. Aproveite ao máximo essa
            estação.<br><small>2023-02-03 12:00:30</small>
        </div>
        <div class="well">
            A primavera chegou, trazendo consigo um clima mais ameno e colorido. As flores começam a
            desabrochar e os dias a ficar mais longos. É uma época de renovação e esperança, que nos
            convida a apreciar a beleza da natureza e a valorizar as coisas simples da vida. Que
            possamos aproveitar ao máximo essa estação e renovar nossas energias.
            <br><small>2023-02-03 12:00:30</small>
        </div>
        <div class="well">
            A primavera traz renovação e esperança. Aproveite ao máximo essa
            estação.<br><small>2023-02-03 12:00:30</small>
        </div>
    </div>
</div>