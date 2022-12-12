@extends('layouts.padrao')

@section('content')
    <div class="vh-100">
        @livewire('lancamentos.cadastrar', key('lancamentos.cadastrar'))
    </div>
@endsection
