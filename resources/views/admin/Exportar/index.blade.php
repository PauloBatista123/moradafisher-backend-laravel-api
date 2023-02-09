@extends('layouts.padrao')

@section('content')

    <div class="col-md-4">
        <div class="card shadow">
            @livewire('export.lancamento', key('export.lancamento'))
        </div>
    </div>
@endsection
