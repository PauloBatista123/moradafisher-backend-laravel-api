@extends('layouts.padrao')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-center flex-column">
            <i class="fa-solid fa-road-lock fa-7x fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6;" ></i>
            <h2 class="m-4 fw-bold">Rota bloqueada!!!</h2>
            <span>Que pena... você não possui permissão para acessar o caminho ou realizar uma ação.</span>
        </div>
    </div>
</div>
@endsection
