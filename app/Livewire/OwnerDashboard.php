<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Modules\GestionReservations\Models\Reservation;
use App\Modules\GestionVehicules\Models\Vehicule;
use Carbon\Carbon;

class OwnerDashboard extends Component
{
    public $totalVehicles;
    public $activeRentals;
    public $monthlyRevenue;
    public $occupancyRate;
    public $recentVehicles;
    public $recentRentals;
    public $calendarDays = [];

    public function mount()
    {
        $this->loadStats();
        $this->loadRecentData();
        $this->buildCalendar();
    }

    protected function loadStats()
    {
        $this->totalVehicles = Vehicle::where(
            "owner_id",
            auth()->id()
        )->count();

        $this->activeRentals = Rental::whereHas("vehicle", function ($query) {
            $query->where("owner_id", auth()->id());
        })
            ->where("start_date", "<=", now())
            ->where("end_date", ">=", now())
            ->where("status", "active")
            ->count();

        $this->monthlyRevenue = Rental::whereHas("vehicle", function ($query) {
            $query->where("owner_id", auth()->id());
        })
            ->whereBetween("start_date", [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ])
            ->sum("total_amount");

        $totalRentalDays = Rental::whereHas("vehicle", function ($query) {
            $query->where("owner_id", auth()->id());
        })
            ->whereBetween("start_date", [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ])
            ->sum(\DB::raw("DATEDIFF(end_date, start_date) + 1"));

        $totalPossibleDays =
            Vehicle::where("owner_id", auth()->id())->count() *
            now()->daysInMonth;

        $this->occupancyRate =
            $totalPossibleDays > 0
                ? round(($totalRentalDays / $totalPossibleDays) * 100, 2)
                : 0;
    }

    protected function loadRecentData()
    {
        $this->recentVehicles = Vehicle::where("owner_id", auth()->id())
            ->latest()
            ->take(4)
            ->get();

        $this->recentRentals = Rental::whereHas("vehicle", function ($query) {
            $query->where("owner_id", auth()->id());
        })
            ->with(["vehicle", "client"])
            ->latest()
            ->take(5)
            ->get();
    }

    protected function buildCalendar()
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $startDay = $startOfMonth->copy()->startOfWeek();
        $endDay = $endOfMonth->copy()->endOfWeek();

        $rentals = Rental::whereHas("vehicle", function ($query) {
            $query->where("owner_id", auth()->id());
        })
            ->whereBetween("start_date", [$startOfMonth, $endOfMonth])
            ->orWhereBetween("end_date", [$startOfMonth, $endOfMonth])
            ->get();

        $currentDay = $startDay->copy();
        while ($currentDay <= $endDay) {
            $dayEvents = [];

            foreach ($rentals as $rental) {
                if (
                    $currentDay->between($rental->start_date, $rental->end_date)
                ) {
                    $dayEvents[] = [
                        "title" =>
                            $rental->vehicle->make .
                            " " .
                            $rental->vehicle->model,
                        "rental" => $rental,
                    ];
                }
            }

            $this->calendarDays[] = [
                "day" => $currentDay->day,
                "isToday" => $currentDay->isToday(),
                "isCurrentMonth" => $currentDay->month == now()->month,
                "events" => $dayEvents,
            ];

            $currentDay->addDay();
        }
    }

    public function redirectToVehicles()
    {
        return redirect()->route("owner.vehicles.index");
    }

    public function redirectToAddVehicle()
    {
        return redirect()->route("owner.vehicule.create");
    }

    public function redirectToRentals($filter = null)
    {
        return redirect()->route("owner.rentals.index", ["filter" => $filter]);
    }

    public function redirectToPayments()
    {
        return redirect()->route("owner.payments.index");
    }

    public function redirectToCalendar()
    {
        return redirect()->route("owner.calendar");
    }

    public function redirectToVehicle($vehicleId)
    {
        return redirect()->route("owner.vehicles.show", $vehicleId);
    }

    public function viewRental($rentalId)
    {
        return redirect()->route("owner.rentals.show", $rentalId);
    }

    public function editRental($rentalId)
    {
        return redirect()->route("owner.rentals.edit", $rentalId);
    }

    public function cancelRental($rentalId)
    {
        $rental = Rental::findOrFail($rentalId);
        $rental->update(["status" => "cancelled"]);

        $this->notify("Rental cancelled successfully");
        $this->loadRecentData();
    }

    public function render()
    {
        return view("livewire.owner-dashboard");
    }
}
