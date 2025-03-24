@extends('layouts.site')

@section('title', $veiculo->nome)

@section('content')
<div class="container">
    <div class="vehicle-details">
        <h1>{{ $veiculo->nome }}</h1>
        
        <div class="vehicle-gallery">
            @if($veiculo->fotos->count() > 0)
                <div class="main-image">
                    <img src="{{ asset('storage/' . $veiculo->fotos->first()->caminho) }}" alt="{{ $veiculo->nome }}" id="main-image">
                </div>
                <div class="thumbnails">
                    @foreach($veiculo->fotos as $foto)
                        <div class="thumbnail" data-image="{{ asset('storage/' . $foto->caminho) }}">
                            <img src="{{ asset('storage/' . $foto->caminho) }}" alt="{{ $veiculo->nome }}">
                        </div>
                    @endforeach
                </div>
            @else
                <div class="main-image">
                    <img src="{{ asset('img/no-image.jpg') }}" alt="Sem imagem">
                </div>
            @endif
        </div>
        
        <div class="vehicle-info">
            <div class="info-section">
                <h2>Informações do Veículo</h2>
                <p><strong>Marca:</strong> {{ $veiculo->modelo->marca->nome }}</p>
                <p><strong>Modelo:</strong> {{ $veiculo->modelo->nome }}</p>
                <p><strong>Ano:</strong> {{ $veiculo->ano }}</p>
                <p><strong>Valor:</strong> R$ {{ number_format($veiculo->valor, 2, ',', '.') }}</p>
            </div>
            
            <div class="description-section">
                <h2>Descrição</h2>
                <p>{{ $veiculo->descricao }}</p>
            </div>
            
            <div class="interest-form">
                <h2>Tenho Interesse</h2>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('site.lead.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="veiculo_id" value="{{ $veiculo->id }}">
                    
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cidade">Cidade:</label>
                        <input type="text" name="cidade" id="cidade" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <input type="text" name="estado" id="estado" class="form-control" maxlength="2" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="mensagem">Mensagem:</label>
                        <textarea name="mensagem" id="mensagem" class="form-control" rows="5" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Galeria de imagens
        const thumbnails = document.querySelectorAll('.thumbnail');
        const mainImage = document.getElementById('main-image');
        
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                const imageUrl = this.dataset.image;
                mainImage.src = imageUrl;
            });
        });
    });
</script>
@endsection