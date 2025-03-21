<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Veiculo;
use App\Models\Marca;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Veiculo::with(['modelo.marca', 'fotos']);
        
        // Filtro por marca
        if ($request->has('marca') && $request->marca) {
            $query->whereHas('modelo.marca', function($q) use ($request) {
                $q->where('id', $request->marca);
            });
        }
        
        // Filtro por modelo
        if ($request->has('modelo') && $request->modelo) {
            $query->where('modelo_id', $request->modelo);
        }
        
        // Filtro por ano
        if ($request->has('ano') && $request->ano) {
            $query->where('ano', $request->ano);
        }
        
        $veiculos = $query->paginate(9);
        $marcas = Marca::all();
        
        return view('site.home', compact('veiculos', 'marcas'));
    }
}