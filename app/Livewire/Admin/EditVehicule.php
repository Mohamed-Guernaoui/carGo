<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Modules\GestionVehicules\Models\Vehicule;
use Livewire\WithFileUploads;

class EditVehicule extends Component
{
    use WithFileUploads;

    public Vehicule $vehicule; // The existing vehicle model passed to the component

    // Public properties to bind to form fields, pre-filled from $vehicule
    public $marque;
    public $modele;
    public $plaque_immatriculation;
    public $annee;
    public $couleur;
    public $nombre_places;
    public $transmission;
    public $type_carburant;
    public $tarif_journalier;
    public $new_image; // Property to hold the *new* uploaded image
    public $description;
    public $disponible;
    public $type; // Assuming you added this column for 'type' like 'sedan', 'suv'
    public $selectedLocationId;

    // Validation rules
    // Note: 'plaque_immatriculation' unique rule should ignore the current vehicle's own plate
    protected function rules()
    {
        return [
            "marque" => "required|string|max:255",
            "modele" => "required|string|max:255",
            "plaque_immatriculation" =>
                "required|string|max:255|unique:vehicules,plaque_immatriculation," .
                $this->vehicule->id,
            "annee" => "nullable|integer|min:1900|max:2100",
            "couleur" => "nullable|string|max:255",
            "nombre_places" => "required|integer|min:1|max:20",
            "transmission" => "required|in:manuelle,automatique",
            "type_carburant" => "required|in:essence,diesel,electrique,hybrid",
            "tarif_journalier" => "required|numeric|min:0.01",
            "new_image" => "nullable|image|max:1024", // Max 1MB image
            "description" => "nullable|string|max:1000",
            "disponible" => "boolean",
            "type" => "nullable|string|max:255",
            "selectedLocationId" => "nullable|exists:locations,id",
        ];
    }

    // Custom validation messages (optional)
    protected $messages = [
        "plaque_immatriculation.unique" =>
            'Cette plaque d\'immatriculation est déjà enregistrée pour un autre véhicule.',
        "tarif_journalier.min" =>
            "Le tarif journalier doit être supérieur à zéro.",
        "new_image.image" => "Le fichier doit être une image.",
        "new_image.max" => 'La taille de l\'image ne doit pas dépasser 1MB.',
        "selectedLocationId.exists" =>
            'L\'emplacement sélectionné n\'est pas valide.',
    ];

    /**
     * Mount method is called when the component is initialized.
     * It receives the existing Vehicule model via route model binding.
     */
    public function mount(Vehicule $vehicule)
    {
        // Ensure the authenticated user owns this vehicle for security
        if (auth()->guard()->user()->id !== $vehicule->owner_id) {
            abort(403, "Unauthorized. You do not own this vehicle.");
        }

        $this->vehicule = $vehicule;

        // Pre-fill all public properties with the existing vehicle's data
        $this->marque = $vehicule->marque;
        $this->modele = $vehicule->modele;
        $this->plaque_immatriculation = $vehicule->plaque_immatriculation;
        $this->annee = $vehicule->annee;
        $this->couleur = $vehicule->couleur;
        $this->nombre_places = $vehicule->nombre_places;
        $this->transmission = $vehicule->transmission;
        $this->type_carburant = $vehicule->type_carburant;
        $this->tarif_journalier = $vehicule->tarif_journalier;
        $this->description = $vehicule->description;
        $this->disponible = $vehicule->disponible;
        $this->type = $vehicule->type;
        $this->selectedLocationId = $vehicule->location_id; // Assuming location_id column
    }

    // This is called when an input field is updated
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateVehicule()
    {
        $this->validate(); // Run all validation rules
        $imageUrl = null;
        try {
            // Update the vehicle attributes
            $this->vehicule->update([
                "marque" => $this->marque,
                "modele" => $this->modele,
                "plaque_immatriculation" => $this->plaque_immatriculation,
                "annee" => $this->annee,
                "couleur" => $this->couleur,
                "nombre_places" => $this->nombre_places,
                "transmission" => $this->transmission,
                "type_carburant" => $this->type_carburant,
                "tarif_journalier" => $this->tarif_journalier,
                "description" => $this->description,
                "disponible" => $this->disponible,
                "type" => $this->type,
                "location_id" => $this->selectedLocationId,
            ]);

            // Handle new image upload using Spatie Media Library
            if ($this->new_image) {
                try {
                    // Store the image directly using Spatie Media Library
                    $newVehicule
                        ->addMedia($this->new_image->getRealPath())
                        ->usingName($this->new_image->getClientOriginalName())
                        ->usingFileName($this->new_image->hashName())
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

            session()->flash("message", "Véhicule mis à jour avec succès !");

            // Redirect back to the vehicle details page or list
            return redirect()->route(
                "admin.vehicules.show",
                $this->vehicule->id
            );
        } catch (\Exception $e) {
            session()->flash(
                "error",
                "Erreur lors de la mise à jour du véhicule : " .
                    $e->getMessage()
            );
            \Log::error("Vehicle update failed: " . $e->getMessage(), [
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

    public function render()
    {
        return view("livewire.admin.edit-vehicule");
    }
}
