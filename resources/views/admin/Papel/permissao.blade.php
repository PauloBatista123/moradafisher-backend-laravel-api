@extends('layouts.padrao')

@section('content')
    @livewire('papel.permissao', ['papel_id' => $id] ,key('papel.permissao'))
@endsection
