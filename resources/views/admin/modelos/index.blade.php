@extends('layouts.admin')

@section('title', 'Modelos')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Modelos</h1>
        <a href="{{ route('admin.modelos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Novo Modelo
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            @if($modelos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Marca</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modelos as $modelo)
                                <tr>
                                    <td>{{ $modelo->id }}</td>
                                    <td>{{ $modelo->nome }}</td>
                                    <td>{{ $modelo->marca->nome }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.modelos.edit', $modelo->id) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.modelos.destroy', $modelo->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este modelo?')">
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
                <p>Nenhum modelo cadastrado.</p>
            @endif
        </div>
    </div>
</div>
@endsection