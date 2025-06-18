<?php

namespace App\Livewire;

use Livewire\Component;

class Test extends Component
{
    public function redirectToAddVehicule()
    {
        return redirect()->route("owner.vehicule.create");
    }

    public function render()
    {
        return view("livewire.test");
    }
}
