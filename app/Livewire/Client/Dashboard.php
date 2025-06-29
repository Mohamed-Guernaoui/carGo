<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $upcomingReservations;
    public $activeReservations;
    public $pastReservations;

    public function mount()
    {
        $user = auth()->guard()->user();

        if ($user) {
            // Eager load necessary relationships to avoid N+1 queries in the view
            $reservations = $user->reservations()->with("vehicule")->get();

            $now = Carbon::now();

            $this->upcomingReservations = $reservations
                ->filter(function ($reservation) use ($now) {
                    return $reservation->date_debut_location->isFuture();
                })
                ->sortBy("date_debut_location");

            $this->activeReservations = $reservations
                ->filter(function ($reservation) use ($now) {
                    return $reservation->date_debut_location->isPast() &&
                        $reservation->date_fin_location->isFuture() &&
                        $reservation->status === "actif";
                })
                ->sortBy("date_debut_location");

            $this->pastReservations = $reservations
                ->filter(function ($reservation) use ($now) {
                    return $reservation->date_fin_location->isPast() &&
                        in_array($reservation->status, ["termine", "annule"]);
                })
                ->sortByDesc("date_fin_location");
        } else {
            // Handle case where user is not authenticated (though middleware should prevent this)
            $this->upcomingReservations = collect();
            $this->activeReservations = collect();
            $this->pastReservations = collect();
        }
    }

    public function render()
    {
        return view("livewire.client.dashboard");
    }
}
