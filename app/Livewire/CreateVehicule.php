<?php

namespace App\Livewire;

use Livewire\Component;
use App\Modules\GestionVehicules\Models\Vehicule;
use Livewire\WithFileUploads;

class CreateVehicule extends Component
{
    use WithFileUploads;

    public $marque;
    public $modele;
    public $annee;
    public $plaque_immatriculation;
    public $couleur;
    public $nombre_places;
    public $tarif_journalier;
    public $description;
    public $images = [];
    public $transmission = "automatic";
    public $type_carburant = "gasoline";
    public $features = [];

    protected $rules = [
        "marque" => "required|string|max:255",
        "modele" => "required|string|max:255",
        "annee" => "required|integer|min:1900|max:",
        "plaque_immatriculation" => "required|string|max:20|unique:vehicles",
        "couleur" => "required|string|max:50",
        "nombre_places" => "required|integer|min:2|max:12",
        "tarif_journalier" => "required|numeric|min:1",
        "description" => "nullable|string",
        "images.*" => "image|max:2048", // 2MB max
        "transmission" => "required|in:automatic,manual",
        "type_carburant" => "required|in:gasoline,diesel,electric,hybrid",
        "features" => "array",
    ];

    public function render()
    {
        return view("livewire.create-vehicule")->layout(
            "components.layouts.app",
            [
                "title" => __("Add New Vehicle"),
            ]
        );
    }

    public function save()
    {
        $this->validate();

        $vehicle = Vehicule::create([
            "marque" => $this->marque,
            "modele" => $this->modele,
            "annee" => $this->annee,
            "plaque_immatriculation" => $this->plaque_immatriculation,
            "couleur" => $this->couleur,
            "nombre_places" => $this->nombre_places,
            "tarif_journalier" => $this->tarif_journalier,
            "description" => $this->description,
            "transmission" => $this->transmission,
            "type_carburant" => $this->type_carburant,
            "features" => json_encode($this->features),
            "owner_id" => auth()->id(),
            "disponible" => true,
        ]);

        // Store images
        foreach ($this->images as $image) {
            $vehicle
                ->addMedia($image->getRealPath())
                ->toMediaCollection("vehicles");
        }

        session()->flash("message", "Vehicle added successfully!");
        return redirect()->route("owner.vehicles.index");
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
