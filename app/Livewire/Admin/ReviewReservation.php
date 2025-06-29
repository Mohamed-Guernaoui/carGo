<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Modules\GestionReservations\Models\Reservation; // Important: namespace correct

class ReviewReservation extends Component
{
    public Reservation $rental; // The reservation instance passed via route model binding
    public $newStatus; // Property to bind to the status dropdown

    // Mount method to receive the reservation and ensure ownership
    public function mount(Reservation $rental)
    {
        // Eager load relationships for the view
        // $rental->load("vehicule.owner", "client");

        // Ensure the authenticated user owns the vehicle associated with this rental
        // Or if the user is an admin
        //
        // dump([$rental->vehicule->owner_id, auth()->guard()->user()->id]);
        if (auth()->guard()->user()->id !== $rental->vehicule->owner_id) {
            // You might add a check for admin role here as well
            // if (!Auth::user()->isAdmin()) {
            abort(403, "Unauthorized. You do not own this rental.");
            // }
        }

        $this->rental = $rental;
        $this->newStatus = $rental->status; // Initialize dropdown with current status
    }

    // Method to update the reservation status
    public function updateStatus(): void
    {
        // $this->validate([
        //     "newStatus" => [
        //         "required",
        //         \Illuminate\Validation\Rules\In::in([
        //             "en_attente",
        //             "confirme",
        //             "actif",
        //             "termine",
        //             "annule",
        //         ]),
        //     ],
        // ]);

        try {
            $this->rental->status = $this->newStatus;
            $this->rental->save();

            session()->flash(
                "message",
                "Statut de la réservation mis à jour avec succès !"
            );
        } catch (\Exception $e) {
            session()->flash(
                "error",
                "Erreur lors de la mise à jour du statut : " . $e->getMessage()
            );
            \Illuminate\Support\Facades\Log::error(
                "Rental status update failed: " . $e->getMessage(),
                [
                    "exception" => $e,
                ]
            );
        }
    }

    // Method to parse notes_speciales if stored as JSON
    public function getParsedNotesSpecialesProperty()
    {
        if ($this->rental->notes_speciales) {
            $data = json_decode($this->rental->notes_speciales, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $data;
            }
        }
        return []; // Return empty array if not valid JSON or null
    }

    public function render()
    {
        return view("livewire.admin.review-reservation");
    }
}
