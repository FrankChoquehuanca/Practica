<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Registro nueva Directorio</h3>
        </x-slot>
        <x-slot name="content">
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label for="nombre" value="Nombre del Puesto" class="font-bold" />
                    <x-input wire:model="form.nombre" type="text" id="nombre" class="w-full" />
                    <x-input-error for="form.nombre" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <label for="form.relacion_id" class="font-bold">Gerencia</label>
                    <select class="form-control" wire:model.live="form.relacion_id">
                        <option value="">Seleccione</option>
                        @foreach ($relaciones as $relacion)
                            <option value="{{ $relacion->gerencia_id }}">{{ $relacion->gerencia->nombre }}</option>
                        @endforeach
                    </select>
                   <x-input-error for="form.relacion_id" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <label for="form.relacion_id" class="font-bold">Gerencia</label>
                    <select class="form-control" wire:model.live="form.relacion_id">
                        <option value="">Seleccione</option>
                        @foreach ($relaciones as $relacion)
                            @if ($relacion->subgerencia)
                                <option value="{{ $relacion->id }}">{{ $relacion->subgerencia->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                   <x-input-error for="form.relacion_id" />
                </div>
            </div>

            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <label for="form.relacion_id" class="font-bold">Departamento</label>
                    <select class="form-control" wire:model.live="form.relacion_id">
                        <option value="">Seleccione</option>
                        @foreach ($relaciones as $relacion)
                            @if ($relacion->departamento)
                                <!-- Verificar si departamento no es null -->
                                <option value="{{ $relacion->id }}">{{ $relacion->departamento->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                   <x-input-error for="form.relacion_id" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <label for="form.relacion_id" class="font-bold">Unidad</label>
                    <select class="form-control" wire:model.live="form.relacion_id">
                        <option value="">Seleccione</option>
                        @foreach ($relaciones as $relacion)
                            @if ($relacion->unidad)
                                <!-- Verificar si unidad no es null -->
                                <option value="{{ $relacion->id }}">{{ $relacion->unidad->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                   <x-input-error for="form.relacion_id" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <label for="form.relacion_id" class="font-bold">Gerencia</label>
                    <select class="form-control" wire:model.live="form.relacion_id">
                        <option value="">Seleccione</option>
                        @foreach ($relaciones as $relacion)
                            @if ($relacion->area)
                                <option value="{{ $relacion->id }}">{{ $relacion->area->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                   <x-input-error for="form.relacion_id" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label for="cargoadicional_id" value="Cargo Adicional" class="font-bold" />
                    <select wire:model="form.cargoadicional_id" id="cargoadicional_id" name="cargoadicional_id"
                        class="form-control">
                        <option value="">Selecciona un cargo adicional</option>
                        @foreach ($cargoadicionales as $cargoadicional)
                            <option value="{{ $cargoadicional->id }}">{{ $cargoadicional->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="form.cargoadicional_id" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpen',false)" class="mx-2">Cancelar</x-secondary-button>
            <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store"
                class="disabled:opacity-25">
                Registrar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
