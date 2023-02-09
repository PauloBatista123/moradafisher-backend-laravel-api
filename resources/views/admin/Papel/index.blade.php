@extends('layouts.padrao')

@section('content')
    @livewire('papel.index', key('funcionario.index'))
    {{-- modal cadastrar --}}

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-full modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar novo perfil</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                    @livewire('papel.cadastrar', key('papel.cadastrar'))

                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                window.addEventListener('close-modal', event => {
                    $('#staticBackdrop').modal('hide');
                })
            </script>
        @endpush

@endsection
