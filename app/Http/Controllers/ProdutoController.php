<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produto\StoreProduto;
use App\Http\Requests\Produto\UpdateProduto;
use App\Http\Resources\Transformers\Produto\ProdutoResource;
use App\Http\Resources\Transformers\Produto\ProdutoResourceCollection;
use App\Models\Produto;
use App\Services\ResponseService;
use Exception;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private $produto;

    public function __construct(Produto $produto){
        $this->produto = $produto;
     }

    public function store(StoreProduto $request){

        try {
            $produto = $this->produto->create([
                'nome' => $request->get('nome'),
                'unidade' => $request->get('unidade'),
                'status' => 'ATIVO',
                'usuario_id' => $request->get('usuario_id'),
            ]);
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('produtos.store', null, $e);
        }

        return new ProdutoResource($produto, ['route' => 'produtos.store', 'type' => 'store']);
    }

    public function show(){
        try {

            $produtos = $this->produto->paginate();

        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('produtos.show', null, $e);
        }

        return new ProdutoResourceCollection($produtos);
    }

    public function update($id, UpdateProduto $request){
        try {
            $produto = $this->produto->find($id);
            $produto->nome = $request->get('nome');
            $produto->unidade = $request->get('unidade');
            $produto->status = $request->get('status');
            $produto->usuario_id = $request->get('usuario_id');
            $produto->save();

        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('produtos.update', $id, $e);
        }

        return new ProdutoResource($produto, ['route' => 'produtos.update', 'type' => 'update', 'id' => $id]);
    }

    public function detalhes($id){

        try {
            $produto = $this->produto->find($id);

            if(!$produto){
                throw new Exception("Produto não encontrado!");
            }

            return new ProdutoResource($produto, ['route' => 'produtos.detalhes', 'type' => 'detalhes', 'id' => $id]);

        } catch (\Throwable|\Exception $e) {

            return ResponseService::exception('produtos.detalhes', $id, $e);
        }

    }

    public function destroy($id){

        try {

            $produto = $this->produto->destroy($id);

        } catch (\Throwable|\Exception $e) {

            return ResponseService::exception('produtos.detalhes', $id, $e);
        }

        return ResponseService::default(['route' => 'produtos.destroy', 'type' => 'destroy'], $id);

    }
}