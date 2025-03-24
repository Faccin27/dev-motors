@extends('layouts.site')

@section('title', $veiculo->nome)
@vite('resources/css/app.css')
@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="vehicle-details bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold text-blue-600 mb-6">{{ $veiculo->nome }}</h1>
        
        <!-- Galeria de imagens -->
        <div class="vehicle-gallery mb-8">
            @if($veiculo->fotos->count() > 0)
                <div class="main-image mb-4">
                    <!-- Imagem principal com tamanho fixo -->
                    <img src="{{ asset('storage/' . $veiculo->fotos->first()->caminho) }}" alt="{{ $veiculo->nome }}" id="main-image" class="w-full h-32 object-cover rounded-lg shadow-md">
                </div>
                <div class="thumbnails flex space-x-4">
                    @foreach($veiculo->fotos as $foto)
                        <div class="thumbnail cursor-pointer border-2 border-transparent hover:border-blue-500 transition duration-300 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $foto->caminho) }}" alt="{{ $veiculo->nome }}" class="w-20 h-20 object-cover">
                        </div>
                    @endforeach
                </div>
            @else
                <div class="main-image mb-4">
                    <img src="{{ asset('img/no-image.jpg') }}" alt="Sem imagem" class="w-full h-96 object-cover rounded-lg shadow-md">
                </div>
            @endif
        </div>
        
        <!-- Informações do veículo -->
        <div class="vehicle-info grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="info-section bg-blue-50 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-blue-600 mb-4">Informações do Veículo</h2>
                <p><strong class="font-semibold">Marca:</strong> {{ $veiculo->modelo->marca->nome }}</p>
                <p><strong class="font-semibold">Modelo:</strong> {{ $veiculo->modelo->nome }}</p>
                <p><strong class="font-semibold">Ano:</strong> {{ $veiculo->ano }}</p>
                <p><strong class="font-semibold">Valor:</strong> R$ {{ number_format($veiculo->valor, 2, ',', '.') }}</p>
            </div>
            
            <div class="description-section bg-blue-50 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-blue-600 mb-4">Descrição</h2>
                <p>{{ $veiculo->descricao }}</p>
            </div>
        </div>
        
        <!-- Formulário de interesse -->
        <div class="interest-form mt-8 bg-blue-50 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-blue-600 mb-4">Tenho Interesse</h2>
            
            @if(session('success'))
                <div class="alert alert-success mb-4 p-4 bg-green-100 text-green-700 border border-green-400 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('site.lead.store') }}" method="POST">
                @csrf
                <input type="hidden" name="veiculo_id" value="{{ $veiculo->id }}">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div class="form-group">
                        <label for="nome" class="block font-semibold text-blue-600">Nome:</label>
                        <input type="text" name="nome" id="nome" class="form-control w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="block font-semibold text-blue-600">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div class="form-group">
                        <label for="telefone" class="block font-semibold text-blue-600">Telefone:</label>
                        <input type="text" name="telefone" id="telefone" class="form-control w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cidade" class="block font-semibold text-blue-600">Cidade:</label>
                        <input type="text" name="cidade" id="cidade" class="form-control w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div class="form-group">
                        <label for="estado" class="block font-semibold text-blue-600">Estado:</label>
                        <input type="text" name="estado" id="estado" class="form-control w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" maxlength="2" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="mensagem" class="block font-semibold text-blue-600">Mensagem:</label>
                        <textarea name="mensagem" id="mensagem" class="form-control w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" rows="5" required></textarea>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary w-full bg-blue-600 text-white py-4 rounded-lg hover:bg-blue-700 transition duration-300 text-lg">Enviar Mensagem</button>
            </form>
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
