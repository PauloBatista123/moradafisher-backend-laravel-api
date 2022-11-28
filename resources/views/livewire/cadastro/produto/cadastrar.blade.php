<div wire:key='modal-cadastrar'>
    <div class="modal-body">
        {{-- Form modal cadastrar --}}

    <form>
        <div class="row">

            <div class="col-12">
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Nome:</label>
                    <input
                        type="text"
                        class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}"
                        id="exampleFormControlInput1"
                        placeholder="name@example.com"
                        wire:model.defer='nome'

                    >
                    @if($errors->has('nome'))
                    <div class="invalid-feedback">
                        {{$errors->first('nome')}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Unidade:</label>
                    <input
                        type="text"
                        class="form-control {{$errors->has('unidade') ? 'is-invalid' : ''}}"
                        id="exampleFormControlInput1"
                        placeholder="Cargo"
                        wire:model.defer='unidade'
                    >
                    @if($errors->has('unidade'))
                    <div class="invalid-feedback">
                        {{$errors->first('unidade')}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
        {{-- Form modal cadastrar --}}
    </div>
        <div class="modal-footer d-grid gap-2 d-block">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button
                type="button"
                class="btn btn-primary"
                wire:click="salvar"
            >
                <i class="fa-solid fa-floppy-disk"></i> Salvar
            </button>
        </div>

</div>
