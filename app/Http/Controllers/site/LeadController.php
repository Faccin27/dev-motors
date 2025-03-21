<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'veiculo_id' => 'required|exists:veiculos,id',
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'mensagem' => 'required|string',
        ]);
        
        Lead::create($validated);
        
        return redirect()->back()->with('success', 'Sua mensagem foi enviada com sucesso!');
    }
}