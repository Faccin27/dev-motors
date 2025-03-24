@extends('layouts.site')

@section('title', 'Veículos')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-gray-100 p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-2xl font-semibold mb-4">Filtrar Veículos</h2>
        <form action="{{ route('site.home') }}" method="GET" id="filter-form" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="marca" class="block font-medium mb-1">Marca:</label>
                <select name="marca" id="marca" class="w-full p-2 border rounded">
                    <option value="">Todas as marcas</option>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->id }}" {{ request('marca') == $marca->id ? 'selected' : '' }}>
                            {{ $marca->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="modelo" class="block font-medium mb-1">Modelo:</label>
                <select name="modelo" id="modelo" class="w-full p-2 border rounded">
                    <option value="">Todos os modelos</option>
                </select>
            </div>
            
            <div>
                <label for="ano" class="block font-medium mb-1">Ano:</label>
                <input type="number" name="ano" id="ano" class="w-full p-2 border rounded" value="{{ request('ano') }}">
            </div>
            
            <div class="col-span-1 md:col-span-3 flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filtrar</button>
            </div>
        </form>
    </div>
    
    <div>
        <h2 class="text-2xl font-semibold mb-4">Veículos Disponíveis</h2>
        
        @if($veiculos->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($veiculos as $veiculo)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            <img src="{{ $veiculo->fotos->count() > 0 ? asset('storage/' . $veiculo->fotos->first()->caminho) : asset('img/no-image.jpg') }}" 
                                alt="{{ $veiculo->nome }}" 
                                class="h-full w-full object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-bold">{{ $veiculo->nome }}</h3>
                            <p><strong>Marca:</strong> {{ $veiculo->modelo->marca->nome }}</p>
                            <p><strong>Modelo:</strong> {{ $veiculo->modelo->nome }}</p>
                            <p><strong>Ano:</strong> {{ $veiculo->ano }}</p>
                            <p><strong>Valor:</strong> R$ {{ number_format($veiculo->valor, 2, ',', '.') }}</p>
                            <a href="{{ route('site.veiculo.show', $veiculo->id) }}" class="mt-2 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ver detalhes</a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $veiculos->links() }}
            </div>
        @else
            <p class="text-gray-500">Nenhum veículo encontrado.</p>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const marcaSelect = document.getElementById('marca');
        const modeloSelect = document.getElementById('modelo');
        
        function loadModelos() {
            const marcaId = marcaSelect.value;
            modeloSelect.innerHTML = '<option value="">Todos os modelos</option>';
            
            if (marcaId) {
                fetch(`/modelos/${marcaId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(modelo => {
                            const option = document.createElement('option');
                            option.value = modelo.id;
                            option.textContent = modelo.nome;
                            option.selected = modelo.id == "{{ request('modelo') }}";
                            modeloSelect.appendChild(option);
                        });
                    });
            }
        }
        
        loadModelos();
        marcaSelect.addEventListener('change', loadModelos);
    });
</script>
@endsection