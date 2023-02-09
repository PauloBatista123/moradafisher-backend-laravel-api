@extends('layouts.padrao')

@section('content')
    @livewire('usuario.index', key('usuario.index'))
    {{-- modal cadastrar --}}

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-full modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar novo usuário</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                    @livewire('usuario.cadastrar', key('usuario.cadastrar'))

                </div>
            </div>
        </div>

        <div class="modal fade" id="staticBackdropAlterar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-full modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Alterar usuário</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                    @livewire('usuario.alterar', key('usuario.alterar'))

                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                window.addEventListener('close-modal', event => {
                    $('#staticBackdrop').modal('hide');
                })
                window.addEventListener('close-modal-editar', event => {
                    $('#staticBackdropAlterar').modal('hide');
                })
                window.addEventListener('open-modal-editar', event => {
                    $('#staticBackdropAlterar').modal('show');
                })
            </script>
        @endpush

@endsection
