<?php

namespace App\Livewire;

use App\Modules\GestionReservations\Models\Reservation;
use Carbon\Carbon;
use Livewire\Component;

class AdminDashboard extends Component
{
    // These properties are populated in the render method
    public $totalVehicules = 0;
    public $activeRentals = 0;
    public $monthlyRevenue = 0;
    public $occupancyRate = 0;
    public $ownerVehicules; // Collection of Vehicules owned by the current user
    public $recentRentals; // Collection of recent reservations for owned Vehicules

    // Method to redirect to the add vehicle page
    public function redirectToAddVehicule()
    {
        return redirect()->route("admin.vehicule.create");
    }

    public function render()
    {
        $user = auth()->guard()->user();

        // Ensure the user is an owner or has the necessary permissions
        // You might have a specific role or gate check here.
        if (!$user) {
            // Redirect or show an error if not authenticated
            return view("errors.403"); // Or redirect to login
        }

        // --- Calculate Stats ---
        // 1. Total Vehicules
        $this->totalVehicules = $user->vehiculesOwned()->count();

        // 2. Active Rentals
        $this->activeRentals = $user
            ->vehiculesOwned()
            ->whereHas("reservations", function ($query) {
                $query
                    ->whereIn("status", ["actif", "confirme"]) // Consider 'confirme' as active if awaiting pickup
                    ->where("date_debut_location", "<=", Carbon::now())
                    ->where("date_fin_location", ">=", Carbon::now());
            })
            ->count();

        // 3. Monthly Revenue
        // Sum confirmed/completed reservations within the current month for owned Vehicules
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $this->monthlyRevenue = $user
            ->vehiculesOwned()
            ->join(
                "reservations",
                "vehicules.id",
                "=",
                "reservations.vehicule_id"
            )
            ->whereIn("reservations.status", ["actif", "termine"]) // Only count active/completed rentals
            ->whereBetween("reservations.date_debut_location", [
                $startOfMonth,
                $endOfMonth,
            ])
            ->orWhereBetween("reservations.date_fin_location", [
                $startOfMonth,
                $endOfMonth,
            ])
            ->orWhere(function ($query) use ($startOfMonth, $endOfMonth) {
                $query
                    ->where(
                        "reservations.date_debut_location",
                        "<",
                        $startOfMonth
                    )
                    ->where("reservations.date_fin_location", ">", $endOfMonth);
            })
            ->sum("reservations.prix_total"); // Sum the total prices
        $this->monthlyRevenue = number_format($this->monthlyRevenue, 2);

        // 4. Occupancy Rate (a simplified calculation)
        // This is a more complex stat to calculate accurately (requires knowing total available days vs rented days)
        // For simplicity, let's say it's (Active Rentals / Total Vehicules) * 100, if Total Vehicules > 0
        // Or you'd fetch specific daily availability and calculate it over a period.
        if ($this->totalVehicules > 0) {
            // A more accurate occupancy rate would involve calculating days rented vs days available.
            // This is a placeholder for a simple percentage based on active Vehicules.
            $activeVehiculesCount = $user
                ->vehiculesOwned()
                ->whereHas("reservations", function ($query) {
                    $query->where("status", "actif");
                })
                ->count();
            $this->occupancyRate = round(
                ($activeVehiculesCount / $this->totalVehicules) * 100
            );
        } else {
            $this->occupancyRate = 0;
        }

        // --- Fetch Lists ---
        // Owned Vehicules (e.g., top 4 or all for management)
        $this->ownerVehicules = $user->vehiculesOwned()->limit(6)->get(); // Limit for dashboard view

        // Recent Rentals (e.g., last 5 reservations for owned Vehicules)
        $this->recentRentals = Reservation::whereHas("vehicule", function (
            $query
        ) use ($user) {
            $query->where("owner_id", $user->id);
        })
            ->with(["vehicule", "client"]) // Eager load relationships
            ->orderBy("created_at", "desc")
            ->limit(5) // Limit for dashboard view
            ->get();

        // Calculate calendar data for the current month
        $today = Carbon::now();
        $daysInMonth = $today->daysInMonth;
        $firstDayOfMonth = $today->startOfMonth()->dayOfWeek; // 0 for Sunday, 6 for Saturday

        // Reservations for the current month to highlight in the calendar
        $calendarReservations = Reservation::whereHas("vehicule", function (
            $query
        ) use ($user) {
            $query->where("owner_id", $user->id);
        })
            ->where(function ($query) use ($today) {
                $query
                    ->whereBetween("date_debut_location", [
                        $today->startOfMonth(),
                        $today->endOfMonth(),
                    ])
                    ->orWhereBetween("date_fin_location", [
                        $today->startOfMonth(),
                        $today->endOfMonth(),
                    ])
                    ->orWhere(function ($q) use ($today) {
                        // Covers rentals spanning the entire month
                        $q->where(
                            "date_debut_location",
                            "<",
                            $today->startOfMonth()
                        )->where(
                            "date_fin_location",
                            ">",
                            $today->endOfMonth()
                        );
                    });
            })
            ->get()
            ->map(function ($reservation) {
                // Map relevant info for calendar events
                return [
                    "id" => $reservation->id,
                    "vehicule_name" =>
                        $reservation->vehicule->marque .
                        " " .
                        $reservation->vehicule->modele,
                    "start_day" => $reservation->date_debut_location->day,
                    "end_day" => $reservation->date_fin_location->day,
                    "status_color" => $reservation->status_color, // Using the accessor for dynamic color
                ];
            });

        return view("livewire.admin-dashboard", [
            "calendarReservations" => $calendarReservations,
            "todayDay" => $today->day,
            "firstDayOfMonth" => $firstDayOfMonth,
            "daysInMonth" => $daysInMonth,
        ]);
    }
    // public function redirectToAddVehicule()
    // {
    //     return redirect()->route("owner.vehicule.create");
    // }

    // public function render()
    // {
    //     return view("livewire.admin-dashboard");
    // }
}
