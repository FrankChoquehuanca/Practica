<?php

namespace App\Livewire;

use App\Livewire\Forms\PapeletaForm;
use App\Models\Monitoreo;
use App\Models\Papeleta;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CrudPapeleta extends Component
{
    use WithPagination;
    public $isOpen = false;
    public $search;

    public PapeletaForm $form;

    public function render()
    {
        $monitoreos = Monitoreo::all();
        $papeletas = Papeleta::where('nombres', 'like', '%' . $this->search . '%')->latest('id')->paginate(6);
        return view('livewire.papeleta.crud-papeleta', compact('papeletas','monitoreos'));
    }

    public function create()
    {
        $this->isOpen = true;
        $this->form->resetPost();
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();
        if (!isset($this->form->papeleta->id)) {
            Papeleta::create($this->form->all());
        } else {
            $papeleta = Papeleta::find($this->form->papeleta->id);
            $papeleta->update($this->form->all());
        }
        $this->reset(['isOpen']);
        $this->dispatch('alert', 'Registro creado satisfactoriamente');
        $this->dispatch('sweetalert', message: 'Registro creado satisfactoriamente');
    }

    public function edit(Papeleta $papeleta)
    {
        $this->form->setPost($papeleta);

        $this->isOpen = true;
    }

    #[On('delItem')]
    public function delete(Papeleta $papeleta)
    {
        $papeleta->delete();
    }
}
