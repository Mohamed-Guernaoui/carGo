<?php

namespace App\Livewire\Admin;

use App\Modules\GestionVehicules\Models\Vehicule;
use Livewire\Component;

class ReviewVehicule extends Component
{
    public Vehicule $vehicule; // The vehicle instance passed via route model binding

    // Properties for editing (we'll start with just 'disponible' for example)
    public $disponible;
    public $editMode = false; // To toggle edit mode for a section

    // Mount method to receive the vehicle and ensure ownership
    public function mount(Vehicule $vehicule)
    {
        $user = auth()->guard()->user();

        // Ensure the authenticated user owns this vehicle
        if ($user->id !== $vehicule->owner_id) {
            abort(403, "Unauthorized. You do not own this vehicle.");
        }

        $this->vehicule = $vehicule;
        $this->disponible = $vehicule->disponible; // Initialize from model
    }

    // Toggle the availability status
    public function toggleAvailability()
    {
        $this->vehicule->disponible = !$this->vehicule->disponible;
        $this->vehicule->save();

        $status = $this->vehicule->disponible ? "disponible" : "indisponible";
        session()->flash(
            "message",
            "Statut du véhicule mis à jour : Il est maintenant {$status}."
        );
    }

    // Redirect to edit page (Placeholder)
    public function redirectToEdit()
    {
        return redirect()->route("admin.vehicule.edit", $this->vehicule->id);
    }

    // Delete vehicle (with confirmation)
    public function deleteVehicule()
    {
        // In a real application, you'd add a confirmation modal here
        // e.g., using Livewire modals or JavaScript confirm.
        // For simplicity, we'll proceed directly but issue a warning.

        // Check if there are active or upcoming reservations (optional but recommended)
        if (
            $this->vehicule
                ->reservations()
                ->whereIn("status", ["en_attente", "confirme", "actif"])
                ->exists()
        ) {
            session()->flash(
                "error",
                "Impossible de supprimer ce véhicule. Il a des réservations actives ou en attente."
            );
            return;
        }

        $this->vehicule->delete();
        session()->flash("message", "Véhicule supprimé avec succès.");

        // Redirect back to the vehicles list
        return redirect()->route("owner.vehicules.index");
    }

    public function render()
    {
        // If your Vehicule model has these accessors already, great.
        // Otherwise, ensure they are defined in App\Models\Vehicule.
        // E.g., getPrimaryImageUrlAttribute(), getDisplayTypeAttribute()
        return view("livewire.admin.review-vehicule");
    }
    // public function render()
    // {
    //     return view('livewire.admin.edit-vehicule');
    // }
}
