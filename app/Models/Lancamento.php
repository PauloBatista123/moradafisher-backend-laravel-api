<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lancamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'peso', 'usuario_id', 'produto_id', 'funcionario_id', 'tipo'
    ];

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function funcionario(){
        return $this->belongsTo(Funcionario::class, 'funcionario_id', 'id');
    }

    public function produto(){
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }
}
