<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'veiculo_id', 'nome', 'email', 'telefone', 
        'cidade', 'estado', 'mensagem', 'data'
    ];
    
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}