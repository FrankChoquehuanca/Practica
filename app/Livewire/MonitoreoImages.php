<?php

namespace App\Livewire;

use App\Livewire\Forms\MonitoreoForm;
use App\Models\Image;
use App\Models\Monitoreo;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class MonitoreoImages extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $isOpen = false;
    public $images = [], $search;
    public MonitoreoForm $form;
    public $selectedImages = [];
    public $showSelection = false;

    public Monitoreo $monitoreo;

    public function render()
    {
        $monitoreos = Monitoreo::all();
        // Consulta inicial para obtener todas las imágenes
        $imagesQuery = $this->monitoreo->images();
        // Aplicar filtro si se está realizando una búsqueda
        if ($this->search) {
            $imagesQuery->where(function ($query) {
                $query->where('url', 'like', '%' . $this->search . '%')->orWhere('original_name', 'like', '%' . $this->search . '%');
            });
        }
        // Obtener las imágenes paginadas después de aplicar el filtro
        $imagesData = $imagesQuery->paginate(500);
        // Extraer las imágenes de los datos de paginación
        $this->images = $imagesData->items();
        return view('livewire.monitoreo.monitoreo-images', compact('monitoreos'));
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
    public function store()
    {
        $this->validate();
        if (!isset($this->form->monitoreo->id)) {
            $monitoreo = Monitoreo::create($this->form->all());
            // Si hay imágenes cargadas en el formulario, las almacenamos
            if ($this->form->images) {
                foreach ($this->form->images as $image) {
                    // Obtenemos el nombre original del archivo
                    $originalName = $image->getClientOriginalName();
                    // Almacenamos la imagen
                    $imagePath = $image->store('photos', 'public');
                    // Creamos la imagen y la asociamos al monitoreo
                    $monitoreo->images()->create([
                        'url' => $imagePath,
                        'original_name' => $originalName,
                    ]);
                }
            }
        } else {
            $this->form->monitoreo->update($this->form->all());
            // Si hay imágenes cargadas en el formulario, las agregamos al monitoreo existente
            if ($this->form->images) {
                foreach ($this->form->images as $image) {
                    // Obtenemos el nombre original del archivo
                    $originalName = $image->getClientOriginalName();
                    // Almacenamos la imagen
                    $imagePath = $image->store('photos', 'public');
                    // Creamos la imagen y la asociamos al monitoreo existente
                    $this->form->monitoreo->images()->create([
                        'url' => $imagePath,
                        'original_name' => $originalName,
                    ]);
                }
            }
        }
        $this->reset(['isOpen']);
        $this->dispatch('alert', 'Registro creado satisfactoriamente');
        $this->dispatch('sweetalert', ['message' => 'Registro creado satisfactoriamente']);
    }
    public function download($imageId)
    {
        $image = Image::find($imageId);
        if ($image) {
            // Obtener la URL del archivo
            $filePath = Storage::url($image->url);
            // Obtener el nombre original del archivo
            $originalName = $image->original_name;
            // Descargar el archivo con el nombre original
            return response()->download(public_path($filePath), $originalName);
        } else {
            // Emitir un mensaje de error si la imagen no se encuentra
            $this->dispatch('alert', 'Error al descargar la imagen: la imagen no se encontró');
        }
    }
    public function selectImage($imageId)
    {
        if (in_array($imageId, $this->selectedImages)) {
            $this->selectedImages = array_diff($this->selectedImages, [$imageId]);
        } else {
            $this->selectedImages[] = $imageId;
        }
    }


    #[On('delImage')]
    public function deleteSelectedImages()
    {
        foreach ($this->selectedImages as $imageId) {
            $this->delete($imageId);
        }
        $this->selectedImages = [];
    }

    #[On('delItem')]
    public function delete($imageId)
    {
        $image = Image::find($imageId);
        if ($image) {
            // Eliminar la imagen del almacenamiento
            Storage::disk('public')->delete($image->url);
            // Eliminar la imagen de la base de datos
            $image->delete();
        } else {
            // Emitir un mensaje de error si la imagen no se encuentra
            $this->dispatch('alert', 'Error al eliminar la imagen: la imagen no se encontró');
        }
    }
}
