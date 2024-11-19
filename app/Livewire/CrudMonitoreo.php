<?php

namespace App\Livewire;

use App\Imports\MonitoreosImport;
use App\Livewire\Forms\MonitoreoForm;
use App\Models\Asignacion;
use App\Models\Image;
use App\Models\Monitoreo;
use App\Models\Turno;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CrudMonitoreo extends Component
{
    use WithPagination;
    public $isOpen = false;
    public $isOpens = false;

    public $search;
    public $images = [];
    use WithFileUploads;
    public MonitoreoForm $form;
    public $document_csv;

    public function render(){
        $asignaciones = Asignacion::all();
        $turnos = Turno::all();
        $monitoreos = Monitoreo::whereHas('asignacion.persona', function ($query) {$query->where('nombres', 'like', '%' . $this->search . '%');})->latest('id')->paginate(10);
        return view('livewire.monitoreo.crud-monitoreo', compact('monitoreos', 'asignaciones', 'turnos'));
    }
    public function create(){
        $this->isOpen = true;
        $this->form->resetPost();
        $this->resetValidation();
    }
    public function store(){
        $this->validate();

        if (!isset($this->form->monitoreo->id)) {
            // Crear un nuevo monitoreo
            $monitoreo = Monitoreo::create($this->form->all());

            // Si hay imágenes cargadas en el formulario, las almacenamos
            if ($this->form->images) {
                foreach ($this->form->images as $image) {
                    $imagePath = $image->store('photos', 'public');
                    // Creamos la imagen y la asociamos al monitoreo
                    $monitoreo->images()->create([
                        'url' => $imagePath
                    ]);
                }
            }
        } else {
            // Actualizar el monitoreo existente
            $monitoreo = Monitoreo::find($this->form->monitoreo->id);
            $monitoreo->update($this->form->all());

            // Si hay imágenes cargadas en el formulario, actualizamos las imágenes asociadas al monitoreo
            if ($this->form->images) {
                foreach ($this->form->images as $image) {
                    $imagePath = $image->store('photos', 'public');
                    // Si el monitoreo ya tiene una imagen, actualizamos su URL
                    if ($monitoreo->images->isNotEmpty()) {
                        $monitoreo->images()->create([
                            'url' => $imagePath
                        ]);
                    } else {
                        // Si el monitoreo no tiene una imagen asociada, creamos una nueva imagen
                        $monitoreo->images()->create([
                            'url' => $imagePath
                        ]);
                    }
                }
            }
        }
        $this->reset(['isOpen']);
        $this->dispatch('alert', 'Registro creado satisfactoriamente');
        $this->dispatch('sweetalert', ['message' => 'Registro creado satisfactoriamente']);
    }


    public function edit(Monitoreo $monitoreo)
    {
        if ($monitoreo) {
            // Establecemos el monitoreo en el formulario
            $this->form->setPost($monitoreo);
            $this->isOpen = true;
        } else {
            // Emitimos un mensaje de error si el modelo Monitoreo es nulo
            $this->dispatch('alert', 'Error al editar el registro: el modelo es nulo');
        }
    }


    #[On('delItem')]
    public function delete(Monitoreo $monitoreo){
        if ($monitoreo) {
            // Eliminar las imágenes asociadas si las hay
            if ($monitoreo->images()->exists()) {
                foreach ($monitoreo->images as $image) {
                    Storage::disk('public')->delete($image->url);
                    $image->delete();
                }
            }
            // Eliminar el registro de monitoreo
            $monitoreo->delete();

            // Emitir un mensaje de alerta
            $this->dispatch('alert', 'Registro eliminado satisfactoriamente');
        } else {
            // Emitir un mensaje de error si el modelo Monitoreo es nulo
            $this->dispatch('alert', 'Error al eliminar el registro: el modelo es nulo');
        }
    }
    public function createCSV()
    {
        $this->isOpens = true;
    }
    public function import()
{
    try {
        $this->validate([
            'document_csv' => 'required|mimetypes:text/plain,text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:2048'
        ]);

        $file = $this->document_csv;

        // Importar los datos del archivo CSV utilizando la clase MonitoreosImport
        Excel::import(new MonitoreosImport, $file);

        // Restablecer el campo de archivo CSV después de la importación exitosa
        $this->reset(['document_csv']);

        // Mostrar un mensaje de éxito
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'CSV importado exitosamente'
        ]);
    } catch (\Exception $e) {
        // Capturar cualquier excepción que pueda ocurrir durante la importación
        $this->dispatch('alert', [
            'type' => 'error',
            'message' => 'Error al importar: ' . $e->getMessage()
        ]);
    }
}}
