@if (isset($category->funnels))
<ul class="nav nav-tabs" role="tablist">
    @foreach ($category->funnels as $key => $funnel)
    <li class="nav-item" role="presentation">
        <button class="text-uppercase nav-link {{ $key == 0 ? 'active' : '' }}" id="{{ $key }}-tab" data-bs-toggle="tab"
            data-bs-target="#{{ $key }}-tab-pane" type="button" role="tab" aria-controls="{{ $key }}-tab-pane"
            aria-selected="true">{{ $funnel->name }}</button>
    </li>
    @endforeach
</ul>
<div class="tab-content">
    @foreach ($category->funnels as $key => $funnel)
    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="{{ $key }}-tab-pane" role="tabpanel"
        aria-labelledby="{{ $key }}-tab" tabindex="0">
        <div class="row mt-4" id="projects">
            @foreach ($funnel->steps as $step)
            <div class="col">
                <div class="card" style="background: {{ $step->state->color }};">
                    <div class="card-header" style="background: {{ $step->state->color }}; color: #ffffff">
                        <h5>{{ $step->name }}<button data-bs-toggle="modal" data-bs-target="#addItem" class="btn btn-link btn-sm float-end" style="color: #fff;"><i class="fas fa-fw fa-plus"></i></button></h5>
                    </div>
                    <div class="card-body" ondrop="drop(event)" ondragover="allowDrop(event)"
                        data-step="{{ $step->id }}">
                        @foreach ($step->stepItems as $item)
                        <div class="card" draggable="true" ondragstart="drag(event)" id="{{ $item->id }}">
                            <div class="card-body" droppable="false">
                                <h5>{{ $item->client->first_name }} {{ $item->client->last_name }}<br><small>{{
                                        $item->name }}</small></h5>
                                <div class="text-muted">
                                    @if ($item->lastInput->count() > 0)
                                    <p>
                                        {{ $item->lastInput[0]->name }}<br>
                                        <small>{{ $item->lastInput[0]->description }}</small>
                                    </p>
                                    <p>
                                        <span class="badge text-bg-primary">Atualizado {{
                                            \Carbon\Carbon::parse($item->lastInput[0]->created_at)->diffForHumans()
                                            }}</span>
                                    </p>
                                    <button class="btn btn-success btn-sm" onclick="openInfo({{ $item->id }})">Informação</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@else
<div class="alert alert-primary" role="alert">
    Não existem funís atribuidos!
</div>
@endif