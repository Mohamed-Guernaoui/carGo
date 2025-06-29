<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Modules\GestionReservations\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ClientDashboard extends Component
{
    public $upcomingRentalsCount;
    public $activeRentalsCount;
    public $completedRentalsCount;
    public $totalSpent;
    public $nextRental;
    public $recentRentals;

    public function mount()
    {
        $this->loadStats();
        $this->loadRecentRentals();
    }

    protected function loadStats()
    {
        $user = auth()->user();

        $this->upcomingRentalsCount = $user->reservation();
        // ->where("start_date", ">", now());
        // ->whereIn("status", ["pending", "confirmed"])
        // ->count();

        $this->activeRentalsCount = $user
            ->rentals()
            ->where("start_date", "<=", now())
            ->where("end_date", ">=", now())
            ->where("status", "active")
            ->count();

        $this->completedRentalsCount = $user
            ->rentals()
            ->where("status", "completed")
            ->count();

        $this->totalSpent = $user
            ->rentals()
            ->where("status", "completed")
            ->sum("total_amount");

        $this->nextRental = $user
            ->rentals()
            ->where("start_date", ">", now())
            ->whereIn("status", ["pending", "confirmed"])
            ->with("vehicle")
            ->orderBy("start_date")
            ->first();
    }

    protected function loadRecentRentals()
    {
        $this->recentRentals = Auth::user()
            ->rentals()
            ->with("vehicle")
            ->latest()
            ->paginate(5);
    }

    public function redirectToRentals($type)
    {
        return redirect()->route("rentals.index", ["filter" => $type]);
    }

    public function redirectToNewRental()
    {
        return redirect()->route("vehicles.index");
    }

    public function redirectToExtendRental()
    {
        if (
            $this->activeRental = Auth::user()
                ->rentals()
                ->where("status", "active")
                ->first()
        ) {
            return redirect()->route("rentals.extend", $this->activeRental);
        }

        session()->flash("info", "You have no active rentals to extend");
    }

    public function redirectToPaymentMethods()
    {
        return redirect()->route("payment-methods.index");
    }

    public function redirectToProfile()
    {
        return redirect()->route("profile.edit");
    }

    public function redirectToPayments()
    {
        return redirect()->route("payments.index");
    }

    public function render()
    {
        return view("dashboard");
    }
}
