<x-app-layout>
    <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-900">
        <div class="container mx-auto px-2">
            <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white mb-2">Eventos</h2>
                <p class="text-gray-400">Gestiona y organiza todos tus eventos</p>
            </div>

            <button id="addEventBtn" class="btn-primary px-6 py-2 rounded-lg text-white flex items-center ml-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" 
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Agregar Evento
            </button>
            </div>
        </div>
    </main>

    <!-- Modal para agregar evento -->
    <div id="addEventModal" class="modal fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 mt-4">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="modal-content relative bg-gray-800 rounded-xl shadow-xl max-w-lg w-full mx-auto p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-white">Agregar nuevo evento</h3>
                    <button id="closeAddEventModal" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('guardar.evento') }}" method="post">
                     @csrf
                    

                    @php
                        $organizador = Auth::user()->name;
                    @endphp

                    <input type="hidden" name="organizador" value="{{ $organizador }}">
                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-medium mb-2">Nombre del evento</label>
                        <input name="nombre" type="text" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Nombre del evento" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-300 text-sm font-medium mb-2">Fecha</label>
                            <input name="fecha" type="date" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-300 text-sm font-medium mb-2">Hora</label>
                            <input name="hora" type="time" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-medium mb-2">Ubicación</label>
                        <select name="lugar" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                             @foreach($lugares as $lugar)
                                <option value="{{ $lugar->id }}">{{ $lugar->nombre }}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-medium mb-2">Descripción</label>
                        <textarea name="descripcion" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 h-24" placeholder="Descripción del evento" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-medium mb-2">Tipo de evento</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center">
                                <input type="radio" name="estado" value="publico" class="form-radio h-4 w-4 text-purple-500" required>
                                <span class="ml-2 text-gray-300">Público</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="estado" value="privado" class="form-radio h-4 w-4 text-purple-500" required>
                                <span class="ml-2 text-gray-300">Privado</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" id="cancelAddEvent" class="btn-secondary px-4 py-2 rounded-lg text-white mr-2">Cancelar</button>
                        <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-white">Crear evento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para editar evento -->
    <div id="editModal" class="modal fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 mt-4">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="modal-content relative bg-gray-800 rounded-xl shadow-xl max-w-lg w-full mx-auto p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-white">Editar evento</h3>
                    <button id="closeEditEventModal" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="editForm" method="post">
                     @csrf
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-medium mb-2">Nombre del evento</label>
                        <input id="editNombre" name="nombre" type="text" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Nombre del evento" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-300 text-sm font-medium mb-2">Fecha</label>
                            <input id="editFecha" name="fecha" type="date" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-300 text-sm font-medium mb-2">Hora</label>
                            <input id="editHora" name="hora" type="time" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-medium mb-2">Ubicación</label>
                        <select id="editLugar" name="lugar" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                            @foreach($lugares as $lugar)
                                <option value="{{ $lugar->id }}">{{ $lugar->nombre }}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-medium mb-2">Descripción</label>
                        <textarea id="editDescripcion" name="descripcion" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 h-24" placeholder="Descripción del evento" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-medium mb-2">Tipo de evento</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center">
                                <input type="radio" id="editTipoPublico" name="estado" value="publico" class="form-radio h-4 w-4 text-purple-500" required>
                                <span class="ml-2 text-gray-300">Público</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" id="editTipoPrivado" name="estado" value="privado" class="form-radio h-4 w-4 text-purple-500" required>
                                <span class="ml-2 text-gray-300">Privado</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" id="cancelEditEvent" class="btn-secondary px-4 py-2 rounded-lg text-white mr-2">Cancelar</button>
                        <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-white">Editar evento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-5">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($eventos as $evento)
            <div class="event-card rounded-xl overflow-hidden shadow-lg">
                <div class="h-40 {{ $evento->estado === 'publico' ? 'bg-gradient-to-r from-purple-600 to-indigo-600' : 'bg-gradient-to-r from-indigo-600 to-blue-600' }} relative">
                    <div class="absolute top-3 right-3 {{ $evento->estado === 'publico' ? 'bg-green-500' : 'bg-yellow-500' }} text-xs font-bold px-2 py-1 rounded-full text-white">
                        {{ ucfirst($evento->estado) }}
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                        <h3 class="text-xl font-bold text-white">{{ $evento->nombre }}</h3>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex items-center text-gray-400 mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm">{{ \Carbon\Carbon::parse($evento->fecha_evento)->locale('es')->translatedFormat('d \d\e F, Y') }}</span>
                    </div>
                    <div class="flex items-center text-gray-400 mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm">{{ $evento->hora_evento }}</span>
                    </div>
                    <p class="text-gray-300 mb-4 text-sm">{{ $evento->descripcion }}</p>
                    <div class="flex items-center text-gray-400 mb-5">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                        <span class="text-sm">{{ $evento->lugar_nombre ?? 'Ubicación no definida' }}</span>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('eventos.mostrar', $evento->id) }}" class="btn-secondary flex-1 py-2 px-3 rounded-lg text-sm text-white flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Ver detalles
                        </a>

                        @if ($evento->estado == 'publico')
                            <button class="btn-primary flex-1 py-2 px-3 rounded-lg text-sm text-white flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>Asistir</button>
                        @endif            
                        @php
                            $rol = Auth::user()->rol;
                        @endphp

                        @if ($rol === 'Administrador' || $rol === 'Organizador')
                            
                            <a href="#"
                            onclick="openEditModal({{ $evento->id }}, '{{ $evento->nombre }}', '{{ $evento->descripcion }}', '{{ $evento->lugar_nombre }}', '{{ $evento->estado }}', '{{ $evento->fecha_evento }}', '{{ $evento->hora_evento }}')"
        
                            class="btn-edit p-2 rounded-lg text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg></a>
                            <a href="{{ route('eliminar.evento', $evento->id) }}" class="btn-danger p-2 rounded-lg text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 00-2-2H9a2 2 0 00-2 2h10z" />
                                    </svg>
                            </a>
                        @endif
                        
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </div>


