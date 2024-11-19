<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Registro nuevo Monitoreo</h3>
        </x-slot>
        <x-slot name="content">
            <form method="POST" enctype="multipart/form-data">
                <div class="flex justify-between mx-2 mb-6">
                    <div class="w-1/2 mr-4 mb-2 md:mr-2 md:mb-0">
                        <x-label value="Hora Ingreso" class="font-bold" />
                        <x-input type="time" wire:model="form.horaingreso" class="w-full"
                            placeholder="Fecha Inicio" />
                        <x-input-error for="form.horaingreso" />
                    </div>
                    <div class="w-1/2 mb-2 md:mr-2 md:mb-0">
                        <x-label value="Hora Salida" class="font-bold" />
                        <x-input type="time" wire:model.defer="form.horasalida" class="w-full" />
                        <x-input-error for="form.horasalida" />
                    </div>
                </div>
                <div class="flex justify-between mx-2 mb-6">
                    <div class="w-1/2 mr-4 mb-2 md:mr-2 md:mb-0">
                        <x-label value="Hora Comida Salida" class="font-bold" />
                        <x-input type="time" wire:model="form.horacsalida" class="w-full"
                            placeholder="Fecha Inicio" />
                        <x-input-error for="form.horaingreso" />
                    </div>
                    <div class="w-1/2 mb-2 md:mr-2 md:mb-0">
                        <x-label value="Hora Comida Ingreso" class="font-bold" />
                        <x-input type="time" wire:model.defer="form.horacingreso" class="w-full" />
                        <x-input-error for="form.horacingreso" />
                    </div>
                </div>
                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Fecha" class="font-bold" />
                        <x-input type="date" wire:model.defer="form.fecha" class="w-full" />
                        <x-input-error for="form.fecha" />
                    </div>
                </div>
                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <label for="form.asignacion_id" class="font-bold">Asignación:</label>
                        <select wire:model="form.asignacion_id" id="form.asignacion_id" class="form-control">
                            <option value="">Selecciona una Asignacion</option>
                            @foreach ($asignaciones as $asignacion)
                                <option value="{{ $asignacion->id }}">{{ $asignacion->persona->nombres }}
                                    {{ $asignacion->persona->apellidos }}</option>
                            @endforeach
                        </select>
                        @error('form.asignacion_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <label for="form.turno_id" class="font-bold">Turnos</label>
                        <select wire:model="form.turno_id" id="form.turno_id" class="form-control">
                            <option value="">Selecciona un Turno</option>
                            @foreach ($turnos as $turno)
                                <option value="{{ $turno->id }}">{{ $turno->nombre }}</option>
                            @endforeach
                        </select>
                        @error('form.turno_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-6 mx-2 mb-6">
                    <div class="cursor-pointer">
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="image">Upload files</label>
                        <div class="max-w-md mx-auto rounded-lg overflow-hidden md:max-w-xl cursor-pointer">
                            <div class="md:flex">
                                <div class="w-full p-3">
                                    <div class="relative border-dotted h-48 rounded-lg  border-2 border-gray-700 bg-gray-100 flex justify-center items-center">
                                        <div class="absolute">
                                            <div class="flex flex-col items-center">
                                                <i class="fa fa-folder-open fa-4x text-gray-700"></i>
                                                <span class="block text-gray-400 font-normal">Adjunte sus archivos aquí</span>
                                            </div>
                                        </div>
                                        <input class="h-full w-full opacity-0" wire:model="form.images" id="image" type="file" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('form.images')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Mensaje de carga mientras se sube la imagen -->
                    <div wire:loading wire:target="form.images"
                        class="mt-2 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
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
