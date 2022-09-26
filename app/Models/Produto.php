<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'unidade',
        'usuario_id',
        'status',
    ];

    public function usuario(){
        return $this->belongsTo(User::class, "usuario_id", "id");
    }

    public function lancamentos(){
        return $this->hasMany(Lancamento::class, 'produto_id', 'id');
    }
}
