<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Registro nueva Asignacion</h3>
        </x-slot>
        <x-slot name="content">
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Nombre de la Observación" class="font-bold" />
                    <x-input wire:model="form.observaciones" type="text" class="w-full" />
                    <x-input-error for="form.observaciones" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Estado" class="font-bold" />
                    <select wire:model="form.estado" id="estado" class="form-control">
                        <option value="">Selecciona su Estado </option>
                        <option class="font-semibold text-blue-900" value="espera">Espera</option>
                        <option class="font-semibold text-green-900" value="activo">Activo</option>
                        <option class="font-semibold text-red-900" value="inactivo">Inactivo</option>
                    </select>
                    <x-input-error for="form.estado" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="w-1/2 mr-4 mb-2 md:mr-2 md:mb-0">
                    <x-label value="Fecha de inicio" class="font-bold" />
                    <x-input type="date" wire:model="form.fechainicio" class="w-full" />
                    <x-input-error for="form.fechainicio" />
                </div>


                <div class="w-1/2 mb-2 md:mr-2 md:mb-0">
                    <x-label value="Fecha Final" class="font-bold" />
                    <x-input type="date" wire:model="form.fechafinal" class="w-full" />
                    <x-input-error for="form.fechafinal" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Personas" class="font-bold" />
                    <select wire:model="form.persona_id" id="estado" class="form-control">
                        <option value="">Selecciona una Persona</option>
                        @foreach ($personas as $persona)
                        <option value="{{ $persona->id }}">{{ $persona->nombres }} {{ $persona->apellidos }}</option>
                    @endforeach
                </select>
                    <x-input-error for="form.persona_id" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Directorios:" class="font-bold" />
                    <select wire:model="form.directorio_id" id="estado" class="form-control">
                        <option value="">Selecciona un Directorio</option>
                        @foreach ($directorios as $unidad)
                                        <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                                    @endforeach
                </select>
                    <x-input-error for="form.directorio_id" />
                </div>
            </div>
        <div>
    </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpen',false)" class="mx-2">Cancelar</x-secondary-button>
            <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store"
                class="disabled:opacity-25">
                Registrar
            </x-button>
            <!-- <span wire:loading wire:target="store">Cargando...</span> -->
        </x-slot>

    </x-dialog-modal>
</div>


{{-- <div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Registro nueva Asignacion</h3>
        </x-slot>
        <x-slot name="content">
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Nombre de la Observación" class="font-bold" />
                    <x-input wire:model="form.observaciones" type="text" class="w-full" />
                    <x-input-error for="form.observaciones" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Estado" class="font-bold" />
                    <select wire:model="form.estado" id="estado" class="form-control">
                        <option value="">Selecciona su Estado </option>
                        <option class="font-semibold text-blue-900" value="espera">Espera</option>
                        <option class="font-semibold text-green-900" value="activo">Activo</option>
                        <option class="font-semibold text-red-900" value="inactivo">Inactivo</option>
                    </select>
                    <x-input-error for="form.estado" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="w-1/2 mr-4 mb-2 md:mr-2 md:mb-0">
                    <x-label value="Fecha de inicio" class="font-bold" />
                    <x-input type="date" wire:model="form.fechainicio" class="w-full" />
                    <x-input-error for="form.fechainicio" />
                </div>


                <div class="w-1/2 mb-2 md:mr-2 md:mb-0">
                    <x-label value="Fecha Final" class="font-bold" />
                    <x-input type="date" wire:model="form.fechafinal" class="w-full" />
                    <x-input-error for="form.fechafinal" />
                </div>
            </div>
            <div>
                <x-label value="Personas" class="font-bold" />
                <select id="Persona"
                    class="block w-full rounded-md bg-gray-200 border border-gray-200 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model="form.persona_id" required>
                    <option value="">Selecciona una Persona</option>
                    @foreach ($personas as $persona)
                        <option value="{{ $persona->id }}">{{ $persona->nombres }} {{ $persona->apellidos }}</option>
                    @endforeach
                </select>
                <x-input-error for="form.persona_id" class="mt-2" />
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Directorios" class="font-bold" />
                    <div class="relative" wire.ignore>
                        <select id="directorio" class="select2" wire:model="form.directorio_id" required>
                            <option class="capitalize" value="">Selecciona un Directorio</option>
                            @foreach ($directorios as $directorio)
                                <option value="{{ $directorio->id }}">{{ $directorio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-input-error for="form.directorio_id" class="mt-2" />
                </div>
            </div>
            <script>
             document.addEventListener('livewire:load', function() {
    console.log('Livewire loaded');
    $('.select2').select2();
    $('.select2').on('change', function() {
        @this.set('directorio_id', this.value);
    });
});

            </script>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpen',false)" class="mx-2">Cancelar</x-secondary-button>
            <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store"
                class="disabled:opacity-25">
                Registrar
            </x-button>
            <!-- <span wire:loading wire:target="store">Cargando...</span> -->
        </x-slot>

    </x-dialog-modal>
</div> --}}
