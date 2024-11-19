<div class="py-5">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 mx-11">
        <div class="flex flex-wrap items-center justify-between">
            <!-- Input de búsqueda -->
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
            <!-- Botones -->
            <div class="flex items-center justify-center flex-wrap space-x-4 ">
                <!-- Botón Import CSV -->
                <div class="lg:ml-4 space-x-4 mr-2 flex items-center">
                    <button wire:click="createCSV()"
                        class="bg-green-800 hover:bg-green-700 px-3 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </button>
                    @if ($isOpens)
                        @include('livewire.monitoreo.import-create')
                    @endif
                </div>
                <!-- Botón de Exportar -->
                <div class="mr-2 mt-0 flex items-center">
                    <a href="{{ route('export') }}"
                        class="bg-blue-700 hover:bg-blue-500 text-white py-2 px-3 rounded-lg inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12-3-3m0 0-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </a>
                </div>
                <!-- Botón de crear -->
                <div class="mr-2 mt-0 lg:mt-0 flex items-center">
                    <button wire:click="create()"
                        class="bg-indigo-900 hover:bg-indigo-700 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                    @if ($isOpen)
                        @include('livewire.monitoreo.monitoreo-create')
                    @endif
                </div>
            </div>
        </div>

        {{-- Este toca arreglar --}}
        <div class=" overflow-x-auto sm:rounded-lg mt-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 w-full divide-y ">
                <!-- Itera sobre tus items y genera una tarjeta para cada uno -->
                @foreach ($monitoreos as $item)
                    <div class="relative mx-auto w-full" >
                        <div class="relative inline-block duration-300 ease-in-out transition-transform transform hover:-translate-y-2 w-full"
                        >
                            <div class="grid grid-cols-3 gap-4 mt-1 relative top-4" >
                                <div class="col-span-1 flex justify-start ">
                                    <div wire:click="edit({{ $item }})"
                                        class="inline-flex flex-col xl:flex-row xl:items-center cursor-pointer ml-2 mt-3 mr-3 hover:text-indigo-600 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                </div>
                                <div class="col-span-1 flex justify-center pt-3  ">
                                    <a href="{{ route('monitoreos.images.show', $item->id) }}"
                                        class="bg-orange-500 hover:bg-orange-400 text-white rounded-md px-4 py-1 object-center ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="3" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="col-span-1 flex justify-end  ">
                                    <div wire:click="$dispatch('deleteItem',{{ $item->id }})"
                                        class="cursor-pointer mt-3 mr-3 hover:text-indigo-600 inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="shadow p-4 rounded-lg bg-white cursor-default">
                                <div class="mt-1">
                                    <h2 class="font-medium text-base md:text-lg text-gray-800 line-clamp-1 capitalize pr-1">
                                        {{ $item->asignacion->persona->nombres }}
                                        {{ $item->asignacion->persona->apellidos }}
                                    </h2>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <x-mon-crud texto="Hora de ingreso:" content="{{ $item->horaingreso }}" />
                                    <x-mon-crud texto="Hora de salida:" content="{{ $item->horasalida }}" />
                                    <x-mon-crud texto="Hora de comida salida:" content="{{ $item->horacsalida }}" />
                                    <x-mon-crud texto="Hora de comida entrada:" content="{{ $item->horacingreso }}" />
                                </div>
                                <div class="grid grid-cols-2 grid-rows-1 gap-4 mt-1">
                                    <p  class="inline-flex flex-col xl:flex-row xl:items-center font-medium capitalize text-gray-800 italic">
                                        Fecha:
                                        <span class="mt-1 xl:mt-0 font-normal not-italic pl-2">
                                            {{ $item->fecha }}
                                        </span>
                                    </p>
                                    <p class="inline-flex flex-col xl:flex-row xl:items-center font-medium capitalize text-gray-800 italic">
                                        Turno:
                                        <span class="mt-1 xl:mt-0 font-normal not-italic pl-2">
                                            {{ $item->turno->nombre }}
                                        </span>
                                    </p>
                                </div>
                                <p class="inline-flex flex-col xl:flex-row xl:items-center font-medium capitalize text-gray-800 italic mt-1">
                                    <a href="" class="mt-1 xl:mt-0 font-normal not-italic pl-2 text-blue-800">
                                        Ver papeletas ...
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @if (!$monitoreos->count())
            <div class="px-6 py-3">
                No existe ningún registro coincidente.
            </div>
        @endif
        @if ($monitoreos->hasPages())
            <div class="px-6 py-3">
                {{ $monitoreos->links() }}
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
                    //Livewire.emitTo('monitoreo-main','delete',id);
                    Livewire.dispatch('delItem', {
                        monitoreo: id
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
