@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4 text-center">Bienvenido a las encuestas de Transparencia</h2>
    <p class="text-sm text-gray-600 mb-6 text-center">
        Estas encuestas son serias, por lo que necesitamos algunos datos de su parte para evitar fraudes y "guerreros digitales". 
        El código fuente de esta encuesta es abierto y también podrá Ud. mismo verificar su voto en cualquier momento.
    </p>
    
    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <label for="username" class="block text-gray-700 font-semibold">Nombre de usuario</label>
            <input type="text" name="username" id="username" required 
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
        </div>
        
        <div>
            <label for="password" class="block text-gray-700 font-semibold">Contraseña</label>
            <input type="password" name="password" id="password" required 
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
        </div>
        
        <div>
            <label for="password_confirmation" class="block text-gray-700 font-semibold">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required 
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
        </div>
        
        <div>
            <label for="fullname" class="block text-gray-700 font-semibold">Nombre completo</label>
            <input type="text" name="fullname" id="fullname" required 
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
        </div>
        
        <div>
            <label for="fecha_nac" class="block text-gray-700 font-semibold">Fecha de nacimiento</label>
            <input type="text" name="fecha_nac" id="fecha_nac" placeholder="dd/mm/yyyy" required 
                pattern="\d{2}/\d{2}/\d{4}"
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
        </div>
        
        <div>
            <label for="ci" class="block text-gray-700 font-semibold">Cédula de identidad</label>
            <input type="text" name="ci" id="ci" required 
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
        </div>
        
        <div>
            <label for="lugar_emision" class="block text-gray-700 font-semibold">Lugar de emisión</label>
            <select name="lugar_emision" id="lugar_emision" required 
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                <option value="" disabled selected>Seleccione el lugar de emisión</option>
                <option value="SC">Santa Cruz</option>
                <option value="LP">La Paz</option>
                <option value="OR">Oruro</option>
                <option value="CB">Cochabamba</option>
                <option value="TA">Tarija</option>
                <option value="BE">Beni</option>
                <option value="PA">Pando</option>
                <option value="CH">Chuquisaca</option>
                <option value="PO">Potosí</option>
            </select>
        </div>
        
        <!-- Preguntas aleatorias -->
        <div>
            <label class="block text-gray-700 font-semibold">Preguntas de validación</label>
            <div id="preguntas" class="space-y-3">
                <!-- Aquí se insertarán las preguntas dinámicamente -->
            </div>
        </div>
        
        <!-- Ubicación (Capturada automáticamente en el backend) -->
        <input type="hidden" name="location" id="location">
        
        <!-- Re-Captcha -->
        <div class="mb-4 flex justify-center">
            {!! NoCaptcha::display() !!}
            @error('g-recaptcha-response')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
            Registrarse
        </button>
    </form>
</div>

<script>
    // Capturar ubicación
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            document.getElementById('location').value = position.coords.latitude + ',' + position.coords.longitude;
        });
    }
</script>
@endsection

@section('scripts')
    {!! NoCaptcha::renderJs() !!}
@endsection
