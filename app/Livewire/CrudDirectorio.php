<?php

namespace App\Livewire;

use App\Livewire\Forms\DirectorioForm;
use App\Models\Area;
use App\Models\Cargoadicional;
use App\Models\Departamento;
use App\Models\Directorio;
use App\Models\Gerencia;
use App\Models\Relacion;
use App\Models\Subgerencia;
use App\Models\Unidad;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CrudDirectorio extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $search;
    public DirectorioForm $form;

    public function render()
    {
        $cargoadicionales=Cargoadicional::all();
        $relaciones=Relacion::all();

        $directorios = Directorio::where('nombre', 'like', '%' . $this->search . '%')->latest('id')->paginate(10);
        return view('livewire.directorio.crud-directorio', compact('directorios','cargoadicionales','relaciones'));
    }

    public function create()
    {
        $this->isOpen = true;
        $this->form->resetPost();
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate([
            'form.nombre' => 'required',
            // Hacer los campos opcionales
            'form.relacion_id' => 'nullable',
            'form.cargoadicional_id' => 'nullable',
        ], [], [
            'form.relacion_id' => 'Relación',
            'form.cargoadicional_id' => 'Cargo Adicional',
        ]);

        // Verificar que al menos uno de los dos campos esté lleno
        if (is_null($this->form->relacion_id) && is_null($this->form->cargoadicional_id)) {
            $this->addError('form.relacion_id', 'Debe seleccionar una relación o un cargo adicional.');
            $this->addError('form.cargoadicional_id', 'Debe seleccionar una relación o un cargo adicional.');
            return;
        }

        if (!isset($this->form->directorio->id)) {
            // Crear una nueva relación solo con los campos requeridos
            Directorio::create([
                'nombre' => $this->form->nombre,
                'relacion_id' => $this->form->relacion_id,
                'cargoadicional_id' => $this->form->cargoadicional_id,
            ]);
        } else {
            // Actualizar la relación con todos los campos, incluyendo los opcionales
            $directorio = Directorio::find($this->form->directorio->id);
            $directorio->update($this->form->all());
        }

        $this->reset(['isOpen']);
        $this->dispatch('alert', 'Registro creado satisfactoriamente');
        $this->dispatch('sweetalert', message: 'Registro creado satisfactoriamente');
    }


    public function edit(Directorio $directorio)
    {
        $this->form->setPost($directorio);
        $this->isOpen = true;
    }
    #[On('delItem')]
    public function delete(Directorio $directorio){
        $directorio->delete();
    }

}
