<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Adicionar permissões ao perfil {{$perfil->nome}}</h1>
    </div>
        @foreach($grupo as $key => $g)
        <div class="row">
        <div class="col-12 my-3">
            <div class="card shadow h-100">
                <div class="card-header">
                    <h3>Grupo {{$g->nome}}</h3>
                </div>
            </div>
        </div>
        @foreach($permissao as $p)
        @if($p->grupo_permissao_id === $g->id)
        <div class="col-md-3 col-sm-1 mb-4" wire:key="registro-id-{{$p->id}}">
            <div class="card border-left-primary shadow h-100 ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 ">
                                {{$p->nome}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">{{$p->descricao}}</div>
                        </div>
                        <div class="col-auto">
                            @if(!\App\Models\User::existePermissao($p->id, $perfil->id))
                            <button
                                class="btn btn-outline-success mr-1 mb-1"
                                type="button"
                                wire:click="adicionar({{$p->id}})"
                            >
                            <i class="fa-solid fa-check"></i>
                        </button>
                            @else
                            <button
                                class="btn btn-outline-danger mr-1 mb-1"
                                type="button"
                                wire:click="remover({{$p->id}})"
                            >
                            <i class="fa-solid fa-trash"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach

    </div>
    @endforeach

</div>
