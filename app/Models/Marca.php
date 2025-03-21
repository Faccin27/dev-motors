<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = ['nome'];
    
    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }
}

