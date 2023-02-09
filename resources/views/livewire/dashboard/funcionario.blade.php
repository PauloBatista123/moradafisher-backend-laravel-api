<div>
    <div class="row">
        <div class="d-flex align-items-top justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">Relatório detalhado por Funcionário</h1>
            <div class="align-content-center">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Filtro</button>
            </div>
        </div>
    </div>

    <hr class="">

    @if($isFiltered)

        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex align-items-top justify-content-between flex-row">
                            <h4 class="mb-1 text-secondary fw-semibold text-primary">{{$funcionarioSelected->nome}}</h4>
                            <span>{{$funcionarioSelected->cargo}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                   {{count($listaEntradas)}} ENTRADAS</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($entradasTotal, 4, ',','.')}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    {{count($listaSaidas)}} SAÍDAS</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($saidasTotal, 4, ',','.')}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    APROVEITAMENTO TOTAL</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($aproveitamento, 4, ',','.')}}%</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        Lançamentos de {{$isMonth === 'dia' ? \Carbon\Carbon::parse($date)->format('d/m/Y') : \Carbon\Carbon::parse($date)->format('m/Y')}}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="fw-bold fs-4">Entradas</span>
                                <div class="text-left">
                                    @foreach ($listaEntradas as $entrada)
                                        <div class="card">
                                            <div class="card-body d-flex flex-column justify-content-start">
                                                <span class="fw-bold fs-5 text-primary">
                                                    {{$entrada['peso']}}
                                                </span>
                                                <span class="text-xs">
                                                    {{$entrada['created_at']}}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col">
                                <span class="fw-bold fs-4">Saídas</span>
                                <div class="text-left">
                                    @foreach ($listaSaidas as $saida)
                                        <div class="card">
                                            <div class="card-body d-flex flex-column justify-content-start">
                                                <span class="fw-bold fs-5 text-success">
                                                    {{$saida['peso']}}
                                                </span>
                                                <span class="text-xs">
                                                    {{$saida['created_at']}}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="row">
            <div class="text-center">
                <div class="error mx-auto" data-text="Ops!">Ops!</div>
                <p class="lead text-gray-800 mb-5">Aguardando resultados...</p>
                <p class="text-gray-500 mb-0">Utilize o filtro para exibir resultados aqui...</p>
                <a href="{{route('dashboard.index')}}">← Voltar</a>
            </div>
        </div>
    @endif

    {{-- offcavnas filtro --}}
    <div class="offcanvas offcanvas-end" wire:ignore tabindex="-1" id="offcanvasRight" wire:target='filtrar' wire:loading.class.remove='show' aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasRightLabel">Filtrar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div class="row mb-2">
            <div class="form-floating">
                <select class="form-select" id="floatingSelect" aria-label="Floating label select example" wire:model.lazy='funcionarioId'>
                  <option value="">Selecione</option>
                  @foreach ($allFuncionario as $funcionario)
                    <option value="{{$funcionario->id}}">{{$funcionario->nome}}</option>
                  @endforeach
                </select>
                <label for="floatingSelect">Funcionário</label>
              </div>
          </div>
          <div class="mb-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="isMonth" id="inlineRadio1" value="mes" wire:model.lazy='isMonth'>
                <label class="form-check-label" for="inlineRadio1">Mensal</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="isMonth" id="inlineRadio2" value="dia" wire:model.lazy='isMonth'>
                <label class="form-check-label" for="inlineRadio2">Diário</label>
            </div>
          </div>
          <div class="row">
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" placeholder="name@example.com" wire:model.lazy='date'>
                <label for="floatingInput">{{$isMonth === true ? 'Mês' : 'Data'}}</label>
              </div>
          </div>
          <div class="row">
            <button type="button" wire:click='filtrar' class="btn btn-primary block mt-4">Filtrar</button>
          </div>
        </div>
    </div>
    {{-- offcavnas filtro --}}

    @push('scripts')
        <script>
            const bsOffcanvas = new bootstrap.Offcanvas('#offcanvasRight');

            window.addEventListener('close-offCanvas', event => {
                bsOffcanvas.hide();
            })

        </script>
    @endpush
</div>
