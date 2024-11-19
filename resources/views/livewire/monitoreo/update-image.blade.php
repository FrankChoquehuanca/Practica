<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Registro nuevo Monitoreo</h3>
        </x-slot>
        <x-slot name="content">
            <form method="POST" enctype="multipart/form-data">
                <div class="mt-6 mx-2 mb-6 ">
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="image">Upload files:</label>
                        <h1 class="text-red-400 text-xs text-center font-bold">"No Subir archivos TXT"</h1>
                        <div class="max-w-md mx-auto rounded-lg overflow-hidden md:max-w-xl">
                            <div class="md:flex">
                                <div class="w-full p-3">
                                    <div class="relative border-dotted h-48 rounded-lg  border-2 border-gray-700 bg-gray-100 flex justify-center items-center">
                                        <div class="absolute">
                                            <div class="flex flex-col items-center">
                                                <i class="fa fa-folder-open fa-4x text-gray-700"></i>
                                                <span class="block text-gray-400 font-normal">Adjunte sus archivos aquí</span>
                                            </div>
                                        </div>
                                        <input class="h-full w-full opacity-0 cursor-pointer" wire:model="form.images" id="image" type="file" multiple>
                                    </div>
                                </div>
                            </div>
                        <x-input-error for="form.images" />
                    </div>
                    <!-- Mensaje de carga mientras se sube la imagen -->
                    <div wire:loading wire:target="form.images" class="mt-2 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">¡Imagen Cargando!</strong>
                        <span class="block sm:inline">Por favor, espera un momento</span>
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpen', false)" class="mx-2">Cancelar</x-secondary-button>
            <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store,image"
                class="disabled:opacity-25">
                Registrar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
