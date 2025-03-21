<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    public function show($id)
    {
        $veiculo = Veiculo::with(['modelo.marca', 'fotos'])->findOrFail($id);
        return view('site.veiculo', compact('veiculo'));
    }
}