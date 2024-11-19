<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Registra una Nueva Persona</h3>
        </x-slot>
        <x-slot name="content">
            <div class="flex justify-between mx-2 mb-6">
                <div class="w-1/2 mr-4 mb-2 md:mr-2 md:mb-0">
                    <x-label value="Nombre" class="font-bold" />
                    <x-input wire:model="form.nombres" type="text" placeholder="Nombres Completos" class="w-full" />
                    <x-input-error for="form.nombres" />
                </div>
                <div class="w-1/2 mb-2 md:mr-2 md:mb-0">
                    <x-label value="Apellidos" class="font-bold" />
                    <x-input wire:model="form.apellidos" type="text" placeholder="Apellidos Completos" class="w-full" />
                    <x-input-error for="form.apellidos" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Dirección" class="font-bold" />
                    <x-input wire:model="form.direccion" type="text" placeholder="Direccion donde Recide" class="w-full" />
                    <x-input-error for="form.direccion" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="w-1/2 mr-4 mb-2 md:mr-2 md:mb-0">
                    <x-label value="Celular" class="font-bold" />
                    <x-input wire:model="form.celular" type="number" placeholder="N° Celular" class="w-full" />
                    <x-input-error for="form.celular" />
                </div>
                <div class="w-1/2 mb-2 md:mr-2 md:mb-0">
                    <x-label value="DNI" class="font-bold" />
                    <x-input wire:model.live="form.dni" name="dni" :value="old('dni')" type="number" placeholder="N° Documento"  class="w-full" maxlength="8" oninput="this.value = this.value.slice(0, 8)" />
                    <x-input-error for="form.dni" />
                </div>

            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Correo Electrónico" class="font-bold" />
                    <x-input wire:model.live="form.gmail" type="email" name="email" :value="old('email')"  placeholder="Correo Electronico" class="w-full" />
                    <x-input-error for="form.gmail" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="w-1/2 mr-4 mb-2 md:mr-2 md:mb-0">
                    <x-label value="Estado Civil" class="font-bold" />
                    <select wire:model="form.estado_civil" id="estado_civil" class="form-control">
                        <option value="" class="text-gray-500">Selecciona su Estado Civil</option>
                        <option value="soltero">Soltero</option>
                        <option value="casado">Casado</option>
                        <option value="divorciado">Divorciado</option>
                        <option value="viudo">Viudo</option>
                    </select>
                    <x-input-error for="form.estado_civil" />
                </div>
                <div class="w-1/2 mb-2 md:mr-2 md:mb-0">
                    <x-label value="Género" class="font-bold" />
                    <select wire:model="form.genero" id="genero" class="form-control">
                        <option value="">Selecciona su Género</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
                    <x-input-error for="form.genero" />
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
