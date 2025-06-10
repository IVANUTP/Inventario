<aside class="w-64 bg-white shadow-md h-screen fixed top-0 left-0 z-40 md:block">
    <!-- Encabezado de la app -->
    <div class="p-6 text-center border-b">
        <h1 class="text-2xl font-bold text-blue-600">LogiGestión</h1>
    </div>

    <!-- Usuario autenticado -->
    @auth
        <div class="flex items-center gap-3 px-6 py-4">
            <div
                class="bg-blue-100 text-blue-600 rounded-full w-10 h-10 flex items-center justify-center font-bold uppercase">
                {{ substr(Auth::user()->username, 0, 1) }}
            </div>
            <div class="text-sm">
                <p class="text-gray-600">Bienvenido,</p>
                <p class="font-semibold text-blue-700">{{ Auth::user()->username }}</p>
            </div>
        </div>
    @endauth

    <!-- Navegación -->
    <nav class="mt-4">
        <ul class="space-y-1">
            <li>
                <a href="{{ route('reportes') }}"
                    class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"></path>
                    </svg>
                    Reportes
                </a>
            </li>
            <li>
                <a href="{{ route('productos') }}"
                    class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Productos
                </a>
            </li>
            <li>
                <a href="{{ route('inicio') }}"
                    class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                    </svg>
                    Categorías
                </a>
            </li>
            <li>
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" id="logout-btn"
                        class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-700 w-full text-left transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7"></path>
                        </svg>
                        Cerrar Sesión
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logout-btn').addEventListener('click', function (e) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se cerrará tu sesión.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cerrar sesión',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>
