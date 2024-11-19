<?php

namespace App\Livewire;

use App\Livewire\Forms\AreaForm;
use App\Models\Area;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CrudArea extends Component
{

    use WithPagination;
    public $isOpen = false;
    public $search;

    public AreaForm $form;

    public function render()
    {
        $areas = Area::where('nombre', 'like', '%' . $this->search . '%')->latest('id')->paginate(6);
        return view('livewire.area.crud-area', compact('areas'));
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
        if (!isset($this->form->area->id)) {
            Area::create($this->form->all());
        } else {
            $area = Area::find($this->form->area->id);
            $area->update($this->form->all());
        }
        $this->reset(['isOpen']);
        $this->dispatch('alert', 'Registro creado satisfactoriamente');
        $this->dispatch('sweetalert', message: 'Registro creado satisfactoriamente');
    }

    public function edit(Area $area)
    {
        $this->form->setPost($area);

        $this->isOpen = true;
    }

    #[On('delItem')]
    public function delete(Area $area)
    {
        $area->delete();
    }
}
