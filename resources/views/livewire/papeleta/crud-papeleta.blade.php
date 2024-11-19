<div class="py-5">
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-400 leading-tight">
            Papeletas
        </h2>
    </x-slot> --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div class="flex items-center justify-between">
                <!--Input de busqueda   -->
                <div class="flex items-center p-2 rounded-md flex-1">
                    <label class="w-full relative text-gray-400 focus-within:text-gray-600 block">
                        <svg class="pointer-events-none w-8 h-8 absolute top-1/2 transform -translate-y-1/2 left-3"
                            viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <x-input type="text" wire:model.live="search" class="w-full block pl-14"
                            placeholder="Buscar equipo..." />
                    </label>
                </div>
                <!--Boton nuevo   -->
                <div class="lg:ml-40 ml-10 space-x-8">
                    <button wire:click="create()"
                        class="bg-indigo-900 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                    @if ($isOpen)
                        @include('livewire.papeleta.papeleta-create')
                    @endif
                </div>

            </div>
            <!--Tabla lista de items   -->
            <div class="shadow overflow-x-auto border-b border-gray-700 sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200 table-auto">
                    <thead class="bg-indigo-900 text-white">
                        <tr class="text-left text-xs font-bold  uppercase">
                            <td scope="col" class="px-6 py-3">ID</td>
                            <td scope="col" class="px-6 py-3">Nombres</td>
                            <td scope="col" class="px-6 py-3">Gerencia</td>
                            <td scope="col" class="px-6 py-3">Salida</td>
                            <td scope="col" class="px-6 py-3">Retorno</td>
                            <td scope="col" class="px-6 py-3">Motivos</td>
                            <td scope="col" class="px-6 py-3">Lugares</td>
                            <td scope="col" class="px-6 py-3">Observaciones</td>
                            <td scope="col" class="px-6 py-3">Fecha</td>
                            <td scope="col" class="px-6 py-3">Jefe Inmediato</td>
                            <td scope="col" class="px-6 py-3">Interesado</td>
                            <td scope="col" class="px-6 py-3 ">Creado</td>
                            <td scope="col" class="px-6 py-3 ">Actualizado</td>
                            <td scope="col" class="px-6 py-3">Opciones</td>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-indigo-900">
                        @foreach ($papeletas as $item)
                            <tr class="text-sm font-medium text-gray-900 capitalize" wire:key="papeleta-{{ $item->id }}">
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-900
                        text-white">
                                        {{ $item->id }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $item->nombres }}</td>
                                <td class="px-6 py-4">{{ $item->gerencia }}</td>
                                <td class="px-6 py-4">{{ $item->salida }}</td>
                                <td class="px-6 py-4">{{ $item->retorno }}</td>
                                <td class="px-6 py-4">{{ $item->motivos }}</td>
                                <td class="px-6 py-4">{{ $item->lugares }}</td>
                                <td class="px-6 py-4">{{ $item->observaciones }}</td>
                                <td class="px-6 py-4">{{ $item->fecha }}</td>
                                <td class="px-6 py-4">{{ $item->jefeinmediato }}</td>
                                @if ($item->monitoreo)
                                    @if ($item->monitoreo->asignacion)
                                        <td class="px-6 py-4">{{ $item->monitoreo->asignacion->persona->nombres}} {{$item->monitoreo->asignacion->persona->apellidos }}</td>
                                    @else
                                        <td class="px-6 py-4">Sin asignación</td>
                                    @endif
                                    @else
                                    <td class="px-6 py-4">Sin monitoreo</td>
                                @endif
                                <td class="px-6 py-4">{{ $item->created_at }}</td>
                                <td class="px-6 py-4">{{ $item->updated_at }}</td>
                                <td class="px-6 py-4">
                                    <x-button wire:click="edit({{ $item }})"> <!-- Usamos metodos magicos -->
                                        <i class="fas fa-edit"></i>
                                    </x-button>
                                    <x-danger-button wire:click="$dispatch('deleteItem',{{ $item->id }})">
                                        <!-- Usamos metodos magicos -->
                                        <i class="fas fa-trash"></i>
                                    </x-danger-button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (!$papeletas->count())
                No existe ningun registro conincidente
            @endif
            @if ($papeletas->hasPages())
                <div class="px-6 py-3">
                    {{ $papeletas->links() }}
                </div>
            @endif

        </div>
    </div>

    <!--Scripts - Sweetalert   -->
    @push('js')
        <script>
            Livewire.on('deleteItem', id => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //console.log(id);
                        //Livewire.emitTo('papeleta-main','delete',id);
                        Livewire.dispatch('delItem', {
                            papeleta: id
                        })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )

                    }
                })
            });
        </script>
    @endpush
</div>
