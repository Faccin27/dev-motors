<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        return view('admin.marcas.index', compact('marcas'));
    }
    
    public function create()
    {
        return view('admin.marcas.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:marcas',
        ]);
        
        Marca::create($validated);
        
        return redirect()->route('admin.marcas.index')
                         ->with('success', 'Marca criada com sucesso!');
    }
    
    public function edit(Marca $marca)
    {
        return view('admin.marcas.edit', compact('marca'));
    }
    
    public function update(Request $request, Marca $marca)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:marcas,nome,'.$marca->id,
        ]);
        
        $marca->update($validated);
        
        return redirect()->route('admin.marcas.index')
                         ->with('success', 'Marca atualizada com sucesso!');
    }
    
    public function destroy(Marca $marca)
    {
        $marca->delete();
        
        return redirect()->route('admin.marcas.index')
                         ->with('success', 'Marca removida com sucesso!');
    }
}