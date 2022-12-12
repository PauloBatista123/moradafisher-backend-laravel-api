<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lancamentos</h1>
        <a type="button" class="btn btn-primary" href="{{route('lancamentos.cadastrar')}}">
            <i class="fa-solid fa-plus"></i>
            Adicionar
        </a>
    </div>
    <div class="row">
    @forelse ($lancamentos as $item)
    <div class="col-xl-4 col-md-6 col-sm-1 mb-4" wire:key='lancamento-{{$item->id}}'>
        <div class="card {{$item->tipo === 'ENTRADA' ? 'border-left-primary' : 'border-left-success' }} shadow h-100 py-2">
            <div class="card-body">
                <div class="row align-items-left">
                    <div class="col mb-2">
                        <div class="text-xs">
                            Funcionário
                        </div>
                        <div class="h5 font-weight-bold text-uppercase">
                            {{$item->funcionario->nome}}
                        </div>
                    </div>
                    <hr class="border border-2">
                </div>
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl font-weight-bold {{$item->tipo === 'ENTRADA' ? 'text-primary' : 'text-success' }} text-uppercase mb-1">
                            {{$item->tipo}}: {{$item->produto->nome}}
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$item->peso}} {{$item->produto->unidade}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <div class="d-flex flex-column text-xs">
                        <span>Criado em {{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y h:m')}} por {{$item->usuario->name}}</span>
                    </div>
                    <div class="justify-content-rigth">
                        <button wire:click='confirmDelete({{$item->id}})' type="button" class="btn btn-outline-info">Deletar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @empty

    @endforelse
    </div>
    <div class="row">
        <div class="col-12">
            {{$lancamentos->links()}}
        </div>
    </div>
</div>
