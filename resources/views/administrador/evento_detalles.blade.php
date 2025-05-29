<x-app-layout>
    <main class="flex-1 overflow-y-auto p-0 bg-gray-900">
        <!-- Encabezado del evento -->
        <div class="{{ $evento->estado === 'publico' ? 'bg-gradient-to-r from-purple-600 to-indigo-600' : 'bg-gradient-to-r from-indigo-600 to-blue-600' }} relative text-white py-12 px-6">
            <div class="w-full px-6"> <!-- Cambiado para ocupar todo el ancho -->
                
                <!-- Botón para volver -->
                <a href="{{ route('eventosp.index') }}" class="inline-flex items-center hover:text-black text-white mb-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Volver a eventos
                </a>

                <div class="flex flex-col md:flex-row justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ $evento->nombre }}</h1>

                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($evento->fecha_evento)->locale('es')->translatedFormat('d \d\e F, Y') }} • {{ $evento->hora_evento }}</span>
                        </div>

                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ $evento->lugar_nombre ?? 'Ubicación no definida' }}</span>
                        </div>
                    </div>

                    @if($evento->estado === 'publico')
                        <div class="mt-6 md:mt-0">
                            <button class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white font-medium py-2 px-6 rounded-lg shadow-md backdrop-filter backdrop-blur-sm transition duration-300 border border-white border-opacity-20">
                                Asistir a evento
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    <div class="flex-grow py-8 px-6">
            <div class="max-w-7xl mx-auto">
                <!-- Tabs -->
                <div class="border-b border-gray-700 mb-8">
                    <div class="flex space-x-8">
                        <div class="tab tab-active text-white py-4 px-1" data-tab="details" onclick="switchTab('details')">Detalles</div>
                        <div class="tab text-white  py-4 px-1" data-tab="location" onclick="switchTab('location')">Ubicación</div>
                        <div class="tab text-white py-4 px-1" data-tab="guests" onclick="switchTab('guests')">Invitados</div>

                    </div>
                </div>
                <div id="tab-details" class="tab-content">
                        <div class="dark-card rounded-lg shadow-md p-6 mb-8">
                        <h2 class="text-2xl font-semibold mb-4 text-purple-300">Acerca del evento</h2>
                        <p class="text-gray-300 mb-6">
                            {{ $evento->descripcion }}
                        </p>
                    
                        <h3 class="text-xl font-semibold mb-3 text-purple-300">Organizador</h3>
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-purple-900 flex items-center justify-center text-purple-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="font-medium text-gray-200">{{ $evento->organizador}}</p>
                                <p class="text-gray-400 text-sm">Organizador de eventos</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab-location" class="tab-content hidden">
                    <div class="dark-card rounded-lg shadow-md p-6 mb-8">
                        <h2 class="text-2xl font-semibold mb-4 text-purple-300">Ubicación</h2>
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/2 mb-6 md:mb-0 md:pr-6">
                                <h3 class="text-xl font-medium mb-2 text-gray-200">{{ $evento->lugar_nombre ?? 'Ubicación no definida' }}</h3>
                                <p class="text-gray-300 mb-4">{{ $evento->lugar_direccion }}</p>
                                <h3 class="text-xl font-semibold mb-3 text-purple-300">Acerca del lugar</h3>
                                <p class="text-gray-300 mb-4">{{ $evento->lugar_descripcion }}</p>

                                <button class="flex items-center text-purple-400 font-medium hover:text-purple-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Ver indicaciones en Google Maps
                                </button>
                            </div>
                            <div class="md:w-1/2">
                                <div id="map" class="map-container border border-gray-700"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab-guests" class="tab-content hidden">
                        <div class="dark-card rounded-lg shadow-md p-6 mb-8">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-semibold text-purple-300">Lista de invitados</h2>
                            <div class="flex space-x-3">
                                <button id="add-guest-btn" class="purple-btn py-2 px-4 rounded-lg flex items-center transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Agregar invitado
                                </button>
                                <button id="download-list-btn" class="dark-btn py-2 px-4 rounded-lg flex items-center transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Descargar lista
                                </button>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-700 dark-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nombre</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Email</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Estado</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700" id="guests-table-body">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
    </div>    
    <script>
         function switchTab(tabId) {

    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });

   
    const content = document.querySelector(`#tab-${tabId}`);
    if (content) content.classList.remove('hidden');


    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('tab-active');
    });


    const activeTab = document.querySelector(`[data-tab="${tabId}"]`);
    if (activeTab) activeTab.classList.add('tab-active');
}

    </script>    
</x-app-layout>
