<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Eventos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between mb-4">
                        <h1 class="text-2xl font-bold">Eventos</h1>
                        <a href="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Crear Evento
                        </a>
                    </div>

                    @if ($events->isEmpty())
                        <p>No hay eventos disponibles.</p>
                    @else
                        <table class="min-w-full bg-white dark:bg-gray-800">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">ID</th>
                                    <th class="py-2 px-4 border-b">Nombre</th>
                                    <th class="py-2 px-4 border-b">Fecha</th>
                                    <th class="py-2 px-4 border-b">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $event->id }}</td>
                                        <td class="py-2 px-4 border-b">{{ $event->name }}</td>
                                        <td class="py-2 px-4 border-b">{{ $event->date }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <a href="{{ route('events.edit', $event) }}"
                                                class="text-blue-500 hover:text-blue-700">Editar</a>
                                            |
                                            <form action="{{ route('events.destroy', $event) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-700">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $events->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
