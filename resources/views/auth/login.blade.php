@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Iniciar sesión</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Nombre de usuario</label>
                <input type="text" name="username" id="username" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('username') }}">
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Contraseña</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Re-Captcha -->
            <div class="mb-4 flex justify-center">                
                {!! NoCaptcha::display() !!}
                @error('g-recaptcha-response')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
                                              
            
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">Ingresar</button>
        </form>
        
        <p class="text-center mt-4 text-gray-600">
            ¿No tiene cuenta? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Regístrese aquí</a>
        </p>
    </div>
</div>
@endsection

@section('scripts')
    {!! NoCaptcha::renderJs('es') !!}
@endsection
