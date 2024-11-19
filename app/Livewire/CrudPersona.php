<?php

namespace App\Livewire;

use App\Livewire\Forms\PersonaForm;
use App\Models\Persona;
use Livewire\Component;
use Livewire\WithPagination;

class CrudPersona extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $searchByName,$searchByDNI,$genero = '',$estado_civil = '';
    public PersonaForm $form;

    protected $queryString = ['searchByName', 'searchByDNI', 'genero', 'estado_civil'];

    public function mount()
    {
        $this->resetPage(); // Resetear la paginación al cargar el componente
    }

    public function render(){
    $query = Persona::query();

    if ($this->searchByName) {
        // Dividir la cadena de búsqueda en palabras individuales
        $keywords = explode(' ', $this->searchByName);

        // Iterar sobre cada palabra clave y buscar coincidencias en nombres y apellidos
        $query->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('nombres', 'like', '%' . $keyword . '%')
                          ->orWhere('apellidos', 'like', '%' . $keyword . '%');
                });
            }
        });
    }
    if ($this->searchByDNI) {
        $query->where('dni', 'like', '%' . $this->searchByDNI . '%');
    }
    if ($this->genero) {
        $query->where('genero', $this->genero);
    }

    if ($this->estado_civil) {
        $query->where('estado_civil', $this->estado_civil);
    }

    // Obtener la cantidad de personas con el género y estado civil seleccionados
    $countByGenero = Persona::where('genero', $this->genero)->count();
    $countByEstadoCivil = Persona::where('estado_civil', $this->estado_civil)->count();

    $personas = $query->latest('id')->paginate(10);

    return view('livewire.persona.crud-persona', compact('personas', 'countByGenero', 'countByEstadoCivil'));}

    public function create(){
        $this->isOpen = true;
        $this->form->resetPost();
        $this->resetValidation();
    }

    public function store(){
        $this->validate();

        if (!isset($this->form->persona->id)) {
            Persona::create($this->form->all());
        } else {
            $persona = Persona::find($this->form->persona->id);
            $persona->update($this->form->all());
        }

        $this->reset(['isOpen']);
        $this->dispatch('alert', 'Registro creado satisfactoriamente');
        $this->dispatch('sweetalert', ['message' => 'Registro creado satisfactoriamente']);
    }

    public function edit(Persona $persona){
        $this->form->setPost($persona);
        $this->isOpen = true;
    }

    public function delete(Persona $persona){
        $persona->delete();
    }
}
