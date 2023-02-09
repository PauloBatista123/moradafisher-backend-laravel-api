<div>
    <div class="row">
        @forelse ($lancamentos as $item)
        <div class="col mt-2">
            <div class="card {{$item->tipo === 'ENTRADA' ? 'border-left-primary': 'border-left-success'}} shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold {{$item->tipo === 'ENTRADA' ? 'text-primary': 'text-success'}}  text-uppercase mb-1">
                                {{$item->tipo}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($item->peso, 4, ',', '.')}}</div>
                            <div class="text-sm font-weight-light text-muted">Funcionário:{{$item->funcionario->nome}}</div>
                        </div>
                        <div class="col-auto justify-content-start align-items-start">
                            <button type="button" class="btn btn-outline-danger btn-sm" wire:click='confirmDelete({{$item->id}})'><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center text-xs text-muted">
                        Criado {{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="col">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 placeholder-glow">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Aguardando lançamentos...
                                </div>
                                <div class="placeholder w-100 h5 mb-0 font-weight-bold text-gray-800">-</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
