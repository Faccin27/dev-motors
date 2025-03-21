<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Veiculo;
use App\Models\Modelo;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VeiculoController extends Controller
{
    public function index()
    {
        $veiculos = Veiculo::with(['modelo.marca', 'fotos'])->get();
        return view('admin.veiculos.index', compact('veiculos'));
    }
    
    public function create()
    {
        $modelos = Modelo::with('marca')->get();
        return view('admin.veiculos.create', compact('modelos'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'modelo_id' => 'required|exists:modelos,id',
            'nome' => 'required|string|max:255|unique:veiculos',
            'valor' => 'required|numeric|gt:0',
            'ano' => 'required|integer|gt:0',
            'descricao' => 'required|string',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $veiculo = Veiculo::create([
            'modelo_id' => $validated['modelo_id'],
            'nome' => $validated['nome'],
            'valor' => $validated['valor'],
            'ano' => $validated['ano'],
            'descricao' => $validated['descricao'],
        ]);
        
        if($request->hasFile('fotos')) {
            foreach($request->file('fotos') as $foto) {
                $path = $foto->store('veiculos', 'public');
                
                Foto::create([
                    'veiculo_id' => $veiculo->id,
                    'caminho' => $path,
                ]);
            }
        }
        
        return redirect()->route('admin.veiculos.index')
                         ->with('success', 'Veículo criado com sucesso!');
    }
    
    public function edit(Veiculo $veiculo)
    {
        $modelos = Modelo::with('marca')->get();
        return view('admin.veiculos.edit', compact('veiculo', 'modelos'));
    }
    
    public function update(Request $request, Veiculo $veiculo)
    {
        $validated = $request->validate([
            'modelo_id' => 'required|exists:modelos,id',
            'nome' => 'required|string|max:255|unique:veiculos,nome,'.$veiculo->id,
            'valor' => 'required|numeric|gt:0',
            'ano' => 'required|integer|gt:0',
            'descricao' => 'required|string',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $veiculo->update([
            'modelo_id' => $validated['modelo_id'],
            'nome' => $validated['nome'],
            'valor' => $validated['valor'],
            'ano' => $validated['ano'],
            'descricao' => $validated['descricao'],
        ]);
        
        if($request->hasFile('fotos')) {
            foreach($request->file('fotos') as $foto) {
                $path = $foto->store('veiculos', 'public');
                
                Foto::create([
                    'veiculo_id' => $veiculo->id,
                    'caminho' => $path,
                ]);
            }
        }
        
        return redirect()->route('admin.veiculos.index')
                         ->with('success', 'Veículo atualizado com sucesso!');
    }
    
    public function destroy(Veiculo $veiculo)
    {
        // Excluir as fotos do armazenamento
        foreach($veiculo->fotos as $foto) {
            Storage::disk('public')->delete($foto->caminho);
            $foto->delete();
        }
        
        $veiculo->delete();
        
        return redirect()->route('admin.veiculos.index')
                         ->with('success', 'Veículo removido com sucesso!');
    }
    
    public function deleteFoto($id)
    {
        $foto = Foto::findOrFail($id);
        Storage::disk('public')->delete($foto->caminho);
        $foto->delete();
        
        return redirect()->back()->with('success', 'Foto removida com sucesso!');
    }
}