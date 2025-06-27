<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Modules\GestionVehicules\Models\Vehicule;

class ShowVehicule extends Component
{
    public Vehicule $vehicule; // Public property to hold the Vehicule model instance
    // The mount method will automatically receive the Vehicule model
    // if you use route model binding in your route definition.
    public $activeTab = "overview";
    /**
     * @return void
     */
    #[Layout("components.layouts.guest")]
    public function mount(Vehicule $vehicule)
    {
        $this->vehicule = $vehicule;
        $this->activeTab = "overview";
    }
    /**
     * @return View
     */
    public function render()
    {
        return view("livewire.show-vehicule", [
            "vehicule" => $this->vehicule,
        ]);
    }

    // You might add methods here for actions specific to a single vehicle,
    // e.g., 'addToFavorites', 'bookVehicle'
    public function addToFavorites()
    {
        // Logic to add this vehicle to the user's favorites
        session()->flash(
            "message",
            'Vehicle "' .
                $this->vehicule->marque .
                " " .
                $this->vehicule->modele .
                '" added to favorites!'
        );
    }
    /**
     * @return RedirectResponse
     */
    public function reserveVehicule()
    {
        // Logic to initiate booking for this vehicle
        // session()->flash(
        //     "message",
        //     'Initiating booking for "' .
        //         $this->vehicule->marque .
        //         " " .
        //         $this->vehicule->modele .
        //         '".'
        // );
        // Example: redirect to a booking form
        return redirect()->route("vehicules.reserve", $this->vehicule->id);
    }
}
