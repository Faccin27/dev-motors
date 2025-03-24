@extends('layouts.admin')

@section('title', 'Leads')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Leads</h1>
    </div>
    
    <div class="card">
        <div class="card-body">
            @if($leads->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Veículo</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leads as $lead)
                                <tr>
                                    <td>{{ $lead->id }}</td>
                                    <td>{{ $lead->nome }}</td>
                                    <td>{{ $lead->email }}</td>
                                    <td>{{ $lead->telefone }}</td>
                                    <td>
                                        @if($lead->veiculo)
                                            {{ $lead->veiculo->nome }}
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ $lead->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este lead?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            @else
                <p>Nenhum lead cadastrado.</p>
            @endif
        </div>
    </div>
</div>
@endsection