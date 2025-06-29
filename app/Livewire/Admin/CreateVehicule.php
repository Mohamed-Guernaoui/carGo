<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Modules\GestionVehicules\Models\Vehicule;
use Livewire\WithFileUploads;

class CreateVehicule extends Component
{
    use WithFileUploads;

    // Public properties to bind to form fields
    public $marque;
    public $modele;
    public $plaque_immatriculation;
    public $annee;
    public $couleur;
    public $nombre_places = 5; // Default value
    public $transmission;
    public $type_carburant;
    public $tarif_journalier;
    public $images; // This will hold the uploaded file for the primary image
    public $description;
    public $owner_id; // Will be set automatically
    public $disponible = true; // Default to available
    public $type; // Assuming you added this column for 'type' like 'sedan', 'suv'

    // If you have a Location model and want to select it here
    public $selectedLocationId;

    // Validation rules
    protected $rules = [
        "marque" => "required|string|max:255",
        "modele" => "required|string|max:255",
        "plaque_immatriculation" =>
            "required|string|max:255|unique:vehicules,plaque_immatriculation",
        "annee" => "nullable|integer|min:1900|max:2100", // Assuming current year + some future
        "couleur" => "nullable|string|max:255",
        "nombre_places" => "required|integer|min:1|max:20", // Reasonable max seats
        "transmission" => "required|in:manuelle,automatique",
        "type_carburant" => "required|in:essence,diesel,electrique,hybrid",
        "tarif_journalier" => "required|numeric|min:0.01",
        "images" => "nullable|image|max:1024", // Max 1MB image
        "description" => "nullable|string|max:1000",
        "disponible" => "boolean",
        "type" => "nullable|string|max:255", // Validate the 'type' field if it exists
        "selectedLocationId" => "nullable|exists:locations,id", // Validate if location exists
    ];

    // Custom validation messages (optional)
    protected $messages = [
        "plaque_immatriculation.unique" =>
            'Cette plaque d\'immatriculation est déjà enregistrée.',
        "tarif_journalier.min" =>
            "Le tarif journalier doit être supérieur à zéro.",
        "images.image" => "Le fichier doit être une image.",
        "images.max" => 'La taille de l\'image ne doit pas dépasser 1MB.',
        "selectedLocationId.exists" =>
            'L\'emplacement sélectionné n\'est pas valide.',
    ];

    public function mount()
    {
        // Set the owner_id automatically to the authenticated user's ID
        $this->owner_id = auth()->guard()->user()->id;

        // If you need to pre-fill any fields, do it here.
        // E.g., if owner has a default location, you could set $this->selectedLocationId.
    }

    // This is called when an input field is updated
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveVehicule()
    {
        $this->validate(); // Run all validation rules

        // Handle image upload if a file is present
        $imageUrl = null;

        try {
            // dump([
            //     $this->owner_id,
            //     $this->marque,
            //     $this->modele,
            //     $this->plaque_immatriculation,
            //     $this->annee,
            //     $this->couleur,
            //     $this->nombre_places,
            //     $this->transmission,
            //     $this->type_carburant,
            //     $this->tarif_journalier,
            //     $this->images,
            //     $this->description,
            //     $this->disponible,
            //     $this->type,
            //     $this->selectedLocationId,
            // ]);

            $newVehicule = Vehicule::create([
                "owner_id" => $this->owner_id,
                "marque" => $this->marque,
                "modele" => $this->modele,
                "plaque_immatriculation" => $this->plaque_immatriculation,
                "annee" => $this->annee,
                "couleur" => $this->couleur,
                "nombre_places" => $this->nombre_places,
                "transmission" => $this->transmission,
                "type_carburant" => $this->type_carburant,
                "tarif_journalier" => $this->tarif_journalier,
                "images" => $imageUrl, // Save the URL of the uploaded image
                "description" => $this->description,
                "disponible" => $this->disponible,
                "type" => $this->type, // Save the 'type' field
            ]);
            // --- Spatie Media Library Integration ---
            if ($this->images) {
                try {
                    // Store the image directly using Spatie Media Library
                    $newVehicule
                        ->addMedia($this->images->getRealPath())
                        ->usingName($this->images->getClientOriginalName())
                        ->usingFileName($this->images->hashName())
                        ->toMediaCollection("vehicules");

                    // Update the image URL in the vehicle record
                    $media = $newVehicule->getFirstMedia("vehicules");
                    if ($media) {
                        $imageUrl = $media->getUrl();
                        $newVehicule->update(["images" => $imageUrl]);
                    }
                } catch (\Exception $e) {
                    // Log error
                    logger()->error(
                        "Failed to save image: " . $e->getMessage()
                    );

                    // You might want to show this error to the user
                    session()->flash(
                        "error",
                        'Échec du téléchargement de l\'image: ' .
                            $e->getMessage()
                    );
                }
            }

            session()->flash("message", "Véhicule ajouté avec succès !");

            // Reset form fields after successful submission (optional)
            $this->reset([
                "marque",
                "modele",
                "plaque_immatriculation",
                "annee",
                "couleur",
                "nombre_places",
                "transmission",
                "type_carburant",
                "tarif_journalier",
                "images",
                "description",
                "disponible",
                "type",
                "selectedLocationId",
            ]);

            // Redirect to the list of vehicles or dashboard
            return redirect()->route("admin.dashboard"); // Or owner.dashboard
        } catch (\Exception $e) {
            session()->flash(
                "error",
                'Erreur lors de l\'ajout du véhicule : ' . $e->getMessage()
            );
            \Log::error("Vehicle creation failed: " . $e->getMessage(), [
                "exception" => $e,
            ]);
        }
    }

    // Computed property to get available vehicle types (for dropdown/radio)
    public function getAvailableVehicleTypesProperty()
    {
        // These should ideally come from a database table or config
        return [
            "berline",
            "suv",
            "camion",
            "fourgonnette",
            "coupe",
            "cabriolet",
        ];
    }

    // Computed property to get available locations (assuming a Location model exists)
    // public function getLocationsProperty()
    // {
    //     // Make sure you have an App\Models\Location model if you use this
    //     // And your vehicules table has a 'location_id' foreign key
    //     if (class_exists(\App\Models\Location::class)) {
    //         return \App\Models\Location::all();
    //     }
    //     return collect(); // Return empty collection if Location model doesn't exist
    // }

    public function render()
    {
        return view("livewire.admin.create-vehicule");
    }
}
