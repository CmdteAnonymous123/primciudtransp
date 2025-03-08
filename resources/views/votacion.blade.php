@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Título principal -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">{{ $eleccion->nombre }}</h1>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header con notificaciones -->
            <div class="px-6 py-4 border-b border-gray-200">
                @if($votacion)
                    <div class="bg-blue-50 text-blue-700 px-4 py-3 rounded-md flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Ya has votado en esta elección el <span class="font-medium">{{ $votacion->fecha_hora->format('d/m/Y H:i:s') }}</span></span>
                    </div>
                @elseif(!$puedeVotar && !$votacion)
                    <div class="bg-yellow-50 text-yellow-700 px-4 py-3 rounded-md flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Esta elección no está activa en este momento. Fechas: <span class="font-medium">{{ $eleccion->fecha_ini->format('d/m/Y') }}</span> al <span class="font-medium">{{ $eleccion->fecha_fin->format('d/m/Y') }}</span></span>
                    </div>
                @endif
            </div>

            <!-- Contenido principal -->
            <div class="px-6 py-6">
                @if(session('success'))
                    <div class="bg-green-50 text-green-700 px-4 py-3 rounded-md flex items-center mb-6">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 text-red-700 px-4 py-3 rounded-md flex items-center mb-6">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('votar.store') }}">
                    @csrf
                    <input type="hidden" name="id_eleccion" value="{{ $eleccion->id_eleccion }}">
                    <!--input type="text" name="id_eleccion" value="{{ $eleccion->id_eleccion }}"-->

                    <!-- Lista de candidatos -->
                    <div class="space-y-3 mb-8">
                        <h2 class="text-lg font-medium text-gray-700 mb-4">Seleccione un candidato:</h2>
                        
                        @foreach($candidatos as $candidato)
                            <label class="block relative border border-gray-200 rounded-lg p-4 cursor-pointer hover:bg-gray-50 transition {{ $votacion && $votacion->id_candidato == $candidato->id_candidato ? 'bg-blue-50 border-blue-300' : '' }} {{ !$puedeVotar ? 'opacity-80' : '' }}">
                                <div class="flex items-center">
                                    <div class="mr-4">
                                        <input class="form-radio h-5 w-5 text-blue-600 transition duration-150 ease-in-out" 
                                            type="radio" 
                                            name="id_candidato" 
                                            value="{{ $candidato->id_candidato }}"
                                            {{ $votacion && $votacion->id_candidato == $candidato->id_candidato ? 'checked' : '' }}
                                            {{ $puedeVotar ? '' : 'disabled' }}>
                                    </div>
                                    <div>
                                        <div class="text-lg font-medium text-gray-800">{{ $candidato->nombres }}</div>
                                        @if($candidato->partido)
                                            <div class="flex items-center mt-1">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mr-2">{{ $candidato->partido->sigla }}</span>
                                                <span class="text-sm text-gray-600">{{ $candidato->partido->nombre }}</span>
                                            </div>
                                        @else
                                            <div class="mt-1">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Independiente</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>

                    <!-- Botones de acción -->
                    <div class="space-y-3">
                        @if($puedeVotar)
                            <button type="submit" id="botonVotar" disabled 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg shadow-sm transition duration-150 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed flex justify-center items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                VOTAR
                            </button>
                        @endif
                        <a href="{{ route('dashboard') }}" 
                            class="w-full inline-flex justify-center items-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-lg shadow-sm transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            VOLVER AL DASHBOARD
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($puedeVotar)
<script>
    // Habilitar el botón VOTAR solo cuando se seleccione un candidato
    document.addEventListener('DOMContentLoaded', function() {
        const radioButtons = document.querySelectorAll('input[name="id_candidato"]');
        const botonVotar = document.getElementById('botonVotar');
        
        radioButtons.forEach(function(radio) {
            radio.addEventListener('change', function() {
                botonVotar.disabled = false;
                botonVotar.classList.remove('opacity-50', 'cursor-not-allowed');
            });
        });
    });
</script>
@endif
@endsection