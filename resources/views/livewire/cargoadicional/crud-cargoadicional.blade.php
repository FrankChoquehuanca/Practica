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
                    @include('livewire.unidad.unidad-create')
                @endif
            </div>
        </div>
        <div class="shadow overflow-x-auto border-b border-gray-700 sm:rounded-lg mt-5">
            <table class="w-full divide-y divide-gray-200 table-auto">
                <thead class="bg-indigo-900 text-white">
                    <tr class="text-center text-xs font-bold uppercase">
                        <td scope="col" class="px-6 py-3">ID</td>
                        <td scope="col" class="px-6 py-3">Nombre</td>
                        <td scope="col" class="px-6 py-3">Descripcion</td>
                        {{-- <td scope="col" class="px-6 py-3 ">Creado</td>
                        <td scope="col" class="px-6 py-3 ">Actualizado</td> --}}
                        <td scope="col" class="px-6 py-3">Opciones</td>
                    </tr>
                </thead>
                <tbody class="divide-y divide-indigo-900 capitalize">
                    @foreach ($cargoadicionales as $item)
                        <tr class="text-sm text-center font-medium text-gray-900 capitalize"
                            wire:key="cargoadicional-{{ $item->id }}">
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-900
                            text-white">
                                    {{ $item->id }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="inline-flex italic items-center px-3 py-1 text-gray-500 rounded-full gap-x-2 bg-gray-100 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-user-pin"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
                                    <h2 class="text-sm font-normal not-italic ">{{ $item->nombre }}</h2>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $item->descripcion }}</td>
                            {{-- <td class="px-6 py-4">{{ $item->created_at }}</td>
                      <td class="px-6 py-4">{{ $item->updated_at }}</td> --}}
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
        @if (!$cargoadicionales->count())
            No existe ningun registro conincidente
        @endif
        @if ($cargoadicionales->hasPages())
            <div class="px-6 py-3">
                {{ $cargoadicionales->links() }}
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
                    //Livewire.emitTo('cargoadicional-main','delete',id);
                    Livewire.dispatch('delItem', {
                        cargoadicional: id
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
