<x-app-layout>

    <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-900">
        <div class="container mx-auto px-2">
            <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white mb-2">Usuarios</h2>
                <p class="text-gray-400">Gestiona el rol de los usuarios del sistema y crea uan red de grandes organizadores de eventos</p>
            </div>
            </div>
        </div>
    </main>

    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Rol</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700" id="guests-table-body">
                    @foreach ($usuarios as $user)
                        <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="text-sm font-medium text-gray-200 px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300" >{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $user->rol}}</td>
                            <td class="py-2 px-4 flex space-x-2">
                                
                            <a href="#" onclick="event.preventDefault(); openEditModal({{ $user->id }}, '{{ $user->rol }}')"
                            class="btn-edit p-2 rounded-lg text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg></a>
                            
                            <a href="{{ route('eliminar.usuario', $user->id) }}" class="btn-danger p-2 rounded-lg text-white">
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

   <div id="editModal" class="modal fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 mt-4">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="modal-content relative bg-gray-800 rounded-xl shadow-xl max-w-lg w-full mx-auto p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-white">Editar rol de usuario</h3>
                    <button id="closeEditLugarModal" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="editForm" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-medium mb-2">Rol de usuario</label>
                        <select id="editRol" name="rol" class="w-full bg-gray-700 text-white border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required
                            oninvalid="this.setCustomValidity('Selecciona un rol')"
                            oninput="this.setCustomValidity('')">
                            <option value="" disabled selected>Selecciona un rol</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Organizador">Organizador</option>
                            <option value="Invitado">Invitado</option>
                        </select>
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
    function openEditModal(id, rol) {
        document.getElementById('editId').value = id;
        document.getElementById('editRol').value = rol;

        document.getElementById('editForm').action = `/editarUsuario/${id}`;
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