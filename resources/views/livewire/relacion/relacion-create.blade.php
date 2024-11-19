<div>
    <x-dialog-modal wire:model="isOpen">
      <x-slot name="title">
        <h3>Registro nueva categoría</h3>
      </x-slot>
      <x-slot name="content">
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <label for="form.gerencia_id" class="font-bold">Gerencia:</label>
                <select wire:model="form.gerencia_id" id="form.gerencia_id" class="form-control">
                    <option value="">Selecciona una Gerencia</option>
                    @foreach($gerencias as $gerencia)
                        <option value="{{ $gerencia->id }}">{{ $gerencia->nombre }}</option>
                    @endforeach
                </select>
                @error('form.gerencia_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <label for="form.subgerencia_id" class="font-bold">Subgerencia:</label>
                <select wire:model="form.subgerencia_id" id="form.subgerencia_id" class="form-control">
                    <option value="">Selecciona una Subgerencia</option>
                    @foreach($subgerencias as $subgerencia)
                        <option value="{{ $subgerencia->id }}">{{ $subgerencia->nombre }}</option>
                    @endforeach
                </select>
                @error('form.subgerencia_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <label for="form.departamento_id" class="font-bold">Departamento:</label>
                <select wire:model="form.departamento_id" id="form.departamento_id" class="form-control">
                    <option value="">Selecciona un Departamento</option>
                    @foreach($departamentos as $departamento)
                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                    @endforeach
                </select>
                @error('form.departamento_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <label for="form.unidad_id" class="font-bold">Unidad:</label>
                <select wire:model="form.unidad_id" id="form.unidad_id" class="form-control">
                    <option value="">Selecciona una Unidad</option>
                    @foreach($unidades as $unidad)
                        <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                    @endforeach
                </select>
                @error('form.unidad_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <label for="form.area_id" class="font-bold">Área:</label>
                <select wire:model="form.area_id" id="form.area_id" class="form-control">
                    <option value="">Selecciona una Área</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                    @endforeach
                </select>
                @error('form.area_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
      </x-slot>
      <x-slot name="footer">
        <x-secondary-button wire:click="$set('isOpen',false)" class="mx-2">Cancelar</x-secondary-button>
        <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
          Registrar
        </x-button>
        <!-- <span wire:loading wire:target="store">Cargando...</span> -->
      </x-slot>

    </x-dialog-modal>
</div>
