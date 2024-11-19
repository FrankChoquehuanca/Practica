<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Registra un Turno</h3>
        </x-slot>
        <x-slot name="content">
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Nombre del Turno" class="font-bold" />
                    <x-input wire:model="form.nombre" type="text" class="w-full" />
                    <x-input-error for="form.nombre" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="w-1/2 mr-4 mb-2 md:mr-2 md:mb-0">
                    <x-label value="Hora de Inicio" class="font-bold" />
                    <x-input type="time" wire:model="form.horainicio" class="w-full" placeholder="Fecha Inicio" />
                    <x-input-error for="form.horainicio" />
                </div>
                <div class="w-1/2 mb-2 md:mr-2 md:mb-0">
                    <x-label value="Hora del Fin" class="font-bold" />
                    <x-input type="time" wire:model.defer="form.horafinal" class="w-full" />
                    <x-input-error for="form.horafinal" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpen',false)" class="mx-2">Cancelar</x-secondary-button>
            <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store"
                class="disabled:opacity-25">
                Registrar
            </x-button>
            <span wire:loading wire:target="store" class="text-indigo-900">Cargando...</span>
        </x-slot>
    </x-dialog-modal>
</div>
