<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $fillable = ['marca_id', 'nome'];
    
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
    
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }
}

