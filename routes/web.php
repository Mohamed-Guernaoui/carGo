<?php

use App\Livewire\ReserveVehicule;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Test;
use App\Livewire\CreateVehicule;
use App\Livewire\VehiculeList;
use App\Livewire\ShowVehicule;

use App\Livewire\AdminDashboard;

// use App\Modules\GestionVehicules\Models\Vehicule;

Route::get("/", function () {
    return view("welcome");
})->name("home");

// Vehicule listings
Route::get("/list-vehicules", VehiculeList::class)->name("vehicules.index");
Route::get("/vehicules/{vehicule}", ShowVehicule::class)->name(
    "vehicules.show"
);

//reservation
Route::get("/vehicules/{vehicule}/reserve", ReserveVehicule::class)->name(
    "vehicules.reserve"
);

// Owner Routes
Route::view("dashboard", "dashboard")
    ->middleware(["auth", "verified", "check.role"])
    ->name("dashboard");

Route::get("/test", Test::class)->name("ex.test");

Route::get("/admin-panel", AdminDashboard::class)
    ->middleware(["auth", "verified", "check.role"])
    ->name("admin.dashboard");

Route::get("/owner/vehicule/create", CreateVehicule::class)
    ->middleware(["auth", "verified"])
    ->name("owner.vehicule.create");

Route::middleware(["auth"])->group(function () {
    Route::redirect("settings", "settings/profile");

    Volt::route("settings/profile", "settings.profile")->name(
        "settings.profile"
    );
    Volt::route("settings/password", "settings.password")->name(
        "settings.password"
    );
    Volt::route("settings/appearance", "settings.appearance")->name(
        "settings.appearance"
    );
});

require __DIR__ . "/auth.php";

// Route::middleware(["auth", "verified"])->group(function () {
//     Route::get("/owner/dashboard", OwnerDashboard::class)->name(
//         "owner.dashboard"
//     );
//     // Add other owner routes here
// });
//
