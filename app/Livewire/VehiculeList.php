<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Modules\GestionVehicules\Models\Vehicule;

class VehiculeList extends Component
{
    use WithPagination;

    public $marqueFilter = "";
    public $typeFilter = "";
    public $transmissionFilter = "";
    public $carburantFilter = "";
    public $prixMin = "";
    public $prixMax = "";
    public $placesFilter = "";
    public $sortBy = "tarif_croissant";

    protected $queryString = [
        "marqueFilter" => ["except" => ""],
        "typeFilter" => ["except" => ""],
        "transmissionFilter" => ["except" => ""],
        "carburantFilter" => ["except" => ""],
        "prixMin" => ["except" => ""],
        "prixMax" => ["except" => ""],
        "placesFilter" => ["except" => ""],
        "sortBy" => ["except" => "tarif_croissant"],
    ];

    public function render()
    {
        $vehicules = Vehicule::query()
            ->when(
                $this->marqueFilter,
                fn($q) => $q->where(
                    "marque",
                    "like",
                    "%" . $this->marqueFilter . "%"
                )
            )
            ->when(
                $this->typeFilter,
                fn($q) => $q->where("type", $this->typeFilter)
            )
            ->when(
                $this->transmissionFilter,
                fn($q) => $q->where("transmission", $this->transmissionFilter)
            )
            ->when(
                $this->carburantFilter,
                fn($q) => $q->where("type_carburant", $this->carburantFilter)
            )
            ->when(
                $this->prixMin,
                fn($q) => $q->where("tarif_journalier", ">=", $this->prixMin)
            )
            ->when(
                $this->prixMax,
                fn($q) => $q->where("tarif_journalier", "<=", $this->prixMax)
            )
            ->when(
                $this->placesFilter,
                fn($q) => $q->where("nombre_places", ">=", $this->placesFilter)
            )
            ->when($this->sortBy, function ($q) {
                match ($this->sortBy) {
                    "tarif_croissant" => $q->orderBy("tarif_journalier"),
                    "tarif_decroissant" => $q->orderByDesc("tarif_journalier"),
                    "annee_recente" => $q->orderByDesc("annee"),
                    "annee_ancienne" => $q->orderBy("annee"),
                    default => $q->orderBy("marque"),
                };
            })
            ->where("disponible", true)
            ->paginate(12);

        return view("livewire.vehicule-list", [
            "vehicules" => $vehicules,
            "marques" => Vehicule::select("marque")
                ->distinct()
                ->pluck("marque"),
        ])->layout("components.layouts.guest", [
            "title" => "Nos Véhicules Disponibles",
        ]);
    }

    public function resetFilters()
    {
        $this->reset([
            "marqueFilter",
            "typeFilter",
            "transmissionFilter",
            "carburantFilter",
            "prixMin",
            "prixMax",
            "placesFilter",
        ]);
    }
}
