@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center sm:text-left">Historial de votaciones y encuestas</h1>

    <!-- Nombre del usuario -->
    <p class="text-lg text-gray-700 mb-6 text-center sm:text-left">Hola, {{ $usuario->name }}! Bienvenido al panel de control.</p>

    <!-- Tabla de Votaciones y Encuestas -->
    <div class="bg-white shadow rounded-lg p-4 mb-6 overflow-x-auto">
        <h2 class="text-xl font-semibold mb-4 text-center sm:text-left">Votaciones y Encuestas</h2>
        <table class="w-full border-collapse border border-gray-200 min-w-[600px]">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-2 py-2 text-left text-sm sm:text-base">Título</th>
                    <th class="border border-gray-300 px-2 py-2 text-left text-sm sm:text-base">Fecha de inicio</th>
                    <th class="border border-gray-300 px-2 py-2 text-sm sm:text-base">Fecha fin</th>
                    <th class="border border-gray-300 px-2 py-2 text-sm sm:text-base">Estado</th>
                    <th class="border border-gray-300 px-2 py-2 text-sm sm:text-base">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($elecciones as $eleccion)
                    <tr class="border border-gray-200 text-sm sm:text-base">
                        <td class="border border-gray-300 px-2 py-2">{{ $eleccion->nombre }}</td>
                        <td class="border border-gray-300 px-2 py-2">{{ $eleccion->fecha_ini }}</td>
                        <td class="border border-gray-300 px-2 py-2">{{ $eleccion->fecha_fin }}</td>
                        <td class="border border-gray-300 px-2 py-2">
                            @if ($eleccion->fecha_fin < now())
                                <span class="text-red-600">Cerrada</span>
                            @elseif (in_array($eleccion->id_eleccion, $votaciones)) <!-- Verificar si ya votó -->
                                <span class="text-blue-600">Votado</span>
                            @else
                                <span class="text-green-600">Activa</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-2 py-2 text-center">
                            <a href="{{ route('votar', $eleccion->id_eleccion) }}" 
                               class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-700">
                                Ingresar <!--span>{{$eleccion->id_eleccion}}</span-->
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
