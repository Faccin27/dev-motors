<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modelo;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModeloController extends Controller
{
    public function index()
    {
        $modelos = Modelo::with('marca')->get();
        return view('admin.modelos.index', compact('modelos'));
    }
    
    public function create()
    {
        $marcas = Marca::all();
        return view('admin.modelos.create', compact('marcas'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'marca_id' => 'required|exists:marcas,id',
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('modelos')->where(function ($query) use ($request) {
                    return $query->where('marca_id', $request->marca_id);
                }),
            ],
        ]);
        
        Modelo::create($validated);
        
        return redirect()->route('admin.modelos.index')
                         ->with('success', 'Modelo criado com sucesso!');
    }
    
    public function edit(Modelo $modelo)
    {
        $marcas = Marca::all();
        return view('admin.modelos.edit', compact('modelo', 'marcas'));
    }
    
    public function update(Request $request, Modelo $modelo)
    {
        $validated = $request->validate([
            'marca_id' => 'required|exists:marcas,id',
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('modelos')->where(function ($query) use ($request) {
                    return $query->where('marca_id', $request->marca_id);
                })->ignore($modelo->id),
            ],
        ]);
        
        $modelo->update($validated);
        
        return redirect()->route('admin.modelos.index')
                         ->with('success', 'Modelo atualizado com sucesso!');
    }
    
    public function destroy(Modelo $modelo)
    {
        $modelo->delete();
        
        return redirect()->route('admin.modelos.index')
                         ->with('success', 'Modelo removido com sucesso!');
    }
}