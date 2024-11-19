<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>PAPELETA DE SALIDA</h3>
        </x-slot>
        <x-slot name="content">
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Nombres:" class="font-bold" />
                    <x-input wire:model="form.nombres" type="text" class="w-full" />
                    <x-input-error for="form.nombres" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Gerencia de:" class="font-bold" />
                    <x-input wire:model="form.gerencia" type="text" class="w-full" />
                    <x-input-error for="form.gerencia" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="w-1/2 mr-4 mb-2 md:mr-2 md:mb-0">
                    <x-label value="Salida" class="font-bold" />
                    <x-input type="time" wire:model="form.salida" class="w-full" />
                    <x-input-error for="form.salida" />
                </div>
                <div class="w-1/2 mb-2 md:mr-2 md:mb-0">
                    <x-label value="Retorno" class="font-bold" />
                    <x-input type="time" wire:model.defer="form.retorno" class="w-full" />
                    <x-input-error for="form.retorno" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Motivos:" class="font-bold" />
                    <div id="motivos" class="form-control">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <input type="radio" id="comision" value="comision" wire:model="form.motivos">
                                <label for="comision" class="ml-2 cursor-pointer text-gray-600 hover:text-black">Comisión de Servicio</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="permiso" value="permiso" wire:model="form.motivos">
                                <label for="permiso" class="ml-2 cursor-pointer text-gray-600 hover:text-black">Permiso Particular</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="salud" value="salud" wire:model="form.motivos">
                                <label for="salud" class="ml-2 cursor-pointer text-gray-600 hover:text-black">ES SALUD</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="citacion" value="citacion" wire:model="form.motivos">
                                <label for="citacion" class="ml-2 cursor-pointer text-gray-600 hover:text-black">Citación Judicial</label>
                            </div>
                        </div>
                    </div>
                    <x-input-error for="form.motivos" />
                </div>
            </div>

            {{-- <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Motivos" class="font-bold" />
                    <div id="motivos" class="form-control">
                        <div class="grid grid-cols-2 gap-4">
                            <x-radio-button id="comision" value="comision" label="Comisión" />
                            <x-radio-button id="permiso" value="permiso" label="Permiso" />
                            <x-radio-button id="salud" value="salud" label="Salud" />
                            <x-radio-button id="citacion" value="citacion" label="Citación" />
                        </div>
                    </div>
                    <x-input-error for="form.motivos" />
                </div>
            </div> --}}
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Lugares donde se dirige por motivos de comisión:" class="font-bold" />
                    <x-input wire:model="form.lugares" type="text" class="w-full" />
                    <x-input-error for="form.lugares" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Observ:" class="font-bold" />
                    <x-input wire:model="form.observaciones" type="text" class="w-full" />
                    <x-input-error for="form.observaciones" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Fecha" class="font-bold" />
                    <x-input wire:model="form.fecha" type="date" class="w-full"  placeholder="Juliaca ,." />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Descripción de la Gerencia" class="font-bold" />
                    <x-input wire:model="form.jefeinmediato" type="text" class="w-full" />
                    <x-input-error for="form.jefeinmediato" />
                </div>
            </div>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <label for="form.monitoreo_id" class="font-bold">Interesado</label>
                    <select wire:model="form.monitoreo_id" id="form.monitoreo_id" class="form-control">
                        <option value="">Selecciona al Interesado</option>
                        @foreach($monitoreos as $monitoreo)
                            <option value="{{ $monitoreo->id }}">{{ $monitoreo->asignacion->persona->nombres }} {{ $monitoreo->asignacion->persona->apellidos }}</option>
                        @endforeach
                    </select>
                    @error('form.monitoreo_id') <span class="error">{{ $message }}</span> @enderror
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
