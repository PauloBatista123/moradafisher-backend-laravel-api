<?php

namespace App\Http\Controllers;

class PapelController extends Controller
{
    public function index()
    {
        abort_if(!Auth()->user()->can('usuario_perfil'), 403);

        return view('admin.Papel.index');
    }

    public function adicionar()
    {

        abort_if(!Auth()->user()->can('usuario_perfil'), 403);

        return view('admin.cadastro.papel.adicionar');
    }

    public function permissao($id)
    {
        return view('admin.Papel.permissao', [
            'id' => $id,
        ]);
    }

}
