<div class="py-5">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 mx-11">
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
                    @include('livewire.asignacion.asignacion-create')
                @endif
            </div>
        </div>
        <div class="shadow overflow-x-auto border-b border-gray-700 sm:rounded-lg mt-5">
            <table class="w-full divide-y divide-gray-200 table-auto">
                <thead class="bg-indigo-900 text-white">
                    <tr class="text-center text-xs font-bold  uppercase">
                        <td scope="col" class="px-6 py-3">ID</td>
                        {{-- <td scope="col" class="px-6 py-3 ">Persona</td> --}}
                        <td scope="col" class="px-6 py-3">Estado</td>
                        <td scope="col" class="px-6 py-3">Fecha de Inicio</td>
                        <td scope="col" class="px-6 py-3 ">Fecha Final</td>
                        <td scope="col" class="px-6 py-3">Observaciones</td>
                        <td scope="col" class="px-6 py-3 ">Directorio</td>
                        {{-- <td scope="col" class="px-6 py-3 ">Creado</td>
                        <td scope="col" class="px-6 py-3 ">Actualizado</td> --}}
                        <td scope="col" class="px-6 py-3">Opciones</td>
                    </tr>
                </thead>
                <tbody class="divide-y divide-indigo-900">
                    @foreach ($asignaciones as $item)
                        <tr class="text-sm text-center font-medium text-gray-900 capitalize" wire:key="asignacion-{{ $item->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="relative h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                                        <span
                                            class="text-gray-600 text-xl font-semibold">{{ strtoupper(substr($item->persona->nombres, 0, 1)) }}{{ strtoupper(substr($item->persona->apellidos, 0, 1)) }}</span>
                                        <span
                                            class="absolute right-0 bottom-0 flex items-center justify-center p-1 h-4 w-4 bg-gray-700 rounded-full ring-white ring-1">
                                            <span
                                                class="text-xs font-semibold text-white">{{ $item->id }}</span>
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 capitalize">
                                            {{ $item->persona->nombres }} {{ $item->persona->apellidos }}</div>
                                    </div>
                                </div>
                            </td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item->persona->nombres }} {{ $item->persona->apellidos }}
                                        </div>
                                    </div>
                                </div>
                            </td> --}}
                            <td class="px-6 py-4 font-bold font-serif">
                                {{-- Etiqueta visual para 'espera' --}}
                                @if ($item->estado == 'espera')
                                    <div class="inline-flex items-center px-3 py-1 text-gray-500 rounded-full gap-x-2 bg-gray-100">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.5 7L2 4.5M2 4.5L4.5 2M2 4.5H8C8.53043 4.5 9.03914 4.71071 9.41421 5.08579C9.78929 5.46086 10 5.96957 10 6.5V10" stroke="#667085" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <h2 class="text-sm font-normal">espera</h2>
                                    </div>
                                {{-- Etiqueta visual para 'activo' --}}
                                @elseif($item->estado == 'activo')
                                    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-emerald-500 bg-emerald-100">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <h2 class="text-sm font-normal">activo</h2>
                                    </div>
                                {{-- Etiqueta visual para 'inactivo' --}}
                                @elseif($item->estado == 'inactivo')
                                    <div class="inline-flex items-center px-3 py-1 text-red-500 rounded-full gap-x-2 bg-red-100">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 3L3 9M3 3L9 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <h2 class="text-sm font-normal">inactivo</h2>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">
                                <div class="inline-flex items-center px-3 py-1 text-blue-500 rounded-full gap-x-2 bg-blue-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                      </svg>
                                    <h2 class="text-sm font-normal">{{ $item->fechainicio }}</h2>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">
                                <div class="inline-flex items-center px-3 py-1 text-red-500 rounded-full gap-x-2 bg-red-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                      </svg>
                                    <h2 class="text-sm font-normal">{{ $item->fechafinal }}</h2>
                                </div>
                            </td>
                            <td class="px-6 py-2">
                                @if (strlen($item->observaciones) > 13)
                                    <div x-data="{ isOpen: false }" class="">
                                        <p x-show="!isOpen">{{ substr($item->observaciones, 0, 13) }}<a href="#" @click="isOpen = true" class="text-gray-500"> Ver más...</a></p>
                                        <p x-show="isOpen">{{ $item->observaciones }}<a href="#" @click="isOpen = false" class="text-gray-500"> Ver menos</a></p>
                                    </div>
                                @else
                                    <p>{{ $item->observaciones }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-2 text-gray-500">
                                @if (strlen($item->directorio->nombre) > 13)
                                    <div x-data="{ isOpen: false }" class="">
                                        <p x-show="!isOpen">{{ substr($item->directorio->nombre, 0, 13) }}<a href="#" @click="isOpen = true" class="text-gray-500"> Ver más...</a></p>
                                        <p x-show="isOpen">{{ $item->directorio->nombre }}<a href="#" @click="isOpen = false" class="text-gray-500"> Ver menos</a></p>
                                    </div>
                                @else
                                    <p>{{ $item->directorio->nombre }}</p>
                                @endif
                            </td>
                            {{-- <td class="px-6 py-4">{{ $item->created_at }}</td>
                            <td class="px-6 py-4">{{ $item->updated_at }}</td> --}}
                            <td class="px-6 py-4 whitespace-nowrap  text-sm font-medium">
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
        @if (!$asignaciones->count())
        No existe ningun registro conincidente
    @endif
    @if ($asignaciones->hasPages())
        <div class="px-6 py-3">
            {{ $asignaciones->links() }}
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
                //Livewire.emitTo('asignacion-main','delete',id);
                Livewire.dispatch('delItem', {
                    asignacion: id
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
