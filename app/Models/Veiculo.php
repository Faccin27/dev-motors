<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $fillable = ['modelo_id', 'nome', 'valor', 'ano', 'descricao'];
    
    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }
    
    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
    
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}