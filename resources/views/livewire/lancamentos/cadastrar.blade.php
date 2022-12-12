<div>
    <div class="row">
        <div class="col-lg-4 col-md-12 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <select class="form-select form-select-lg mb-3 {{$errors->has('selectFuncionario') ? 'is-invalid' : ''}}" aria-label=".form-select-lg example" wire:model='selectFuncionario'>
                            <option selected value="">Funcionário</option>
                            @foreach ($funcionarios as $item)
                                <option value="{{$item->id}}">{{$item->nome}}</option>
                            @endforeach

                        </select>
                        @if($errors->has('selectFuncionario'))
                        <div class="invalid-feedback">
                            {{$errors->first('selectFuncionario')}}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <select class="form-select form-select-lg mb-3 {{$errors->has('selectFuncionario') ? 'is-invalid' : ''}}" aria-label=".form-select-lg example" wire:model='selectProduto'>
                            <option selected value="">Produto</option>
                            @foreach ($produtos as $produto)
                                <option value="{{$produto->id}}">{{$produto->nome}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('selectProduto'))
                        <div class="invalid-feedback">
                            {{$errors->first('selectProduto')}}
                        </div>
                        @endif
                    </div>
                    <div class="d-flex flex-row justify-content-center">
                        <div role="button" class="card text-white w-50 mr-1 {{$tipo === 'ENTRADA' ? 'bg-gradient-warning fw-bold shadow' : 'bg-secondary'}}" wire:click='tipoEntrada("ENTRADA")'>
                            <div class="card-body text-center">
                                Entrada @if($tipo === 'ENTRADA') <i class="fa-regular fa-circle-check"></i> @endif
                            </div>
                        </div>
                        <div role="button" class="card text-white w-50 ml-1 {{$tipo === 'SAIDA' ? 'bg-gradient-success fw-bold shadow' : 'bg-secondary'}}" wire:click='tipoEntrada("SAIDA")'>
                            <div class="card-body text-center">
                                Saída @if($tipo === 'SAIDA') <i class="fa-regular fa-circle-check"></i> @endif</div>
                        </div>
                    </div>
                    @if($errors->has('tipo'))
                        <div class="text-danger block mt-2" style="font-size: 80%">
                            {{$errors->first('tipo')}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="form-group">
                <div class="input-group input-group-lg mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Peso</span>
                    <input x-mask:dynamic="$money($input, ',')" wire:model.lazy='peso' class="form-control {{$errors->has('peso') ? 'is-invalid' : ''}}">
                    <span class="input-group-text" id="inputGroup-sizing-lg">{{$unidade}}</span>
                    @if($errors->has('peso'))
                    <div class="invalid-feedback">
                        {{$errors->first('peso')}}
                    </div>
                    @endif
                </div>
            </div>

            <div class="card" wire:loading.class='placeholder w-100' wire:target='button'>
                <div class="card-body h2" >

                    {{-- buttons custom --}}
                    <div class="text-center">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-4 mt-1">
                                <div wire:target='button' wire:loading.class='placeholder w-100' role="button" class="card p-4 button-outline-primary custom-buttons" wire:click='button(1)'>
                                    1
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-4 mt-1">
                                <div role="button" wire:target='button' wire:loading.class='placeholder w-100' class="card p-4 button-outline-primary custom-buttons" wire:click='button(2)'>
                                    2
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-4 mt-1">
                                <div role="button" wire:target='button' wire:loading.class='placeholder w-100' class="card p-4 button-outline-primary custom-buttons" wire:click='button(3)'>
                                    3
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-4 mt-1">
                                <div role="button" wire:target='button' wire:loading.class='placeholder w-100' class="card p-4 button-outline-primary custom-buttons" wire:click='button(4)'>
                                    4
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-4 mt-1">
                                <div role="button" wire:target='button' wire:loading.class='placeholder w-100' class="card p-4 button-outline-primary custom-buttons" wire:click='button(5)'>
                                    5
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-4 mt-1">
                                <div role="button" wire:target='button' wire:loading.class='placeholder w-100' class="card p-4 button-outline-primary custom-buttons" wire:click='button(6)'>
                                    6
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-4 mt-1">
                                <div role="button" wire:target='button' wire:loading.class='placeholder w-100' class="card p-4 button-outline-primary custom-buttons" wire:click='button(7)'>
                                    7
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-4 mt-1">
                                <div role="button" wire:target='button' wire:loading.class='placeholder w-100' class="card p-4 button-outline-primary custom-buttons" wire:click='button(8)'>
                                    8
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-4 mt-1">
                                <div role="button" wire:target='button' wire:loading.class='placeholder w-100' class="card p-4 button-outline-primary custom-buttons" wire:click='button(9)'>
                                    9
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 mt-1">
                                <div role="button" wire:target='button' wire:loading.class='placeholder w-100' class="card p-2 button-outline-primary custom-buttons" wire:click='button(0)'>
                                    0
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 mt-1">
                                <div role="button" wire:target='button' wire:loading.class='placeholder w-100' class="card p-2 button-outline-primary custom-buttons" wire:click='button(",")'>
                                    ,
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- buttons custom --}}

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-lg btn-block" wire:click='salvar'>Salvar</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-outline-info btn-lg btn-block" wire:click='limpar'>Limpar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="border border-bottom-light border-2">
    <div class="row">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">Últimos lançamentos</h1>
        </div>
        @livewire('lancamentos.lista', key('lancamentos-lista-mini'))
    </div>
</div>
