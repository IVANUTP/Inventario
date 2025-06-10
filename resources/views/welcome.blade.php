@extends('layouts.layoutLogin')
@section('title', 'Iniciar Sesión')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full bg-white shadow-lg rounded-lg overflow-hidden flex flex-col md:flex-row">

            <!-- Imagen del lado izquierdo -->
            <div class="hidden md:block md:w-1/2">
                <img src="/../img/img3.jpg" alt="Imagen login" class="w-full h-full object-cover">
            </div>

            <!-- Formulario -->
            <div class="w-full md:w-1/2 p-10 flex items-center justify-center">
                <div class="w-full">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Iniciar sesión</h2>

                    <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Correo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                            <div class="mt-1 flex items-center border border-gray-300 rounded-md px-3 py-2">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16 12l-4-4-4 4m0 0l4 4 4-4m-4 4V4" />
                                </svg>
                                <input type="email" name="email" class="w-full outline-none text-gray-700"
                                       placeholder="correo@ejemplo.com" required>
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                            <div class="mt-1 flex items-center border border-gray-300 rounded-md px-3 py-2">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 11c0-1.657-1.343-3-3-3s-3 1.343-3 3v1h6v-1zM5 11V9a7 7 0 0114 0v2a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2z" />
                                </svg>
                                <input type="password" name="password" class="w-full outline-none text-gray-700"
                                       placeholder="••••••••" required>
                            </div>
                        </div>

                        <!-- Botón -->
                        <div>
                            <button type="submit"
                                    class="w-full bg-gray-800 text-white font-semibold py-2 rounded hover:bg-gray-900 transition duration-200">
                                Entrar
                            </button>
                        </div>

                        <!-- Enlace -->
                        <div class="text-center mt-4 text-sm">
                            <span class="text-gray-600">¿No tienes una cuenta?</span>
                            <a href="{{ route('register') }}" class="text-gray-800 font-semibold hover:underline">Regístrate aquí</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
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
