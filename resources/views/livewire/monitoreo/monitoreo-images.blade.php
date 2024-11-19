<div class="py-5">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 mx-11">
        <div class="flex items-center justify-between">
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
            <button wire:click="edit({{ $monitoreo }})"
                class="inline-flex items-center justify-center mx-4 bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-950 focus:ring-opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-folder-up">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 19h-7a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v3.5" />
                    <path d="M19 22v-6" />
                    <path d="M22 19l-3 -3l-3 3" />
                </svg>
                Añadir
            </button>
            @include('livewire.monitoreo.update-image')
        </div>
        <x-button wire:click="$dispatch('deleteImages')" class="mt-4">Eliminar Img Select</x-button>
        <div class="shadow overflow-x-auto border-b border-gray-700 sm:rounded-lg mt-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 2xl:grid-cols-4 gap-10 w-full divide-y divide-gray-200 ">
                <!-- Itera sobre tus items y genera una tarjeta para cada uno -->
                @foreach ($images as $image)
                    <div class="relative mx-auto w-full">
                        <div class="shadow p-4 rounded-lg bg-white cursor-default flex justify-center mr-2 mb-4">
                            <div class="relative inline-block duration-300 ease-in-out transition-transform transform hover:-translate-y-2 w-full border-spacing-1 border-gray-500">
                                <div class="px-4 text-sm overflow-hidden whitespace-nowrap text-gray-600 truncate">
                                  <div class="mr-2 mb-1 mt-1 flex rounded-full">
                                    <input class="mr-2 rounded border-gray-400 text-red-600 shadow-sm focus:ring-red-500" type="checkbox" wire:model="selectedImages" value="{{ $image->id }}">
                                    @if (!empty($image->original_name))
                                        {{ $image->original_name }} <!-- Muestra el original_name si está presente -->
                                    @else
                                        {{ basename($image->url) }}
                                        <!-- Muestra solo el nombre del archivo sin la carpeta "photos" -->
                                    @endif</div>
                                </div>
                                @if (pathinfo($image->url, PATHINFO_EXTENSION) === 'pdf')
                                    <!-- Vista previa para archivos PDF -->
                                    <iframe src="{{ Storage::url($image->url) }}" class="w-full h-auto"
                                        frameborder="0"></iframe>
                                @elseif (in_array(pathinfo($image->url, PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg']))
                                    <!-- Vista previa para imágenes -->
                                    <img src="{{ Storage::url($image->url) }}" alt="Imagen" class="w-full h-auto">
                                @elseif (in_array(pathinfo($image->url, PATHINFO_EXTENSION), ['csv', 'xlsx', 'txt', 'docx']))
                                    <!-- Vista previa genérica para otros tipos de archivo -->
                                    <div
                                        class="w-full h-auto border border-gray-300 rounded-md p-4 flex justify-center items-center">
                                        @if (pathinfo($image->url, PATHINFO_EXTENSION) === 'csv')
                                            <i class="far fa-file-csv text-5xl text-green-500"></i>
                                        @elseif (pathinfo($image->url, PATHINFO_EXTENSION) === 'xlsx')
                                            <i class="far fa-file-excel text-5xl text-green-500"></i>
                                        @elseif (pathinfo($image->url, PATHINFO_EXTENSION) === 'txt')
                                            <i class="far fa-file-alt text-5xl text-green-500"></i>
                                        @elseif (pathinfo($image->url, PATHINFO_EXTENSION) === 'docx')
                                            <i class="far fa-file-word text-5xl text-blue-500"></i>
                                        @endif
                                    </div>
                                @endif
                                <div class="mt-2">
                                    <!-- Botones de acción -->
                                    <div class="flex justify-between items-center">
                                        <!-- Botón de descargar imagen -->
                                        <x-button wire:click="download({{ $image->id }})">
                                            <i class="fas fa-download"></i>
                                        </x-button>
                                        <!-- Botón de eliminar imagen -->
                                        <x-danger-button wire:click="$dispatch('deleteItem',{{ $image->id }})">
                                            <i class="fas fa-trash"></i>
                                        </x-danger-button>
                                        @if (pathinfo($image->url, PATHINFO_EXTENSION) === 'pdf')
                                            <div class="absolute top-0 right-0 mt-1 mr-1">
                                                <button
                                                    class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-2 rounded-full">
                                                    <a target="_blank" href="{{ Storage::url($image->url) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                                        </svg>
                                                    </a>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (!$images)
                <div class="px-6 py-3">
                    No existe ningún registro coincidente.
                </div>
                {{--  @elseif (!$images->hasPages('[]'))
            <div class="px-6 py-3">
                {{ !$images->links() }}
            </div>  --}}
            @endif
        </div>
    </div>
<!--Scripts - Sweetalert   -->
@push('js')
<script>
    Livewire.on('deleteImages', id => {
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
                Livewire.dispatch('delImage', {
                    imageId: id
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
                Livewire.dispatch('delItem', {
                    imageId: id
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
