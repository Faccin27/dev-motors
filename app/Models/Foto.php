<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = ['veiculo_id', 'caminho'];
    
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
