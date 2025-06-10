@extends('layouts.layoutLogin')
@section('title', 'Registro de Usuario')
@section('content')
    <div class="w-full max-w-md mx-auto mt-10 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-2xl font-bold text-center mb-6">Registrar Usuario</h2>
        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Usuario</label>
                <input type="text" name="username" required class="w-full px-3 py-2 border rounded shadow-sm">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Correo</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border rounded shadow-sm">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border rounded shadow-sm">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-3 py-2 border rounded shadow-sm">
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="w-full bg-blue-500 text-white font-semibold py-2 rounded hover:bg-blue-600 transition duration-200">
                    Registrarse
                </button>
            </div>
            <div class="text-center mt-4">
                <span class="text-gray-600">Ya tienes una cuenta!</span>
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline font-semibold">Inicia sesión</a>
            </div>
        </form>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Error de validación',
                icon: 'error',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif

@endsection
