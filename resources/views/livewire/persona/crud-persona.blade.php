<div class="py-5">
    <div class="border border-gray-300 p-6 grid grid-cols-1 md:grid-cols-2 gap-6 bg-white shadow-lg rounded-lg mx-12 mb-6">
        <div class="flex flex-col md:flex-row items-center mx-3">
            <div class="flex items-center w-full md:w-64 mr-4">
                <div class="w-full">
                    <select wire:model.live="genero" id="genero" class="border rounded py-1 px-2 w-full">
                        <option value="">Género:</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
                </div>
                @if ($genero)
                    <div class="font-bold text-2xl ml-4">
                        {{ $countByGenero }}
                    </div>
                @endif
            </div>
        </div>
        <div class="flex flex-col md:flex-row items-center mx-3">
            <div class="flex items-center w-full md:w-64 mr-4">
                <div class="w-full">
                    <select wire:model.live="estado_civil" id="estado_civil" class="border rounded py-1 px-2 w-full">
                        <option value="">Estado Civil:</option>
                        <option value="soltero">Soltero</option>
                        <option value="casado">Casado</option>
                        <option value="divorciado">Divorciado</option>
                        <option value="viudo">Viudo</option>
                    </select>
                </div>
                @if ($estado_civil)
                    <div class="font-bold text-2xl ml-4">
                        {{ $countByEstadoCivil }}
                    </div>
                @endif
            </div>
        </div>
        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="border border-gray-200 p-2 rounded col-span-1">
                <div class="flex border rounded bg-gray-100 items-center p-2">
                    <svg class="fill-current text-gray-800 mr-2 w-5" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" width="24" height="24">
                        <path class="heroicon-ui"
                            d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z" />
                    </svg>
                    <input type="text" placeholder="Buscar por nombre..." wire:model.live="searchByName"
                        class="bg-gray-300 w-full focus:outline-none text-gray-700 rounded-xl" />
                </div>
            </div>
            <div class="border border-gray-200 p-2 rounded col-span-1">
                <div class="flex border rounded bg-gray-100 items-center p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-id">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                        <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M15 8l2 0" />
                        <path d="M15 12l2 0" />
                        <path d="M7 16l10 0" />
                    </svg>
                    <input type="text" placeholder="Buscar por DNI..." wire:model.live="searchByDNI"
                        class="bg-gray-300 w-full focus:outline-none text-gray-700 rounded-xl ml-2" />
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 mx-11">
        <div class="flex items-center justify-between">
            <div class="mt-1 relative top-4">
                <div class="col-span-1 flex justify-end">
                        @if ($isOpen)
                        @include('livewire.persona.persona-create')
                    @endif
                    <button wire:click="create()"
                        class="bg-indigo-900 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                </div>
            </div>
        </div>
        <div class="shadow overflow-x-auto border-b border-gray-700 sm:rounded-lg mt-5">
            <table class="w-full divide-y divide-gray-200 table-auto">
                <thead class="bg-indigo-900 text-white">
                    <tr class="text-center text-xs font-bold uppercase">
                        <td scope="col" class="px-6 py-3">Persona</td>
                        <td scope="col" class="px-6 py-3">Direccion</td>
                        <td scope="col" class="px-6 py-3">Celular</td>
                        <td scope="col" class="px-6 py-3">DNI</td>
                        <td scope="col" class="px-6 py-3">EstadoCivil</td>
                        <td scope="col" class="px-6 py-3">Genero</td>
                        <td scope="col" class="px-6 py-3">Opciones</td>
                    </tr>
                </thead>
                <tbody class="divide-y divide-indigo-900 capitalize">
                    @foreach ($personas as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="relative h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                                        <span
                                            class="text-gray-600 text-xl font-semibold">{{ strtoupper(substr($item->nombres, 0, 1)) }}{{ strtoupper(substr($item->apellidos, 0, 1)) }}</span>
                                        <span
                                            class="absolute right-0 bottom-0 flex items-center justify-center p-1 h-4 w-4 bg-gray-700 rounded-full ring-white ring-1">
                                            <span class="text-xs font-semibold text-white">{{ $item->id }}</span>
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 capitalize">
                                            {{ $item->nombres }} {{ $item->apellidos }}</div>
                                        <div class="text-sm text-gray-500 normal-case">{{ $item->gmail }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-2 text-gray-900 text-sm">
                                @if (strlen($item->direccion) > 13)
                                    <div x-data="{ isOpen: false }" class="">
                                        <p x-show="!isOpen">{{ substr($item->direccion, 0, 13) }}<a href="#"
                                                @click="isOpen = true" class="text-gray-500"> Ver más...</a></p>
                                        <p x-show="isOpen">{{ $item->direccion }}<a href="#"
                                                @click="isOpen = false" class="text-gray-500"> Ver menos</a></p>
                                    </div>
                                @else
                                    <p>{{ $item->direccion }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">
                                <div
                                    class="inline-flex items-center px-3 py-1 text-green-500 rounded-full gap-x-2 bg-green-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                    </svg>
                                    <h2 class="text-sm font-normal">{{ $item->celular }}</h2>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">
                                <div
                                    class="inline-flex items-center px-3 py-1 text-sky-500 rounded-full gap-x-2 bg-sky-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                    </svg>
                                    <h2 class="text-sm font-normal">{{ $item->dni }}</h2>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                {{ $item->estado_civil }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-bold font-serif">
                                @if ($item->genero == 'masculino')
                                    <div
                                        class="inline-flex items-center px-3 py-1 text-blue-500 rounded-full gap-x-2 bg-blue-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-gender-male">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 14m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                                            <path d="M19 5l-5.4 5.4" />
                                            <path d="M14.6 5l5.4 5.4" />
                                        </svg>
                                        <h2 class="text-sm font-normal">{{ $item->genero }}</h2>
                                    </div>
                                @elseif($item->genero == 'femenino')
                                    <div
                                        class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-rose-500 bg-rose-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-gender-femme">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 9m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                                            <path d="M12 14v7" />
                                            <path d="M7 18h10" />
                                        </svg>
                                        <h2 class="text-sm font-normal">femenino</h2>
                                    </div>
                                @endif
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap  text-sm font-medium">
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
        @if (!$personas->count())
            No existe ningun registro conincidente
        @endif
        @if ($personas->hasPages())
            <div class="px-6 py-3">
                {{ $personas->links() }}
            </div>
        @endif
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
                        //Livewire.emitTo('persona-main','delete',id);
                        Livewire.dispatch('delItem', {
                            persona: id
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
