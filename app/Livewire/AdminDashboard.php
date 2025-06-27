<?php

namespace App\Livewire;

use Livewire\Component;

class AdminDashboard extends Component
{
    public function redirectToAddVehicule()
    {
        return redirect()->route("owner.vehicule.create");
    }

    public function render()
    {
        return view("livewire.admin-dashboard");
    }
}
