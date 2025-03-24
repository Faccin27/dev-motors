<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>Laravel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite('resources/css/app.css')
        
    </head>
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md">
            <h5 class="text-lg font-semibold">Marcas</h5>
            <p class="text-4xl font-bold">{{ \App\Models\Marca::count() }}</p>
            <a href="{{ route('admin.marcas.index') }}" class="mt-2 inline-block text-blue-200">Ver Marcas</a>
        </div>
        
        <div class="bg-green-500 text-white p-6 rounded-lg shadow-md">
            <h5 class="text-lg font-semibold">Modelos</h5>
            <p class="text-4xl font-bold">{{ \App\Models\Modelo::count() }}</p>
            <a href="{{ route('admin.modelos.index') }}" class="mt-2 inline-block text-green-200">Ver Modelos</a>
        </div>
        
        <div class="bg-cyan-500 text-white p-6 rounded-lg shadow-md">
            <h5 class="text-lg font-semibold">Veículos</h5>
            <p class="text-4xl font-bold">{{ \App\Models\Veiculo::count() }}</p>
            <a href="{{ route('admin.veiculos.index') }}" class="mt-2 inline-block text-cyan-200">Ver Veículos</a>
        </div>
        
        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-md">
            <h5 class="text-lg font-semibold">Leads</h5>
            <p class="text-4xl font-bold">{{ \App\Models\Lead::count() }}</p>
            <a href="{{ route('admin.leads.index') }}" class="mt-2 inline-block text-yellow-200">Ver Leads</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h5 class="text-xl font-bold mb-4">Leads Recentes</h5>
            @php
                $recentLeads = \App\Models\Lead::with('veiculo')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
            @endphp
            
            @if($recentLeads->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-3 border">Nome</th>
                                <th class="p-3 border">Veículo</th>
                                <th class="p-3 border">Data</th>
                                <th class="p-3 border">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentLeads as $lead)
                                <tr>
                                    <td class="p-3 border">{{ $lead->nome }}</td>
                                    <td class="p-3 border">{{ $lead->veiculo->nome }}</td>
                                    <td class="p-3 border">{{ $lead->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="p-3 border">
                                        <a href="{{ route('admin.leads.index') }}" class="text-blue-500">👁️</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('admin.leads.index') }}" class="mt-3 inline-block text-blue-500">Ver Todos</a>
            @else
                <p>Nenhum lead recente.</p>
            @endif
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h5 class="text-xl font-bold mb-4">Veículos Recentes</h5>
            @php
                $recentVeiculos = \App\Models\Veiculo::with(['modelo.marca', 'fotos'])
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
            @endphp
            
            @if($recentVeiculos->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-3 border">Nome</th>
                                <th class="p-3 border">Marca/Modelo</th>
                                <th class="p-3 border">Valor</th>
                                <th class="p-3 border">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentVeiculos as $veiculo)
                                <tr>
                                    <td class="p-3 border">{{ $veiculo->nome }}</td>
                                    <td class="p-3 border">{{ $veiculo->modelo->marca->nome }} / {{ $veiculo->modelo->nome }}</td>
                                    <td class="p-3 border">R$ {{ number_format($veiculo->valor, 2, ',', '.') }}</td>
                                    <td class="p-3 border">
                                        <a href="{{ route('admin.veiculos.edit', $veiculo->id) }}" class="text-yellow-500">✏️</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('admin.veiculos.index') }}" class="mt-3 inline-block text-blue-500">Ver Todos</a>
            @else
                <p>Nenhum veículo recente.</p>
            @endif
        </div>
    </div>
</div>
@endsection
