<?php

namespace App\Http\Resources\Transformers\Lancamento;

use App\Services\ResponseService;
use Illuminate\Http\Resources\Json\JsonResource;

class LancamentoResource extends JsonResource
{
    private $config;

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource, $config = array())
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);

        $this->config = $config;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray([
            'id' => $this->id,
            'peso' => $this->peso,
            'usuario' => $this->usuario,
            'funcionario' => $this->funcionario,
            'tipo' => $this->tipo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'produto' => $this->produto,
        ]);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return ResponseService::default($this->config, $this->id);
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param  \Illuminate\Http\Request
     * @param  \Illuminate\Http\Response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->setStatusCode(200);
    }
}
