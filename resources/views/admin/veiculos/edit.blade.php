@extends('layouts.admin')

@section('title', 'Editar Veículo')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Editar Veículo</h1>
        <a href="{{ route('admin.veiculos.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.veiculos.update', $veiculo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="modelo_id" class="form-label">Modelo</label>
                    <select class="form-select @error('modelo_id') is-invalid @enderror" id="modelo_id" name="modelo_id" required>
                        <option value="">Selecione um modelo</option>
                        @foreach($modelos as $modelo)
                            <option value="{{ $modelo->id }}" {{ old('modelo_id', $veiculo->modelo_id) == $modelo->id ? 'selected' : '' }}>
                                {{ $modelo->marca->nome }} - {{ $modelo->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('modelo_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', $veiculo->nome) }}" required>
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input type="number" class="form-control @error('valor') is-invalid @enderror" id="valor" name="valor" value="{{ old('valor', $veiculo->valor) }}" step="0.01" min="0.01" required>
                                @error('valor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="ano" class="form-label">Ano</label>
                            <input type="number" class="form-control @error('ano') is-invalid @enderror" id="ano" name="ano" value="{{ old('ano', $veiculo->ano) }}" min="1900" max="{{ date('Y') + 1 }}" required>
                            @error('ano')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="5" required>{{ old('descricao', $veiculo->descricao) }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Fotos Atuais</label>
                    <div class="row">
                        @if($veiculo->fotos->count() > 0)
                            @foreach($veiculo->fotos as $foto)
                                <div class="col-md-3 mb-3">
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $foto->caminho) }}" class="img-thumbnail" alt="Foto do veículo">
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <div class="alert alert-info">
                                    Nenhuma foto cadastrada para este veículo.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="fotos" class="form-label">Adicionar Novas Fotos</label>
                    <input type="file" class="form-control @error('fotos.*') is-invalid @enderror" id="fotos" name="fotos[]" multiple accept="image/*">
                    <div class="form-text">Selecione uma ou mais fotos do veículo.</div>
                    @error('fotos.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
        </div>
    </div>
</div>
@endsection