<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuários</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fa-solid fa-plus"></i>
            Adicionar
        </button>
    </div>
    <div class="row">
        @forelse($registros as $key => $registro)
        <div class="col-md-6 col-sm-1 mb-4" wire:key="registro-id-{{$registro->id}}">
            <div class="card border-left-primary shadow h-100 ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 ">
                                {{$registro->email}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">{{$registro->name}}</div>
                            <div class="mt-1 font-weight-light text-reset small">Criado em {{\Carbon\Carbon::create($registro->created_at)->format("d/m/Y")}}</div>
                        </div>
                        <div class="col-auto">
                            <button
                                class="btn btn-outline-danger mr-1 mb-1"
                                type="button"
                                wire:click="confirmDelete({{$registro->id}})"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <button
                                wire:click="editar({{$registro->id}})"
                                type="button"
                                class="btn btn-outline-success mr-1 mb-1"
                                data-bs-toggle="modal"
                                data-bs-target="#staticBackdropAlterar">
                                <i class="fa-solid fa-address-card"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @empty
        <h1>Não existe</h1>
    @endforelse
    </div>
    <div class="row">
        <div class="col-12">
            {{$registros->links()}}
        </div>
    </div>
</div>
