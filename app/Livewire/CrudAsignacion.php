<?php

namespace App\Livewire;

use App\Livewire\Forms\AsignacionForm;
use App\Models\Asignacion;
use App\Models\Directorio;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;

class CrudAsignacion extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $search;
    public AsignacionForm $form;

    public function render()
    {
        $personas = Persona::all();
        $users = User::all();
        $directorios = Directorio::all();

        // Obtener las asignaciones del usuario autenticado
        $asignaciones = Asignacion::where('persona_id', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(6);

        // Iterar sobre las asignaciones y actualizar el estado según la fecha actual y la fecha final
        foreach ($asignaciones as $asignacion) {
            if ($asignacion->estado != 'espera' && Carbon::now()->gt($asignacion->fechafinal)) {
                // La asignación ha excedido la fecha final y no está en estado de "Espera"
                $asignacion->update(['estado' => 'inactivo']);
            } elseif ($asignacion->estado == 'espera') {
                // La asignación está en estado de "Espera"
                $diferenciaDias = Carbon::now()->diffInDays($asignacion->updated_at);
                if ($diferenciaDias >= 7) {
                    // Han pasado al menos 7 días desde que entró en estado de "Espera"
                    $asignacion->update(['estado' => 'inactivo']);
                }
            } elseif (Carbon::now()->gt($asignacion->fechafinal)) {
                // La asignación ha excedido la fecha final y no está en estado de "Espera"
                $asignacion->update(['estado' => 'inactivo']);
            } elseif (Carbon::now()->lte($asignacion->fechafinal)) {
                // La asignación está dentro de la fecha final
                $asignacion->update(['estado' => 'activo']);
            }
        }
        // Recargar las asignaciones actualizadas después de la actualización del estado
        $asignaciones = Asignacion::where('persona_id', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(6);

        return view('livewire.asignacion.crud-asignacion', compact('asignaciones', 'users', 'directorios', 'personas'));
    }
    public function cambiarEstadoEspera($asignacion)
    {
        // Cambiar el estado a "Espera"
        $asignacion->update(['estado' => 'espera']);

        // Emitir un evento para notificar a la interfaz de usuario sobre el cambio
        $this->emit('asignacionActualizada');
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
    $data = $this->form->all();
    $data['user_id'] = Auth::id(); // Asignar user_id antes de validar y almacenar

    if (!isset($data['asignacion']['id'])) {
        Asignacion::create($data);
    } else {
        $asignacion = Asignacion::find($data['asignacion']['id']);
        $asignacion->update($data);
    }

    $this->reset(['isOpen']);
    $this->dispatch('alert', 'Registro creado satisfactoriamente');
    $this->dispatch('sweetalert', message: 'Registro creado satisfactoriamente');
}

    public function edit(Asignacion $asignacion)
    {
        $this->form->setPost($asignacion);
        $this->isOpen=true;
    }

    #[On('delItem')]
    public function delete(Asignacion $asignacion){
        $asignacion->delete();
    }
}
