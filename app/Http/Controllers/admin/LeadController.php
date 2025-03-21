<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::with('veiculo.modelo.marca')->orderBy('created_at', 'desc')->get();
        return view('admin.leads.index', compact('leads'));
    }
    
    public function show(Lead $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }
    
    public function destroy(Lead $lead)
    {
        $lead->delete();
        
        return redirect()->route('admin.leads.index')
                         ->with('success', 'Lead removido com sucesso!');
    }
}