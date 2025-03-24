@extends('layouts.admin')

@section('title', 'Marcas')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Marcas</h1>
        <a href="{{ route('admin.marcas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nova Marca
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            @if($marcas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($marcas as $marca)
                                <tr>
                                    <td>{{ $marca->id }}</td>
                                    <td>{{ $marca->nome }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.marcas.edit', $marca->id) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.marcas.destroy', $marca->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta marca?')">
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
                <p>Nenhuma marca cadastrada.</p>
            @endif
        </div>
    </div>
</div>
@endsection