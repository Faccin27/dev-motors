@extends('layouts.admin')

@section('title', 'Veículos')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Veículos</h1>
        <a href="{{ route('admin.veiculos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Novo Veículo
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            @if($veiculos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Marca/Modelo</th>
                                <th>Ano</th>
                                <th>Valor</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($veiculos as $veiculo)
                                <tr>
                                    <td>{{ $veiculo->id }}</td>
                                    <td>
                                        @if($veiculo->fotos->count() > 0)
                                            <img src="{{ asset('storage/' . $veiculo->fotos->first()->caminho) }}" alt="{{ $veiculo->nome }}" style="width: 80px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 80px; height: 60px;">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $veiculo->nome }}</td>
                                    <td>{{ $veiculo->modelo->marca->nome }} / {{ $veiculo->modelo->nome }}</td>
                                    <td>{{ $veiculo->ano }}</td>
                                    <td>R$ {{ number_format($veiculo->valor, 2, ',', '.') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.veiculos.edit', $veiculo->id) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.veiculos.destroy', $veiculo->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este veículo?')">
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
                <p>Nenhum veículo cadastrado.</p>
            @endif
        </div>
    </div>
</div>
@endsection