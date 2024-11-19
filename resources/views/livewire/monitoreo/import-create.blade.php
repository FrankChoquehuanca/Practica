<x-dialog-modal wire:model="isOpens">
    <x-slot name="title">
        <h3>Registro nuevo Monitoreo</h3>
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="import" enctype="multipart/form-data">
            @csrf <!-- Agregar el token CSRF aquí -->

            <div class="mt-6">
                <x-label for="document_csv" :value="__('CSV Document')" />
                <!-- Input para cargar el archivo CSV -->
                <input type="file" wire:model="document_csv"  @touchstart.passive>
                <!-- Botón para seleccionar el archivo CSV -->
                <label for="document_csv"
                    class="cursor-pointer block mt-1 w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    Seleccionar archivo CSV...
                </label>
                <div class="rounded-md mt-2">
                    <div wire:loading wire:target="document_csv"
                        class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">¡Archivo Cargando!</strong>
                        <span class="block sm:inline">Por favor, espera un momento</span>
                    </div>
                </div>
               <x-input-error for="document_csv" class="mt-2" />
            </div>

        </form>
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$set('isOpens', false)" class="mx-2">Cancelar</x-secondary-button>
        <x-button wire:click="import" wire:loading.attr="disabled" wire:target="import" class="disabled:opacity-25">
            Importar
        </x-button>
    </x-slot>
</x-dialog-modal>
