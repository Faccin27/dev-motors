@extends('layouts.admin')

@section('title', 'Novo Modelo')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Novo Modelo</h1>
        <a href="{{ route('admin.modelos.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.modelos.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="marca_id" class="form-label">Marca</label>
                    <select class="form-select @error('marca_id') is-invalid @enderror" id="marca_id" name="marca_id" required>
                        <option value="">Selecione uma marca</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}" {{ old('marca_id') == $marca->id ? 'selected' : '' }}>
                                {{ $marca->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('marca_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" required>
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection