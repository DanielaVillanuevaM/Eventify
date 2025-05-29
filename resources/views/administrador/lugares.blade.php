<x-app-layout>

    <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-900">
        <div class="container mx-auto px-2">
            <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white mb-2">Lugares</h2>
                <p class="text-gray-400">Gestiona las ubicaciones donde se llevarán a cabo los eventos o actividades</p>
            </div>

            <button id="openModal" class="btn-primary px-6 py-2 rounded-lg text-white flex items-center ml-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" 
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Agregar ubicación 
            </button>
            </div>
        </div>
    </main>

    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Descripción</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Ubicación </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Capacidad</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700" id="guests-table-body">
                    @foreach ($lugares as $lugar)
                        <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="text-sm font-medium text-gray-200 px-6 py-4 whitespace-nowrap">{{ $lugar->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300" >{{ $lugar->descripcion }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $lugar->direccion }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $lugar->capacidad }}</td>
                            <td class="py-2 px-4 flex space-x-2">
                                
                            <a href="#" onclick="openEditModal({{ $lugar->id }}, '{{ $lugar->nombre }}', '{{ $lugar->descripcion }}', '{{ $lugar->direccion }}', {{ $lugar->capacidad }})"
                            class="btn-edit p-2 rounded-lg text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg></a>
                            
                            <a href="{{ route('eliminar.lugar', $lugar->id) }}" class="btn-danger p-2 rounded-lg text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 00-2-2H9a2 2 0 00-2 2h10z" />
                                    </svg>
                                </a>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="modal fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 mt-4">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="modal-content relative bg-gray-800 rounded-xl shadow-xl max-w-lg w-full mx-auto p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-white">Agregar nueva ubicación</h3>
                    <button id="closeAddLugarModal" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('guardar.lugar') }}" method="post">
                    @csrf

                    <div class="mb-3">
                       <label class="block text-gray-300 text-sm font-medium mb-2">Nombre</label>
                    <input name="nombre" type="text" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required> 
                    </div>
                    <div class="mb-2">
                         <label class="block text-gray-300 text-sm font-medium mb-2">Descripción</label>
                    <textarea name="descripcion" type="text" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required></textarea>
                    
                    </div>
                    <div class="mb-2">
                        <label class="block text-gray-300 text-sm font-medium mb-2">Dirección</label>
                    <textarea name="direccion" type="text" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required></textarea>

                    </div>
                    <div class="mb-3">
                         <label class="block text-gray-300 text-sm font-medium mb-2">Capacidad</label>
                    <input name="capacidad" type="number" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>

                    </div>
                    
                   
                    <div class="flex justify-end">
                        <button type="button" id="closeModal" class="btn-secondary px-4 py-2 rounded-lg text-white mr-2">
                            Cancelar
                        </button>
                        <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-white">
                            Agregar ubicación
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <div id="editModal" class="modal fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 mt-4">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="modal-content relative bg-gray-800 rounded-xl shadow-xl max-w-lg w-full mx-auto p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-white">Editar ubicación</h3>
                    <button id="closeEditLugarModal" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="editForm" method="post">
                    @csrf
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                       <label class="block text-gray-300 text-sm font-medium mb-2">Nombre</label>
                        <input id="editNombre" name="nombre" type="text" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required> 
                    </div>
                    <div class="mb-2">
                         <label class="block text-gray-300 text-sm font-medium mb-2">Descripción</label>
                    <textarea id="editDescripcion" name="descripcion" type="text" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required></textarea>
                    
                    </div>
                    <div class="mb-2">
                        <label class="block text-gray-300 text-sm font-medium mb-2">Dirección</label>
                    <textarea id="editDireccion" name="direccion" type="text" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required></textarea>

                    </div>
                    <div class="mb-3">
                         <label class="block text-gray-300 text-sm font-medium mb-2">Capacidad</label>
                    <input id="editCapacidad" name="capacidad" type="number" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>

                    </div>
                    
                   
                    <div class="flex justify-end">
                        <button type="button" onclick="closeEditModal()" class="btn-secondary px-4 py-2 rounded-lg text-white mr-2">
                            Cancelar
                        </button>
                        <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-white">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script>
    function openEditModal(id, nombre, descripcion, direccion, capacidad) {
        document.getElementById('editId').value = id;
        document.getElementById('editNombre').value = nombre;
        document.getElementById('editDescripcion').value = descripcion;
        document.getElementById('editDireccion').value = direccion;
        document.getElementById('editCapacidad').value = capacidad;

        document.getElementById('editForm').action = `/editarLugar/${id}`; 
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    document.getElementById('openModal').addEventListener('click', function() {
        document.getElementById('modal').classList.remove('hidden');
    });
    
    document.getElementById('closeAddLugarModal').addEventListener('click', () => {
        document.getElementById('modal').classList.add('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('modal').classList.add('hidden');
    });

    
    </script>





    <script>

        document.getElementById('closeEditLugarModal').addEventListener('click', () => {
        document.getElementById('editModal').classList.add('hidden');
         });
        document.getElementById('openModal').addEventListener('click', function() {
            document.getElementById('modal').classList.remove('hidden');
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });
    </script>
    
</x-app-layout>