<div>
    <div class="d-flex flex-column flex-sm-row align-items-top justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Dashboard</h1>
        <div class="row align-content-center">
            <div class="input-group input-group-sm mb-3 mt-2 mt-sm-0">
                <span class="input-group-text" id="inputGroup-sizing-sm">Filtro:</span>
                <input type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" wire:model='dataFiltroInicio'>
                <span class="input-group-text" id="inputGroup-sizing-sm">Até</span>
                <input type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" wire:model='dataFiltroFim'>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 m-1 m-sm-0">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Entradas
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{number_format($totalEntradas, 2,',', '.')}}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 m-1 m-sm-0">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Saídas
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{number_format($totalSaidas, 2,',', '.')}}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="border border-secondary border-1 opacity-10 my-4">

    <div class="row">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h6 mb-0 text-gray-800">Funcionários</h1>
        </div>
        <div class="col">
            <div class="card shadow m-0">
                <div class="card-header py-3">Entradas</div>
                <div class="card-body">
                    @foreach($funcionarios as $funcionario)
                        @if($lancByFuncEntradas->contains('funcionario_id', $funcionario->id) || $lancByFuncSaidas->contains('funcionario_id', $funcionario->id))

                            @if($lancByFuncEntradas->firstWhere('funcionario_id', $funcionario->id))
                                <h4 class="small font-weight-bold">
                                    {{$funcionario->nome}}
                                    <span class="float-sm-right mt-sm-0">
                                        {{number_format($lancByFuncEntradas->firstWhere('funcionario_id', $funcionario->id)['total'], 4, ',', '.') ?? 0}}
                                    </span>
                                </h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                    style="width: {{$lancByFuncEntradas->firstWhere('funcionario_id', $funcionario->id)['total'] ?  $lancByFuncEntradas->firstWhere('funcionario_id', $funcionario->id)['total'] / $totalEntradas * 100 : 0}}%"
                                    aria-valuenow="{{$lancByFuncEntradas->firstWhere('funcionario_id', $funcionario->id)['total'] ?  $lancByFuncEntradas->firstWhere('funcionario_id', $funcionario->id)['total'] / $totalEntradas * 100 : 0}}" aria-valuemin="0" aria-valuemax="100">
                                    {{number_format($lancByFuncEntradas->firstWhere('funcionario_id', $funcionario->id)['total'] ?  $lancByFuncEntradas->firstWhere('funcionario_id', $funcionario->id)['total'] / $totalEntradas * 100 : 0, 2)}}%
                                    </div>
                                </div>
                            @else
                                <h4 class="small font-weight-bold">
                                    {{$funcionario->nome}}
                                    <span class="float-right">
                                        0,0000
                                    </span>
                                </h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                    style="width: {{0}}%"
                                    aria-valuenow="width: {{0}}%" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            @endif

                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow m-0">
                <div class="card-header py-3">Saídas</div>
                <div class="card-body">
                    @foreach($funcionarios as $funcionario)
                        @if($lancByFuncEntradas->contains('funcionario_id', $funcionario->id) || $lancByFuncSaidas->contains('funcionario_id', $funcionario->id))

                            @if($lancByFuncSaidas->firstWhere('funcionario_id', $funcionario->id))
                                <h4 class="small font-weight-bold">
                                    {{$funcionario->nome}}
                                    <span class="float-sm-right mt-sm-0">
                                        {{number_format($lancByFuncSaidas->firstWhere('funcionario_id', $funcionario->id)['total'], 4, ',', '.') ?? 0}}
                                    </span>
                                </h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{$lancByFuncSaidas->firstWhere('funcionario_id', $funcionario->id)['total'] ?  $lancByFuncSaidas->firstWhere('funcionario_id', $funcionario->id)['total'] / $totalSaidas * 100 : 0}}%"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    {{number_format($lancByFuncSaidas->firstWhere('funcionario_id', $funcionario->id)['total'] ?  $lancByFuncSaidas->firstWhere('funcionario_id', $funcionario->id)['total'] / $totalSaidas * 100 : 0, 2)}}%

                                    </div>
                                </div>
                                @else
                                <h4 class="small font-weight-bold">
                                    {{$funcionario->nome}}
                                    <span class="float-right">
                                        0,0000
                                    </span>
                                </h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{0}}%"
                                    aria-valuenow="width: {{0}}%" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            @endif

                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <hr class="border border-secondary border-1 opacity-10 my-4">

    <div class="row">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h6 mb-0 text-gray-800">Por Lançamentos</h1>
        </div>
    </div>

    <div class="row">
        @foreach ($funcionarios as $funcionario)
            @if($lancamentosEntradas->contains('funcionario_id', $funcionario->id) || $lancamentosSaidas->contains('funcionario_id', $funcionario->id))
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card shadow my-2">
                    <div class="card-header">
                        {{$funcionario->nome}}
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-small">ENTRADAS</span>
                            @foreach($lancamentosEntradas->where('funcionario_id', $funcionario->id) as $lancEntrada)
                            <div class="border shadow-sm border-1 rounded p-1 mb-1 d-flex flex-column">
                                <div>
                                    <span class="text-xs">{{$lancEntrada->dataFormat}}</span>
                                </div>
                                <span class="text-sm fw-bold text-primary"> {{number_format($lancEntrada->peso, 4, ',', '.')}}</span>
                            </div>
                            @endforeach
                        </div>
                        <div class="d-flex flex-column text-end">
                            <span class="fw-bold text-small">SAÍDAS</span>
                            @foreach($lancamentosSaidas->where('funcionario_id', $funcionario->id) as $lancSaida)
                            <div class="border shadow-sm border-1 rounded p-1 mb-1 d-flex flex-column">
                                <div>
                                    <span class="text-xs">{{$lancSaida->dataFormat}}</span>
                                </div>
                                <span class="text-sm fw-bold text-success"> {{number_format($lancSaida->peso, 4, ',', '.')}}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold text-small">{{number_format($lancamentosEntradas->where('funcionario_id', $funcionario->id)->sum('peso'), 4, ',', '.')}}</span>
                            <span class="fw-bold text-small">{{number_format($lancamentosSaidas->where('funcionario_id', $funcionario->id)->sum('peso'), 4, ',', '.')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</div>
