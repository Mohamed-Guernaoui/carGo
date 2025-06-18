<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Test;
use App\Livewire\CreateVehicule;

Route::get("/", function () {
    return view("welcome");
})->name("home");

Route::view("dashboard", "dashboard")
    ->middleware(["auth", "verified"])
    ->name("dashboard");

// Route::middleware(["auth", "verified"])->group(function () {
//     Route::get("/owner/dashboard", OwnerDashboard::class)->name(
//         "owner.dashboard"
//     );
//     // Add other owner routes here
// });
//

Route::get("/test", Test::class)->name("ex.test");

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