<script>
    function openEditModal(id, nombre, descripcion, lugar, estado, fecha, hora) {
        document.getElementById('editId').value = id;
        document.getElementById('editNombre').value = nombre;
        document.getElementById('editDescripcion').value = descripcion;


        const lugarSelect = document.getElementById('editLugar');
        for (const option of lugarSelect.options) {
            if (option.text === lugar) {
                option.selected = true;
                break;
            }
        }

        document.getElementById('editFecha').value = fecha;
        document.getElementById('editHora').value = hora;


        document.querySelector('input[name="estado"][value="' + estado + '"]').checked = true;


        document.getElementById('editForm').action = `/editarEvento/${id}`;
        document.getElementById('editModal').classList.remove('hidden');
    }


    document.getElementById('closeEditEventModal').addEventListener('click', () => {
        document.getElementById('editModal').classList.add('hidden');
    });

    document.getElementById('cancelEditEvent').addEventListener('click', () => {
        document.getElementById('editModal').classList.add('hidden');
    });
</script>


<script>
        const addEventModal = document.getElementById('addEventModal');
        const addEventBtn = document.getElementById('addEventBtn');
        const closeAddEventModal = document.getElementById('closeAddEventModal');
        const cancelAddEvent = document.getElementById('cancelAddEvent');

        addEventBtn.addEventListener('click', () => {
            addEventModal.classList.remove('hidden');
        });

        closeAddEventModal.addEventListener('click', () => {
            addEventModal.classList.add('hidden');
        });

        cancelAddEvent.addEventListener('click', () => {
            addEventModal.classList.add('hidden');
        });

      
        window.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal')) {
                e.target.classList.add('hidden');
            }
        });


        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>



</x-app-layout>