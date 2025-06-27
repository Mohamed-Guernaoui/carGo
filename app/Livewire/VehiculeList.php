<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Modules\GestionVehicules\Models\Vehicule;
use Livewire\Attributes\Layout;

class VehiculeList extends Component
{
    use WithPagination;
    // Public properties that automatically sync with the query string
    #[Layout("components.layouts.guest")]
    public $quickSearch = "";
    public $minPrice;
    public $maxPrice;
    public $selectedTypes = []; // Array for checkbox values
    public $transmission = ""; // Single value for radio buttons
    public $selectedFuelTypes = []; // Array for checkbox values
    public $selectedFeatures = []; // Array for checkbox values
    public $selectedLocation = ""; // Single value for select dropdown
    public $sortBy = "price_asc"; // Default sort order
    public $viewMode = "grid"; // Default view mode: 'grid' or 'list'

    // Properties for displaying counts (derived data)
    public $favoritesCount = 0; // This would typically come from user's favorites
    public $compareCount = 0; // This would typically come from session/user comparison list

    // Array to store vehicules selected for comparison
    public $compareList = [];

    // Mounted once when the component is first loaded
    public function mount()
    {
        // Load initial counts for demonstration
        $this->favoritesCount = rand(1, 10);
        $this->compareCount = count($this->compareList);

        // Optionally, populate initial filter values from query string or user preferences
        // Example: $this->quickSearch = request()->query('search', '');
    }

    // A computed property to get available vehicule types and their counts
    public function getvehiculeTypesProperty()
    {
        // This is a placeholder for actual counts. In a real app, you'd use DB aggregations.
        return [
            "berline" => 120, // sedan
            "suv" => 85,
            "camion" => 30, // truck
            "fourgonnette" => 15, // van
            "coupe" => 20,
            "cabriolet" => 10,
        ];
    }

    // A computed property to get available locations
    public function getLocationsProperty()
    {
        // Replace with actual Location model data
        // For now, static data matching your Vehicule model's temporary location attribute
        return collect([
            (object) ["id" => 1, "name" => "New York, NY"],
            (object) ["id" => 2, "name" => "Los Angeles, CA"],
            (object) ["id" => 3, "name" => "Chicago, IL"],
            (object) ["id" => 4, "name" => "Houston, TX"],
        ]);
    }

    // A computed property for active filters to display in the UI
    public function getActiveFiltersProperty()
    {
        $filters = [];

        if (!empty($this->quickSearch)) {
            $filters[] = "Search: '{$this->quickSearch}'";
        }
        if (!empty($this->minPrice)) {
            $filters[] = "Min Price: $" . $this->minPrice;
        }
        if (!empty($this->maxPrice)) {
            $filters[] = "Max Price: $" . $this->maxPrice;
        }
        foreach ($this->selectedTypes as $type) {
            $filters[] = "Type: " . ucfirst($type);
        }
        if (!empty($this->transmission)) {
            $filters[] = "Transmission: " . ucfirst($this->transmission);
        }
        foreach ($this->selectedFuelTypes as $fuel) {
            $filters[] = "Fuel: " . ucfirst($fuel);
        }
        foreach ($this->selectedFeatures as $feature) {
            $filters[] = "Feature: " . ucwords(str_replace("_", " ", $feature));
        }
        if (!empty($this->selectedLocation)) {
            // Find the location name from its ID
            $locationName =
                $this->locations->firstWhere("id", $this->selectedLocation)
                    ->name ?? "";
            if ($locationName) {
                $filters[] = "Location: " . $locationName;
            }
        }

        return $filters;
    }

    // Reset pagination when any filter changes
    public function updated($propertyName)
    {
        $this->resetPage();
        // Update compareCount when compareList changes
        if ($propertyName === "compareList") {
            $this->compareCount = count($this->compareList);
        }
    }

    // Method to clear all filters
    public function clearFilters()
    {
        $this->reset([
            "quickSearch",
            "minPrice",
            "maxPrice",
            "selectedTypes",
            "transmission",
            "selectedFuelTypes",
            "selectedFeatures",
            "selectedLocation",
            "sortBy", // Optionally reset sort as well
        ]);
        $this->resetPage(); // Reset pagination after clearing filters
    }

    // Method to remove a specific filter (example, might need more robust logic)
    public function removeFilter($filterValue)
    {
        // This is a simplified example. In a real app, you'd parse the filter string
        // (e.g., "Type: SUV") and reset the corresponding property.
        // For now, we'll just clear all filters as a fallback.
        $this->clearFilters(); // Simpler for now, or implement detailed logic
    }

    // Dummy toggle favorite method
    public function toggleFavorite($vehiculeId)
    {
        // In a real app, you'd interact with a database (e.g., user_favorites table)
        // For demonstration, just update the count.
        if (rand(0, 1)) {
            // Simulate success/failure
            $this->favoritesCount++;
        } else {
            $this->favoritesCount--;
            if ($this->favoritesCount < 0) {
                $this->favoritesCount = 0;
            }
        }
    }

    // Dummy methods for view/select
    public function viewDetails($vehiculeId)
    {
        // session()->flash(
        //     "message",
        //     "Viewing details for Vehicule ID: " . $vehiculeId
        // );
        return redirect()->route("vehicule.show", $vehiculeId);
    }

    public function selectvehicule($vehiculeId)
    {
        session()->flash("message", "Selected Vehicule ID: " . $vehiculeId);
        // return redirect()->route('booking.create', $vehiculeId);
    }

    public function comparevehicules()
    {
        if (count($this->compareList) < 2) {
            session()->flash(
                "error",
                "Please select at least 2 vehicules to compare."
            );
            return;
        }
        session()->flash(
            "message",
            "Comparing Vehicule IDs: " . implode(", ", $this->compareList)
        );
        // return redirect()->route('vehicule.compare', ['ids' => $this->compareList]);
    }

    // The render method is where your query logic resides
    public function render()
    {
        $vehicules = Vehicule::query()
            ->when($this->quickSearch, function ($query) {
                $query
                    ->where("marque", "like", "%" . $this->quickSearch . "%")
                    ->orWhere("modele", "like", "%" . $this->quickSearch . "%")
                    // Add location search if you have a proper location relation
                    // ->orWhereHas('location', function ($q) {
                    //     $q->where('name', 'like', '%' . $this->quickSearch . '%');
                    // })
                    ->orWhere(
                        "description",
                        "like",
                        "%" . $this->quickSearch . "%"
                    );
            })
            ->when($this->minPrice, function ($query) {
                $query->where("tarif_journalier", ">=", $this->minPrice);
            })
            ->when($this->maxPrice, function ($query) {
                $query->where("tarif_journalier", "<=", $this->maxPrice);
            })
            ->when(!empty($this->selectedTypes), function ($query) {
                // Assuming 'type' is a column on 'vehicules' table
                // Note: Your schema has 'type' in `vehicule_type` in the filter, but not in DB schema directly
                // I'll assume `type` maps to `type_carburant` for the example or a new column
                // Let's assume you'll add a 'type' column (e.g., 'sedan', 'suv', etc.)
                $query->whereIn("type", $this->selectedTypes);
            })
            ->when(!empty($this->transmission), function ($query) {
                $query->where("transmission", $this->transmission);
            })
            ->when(!empty($this->selectedFuelTypes), function ($query) {
                $query->whereIn("type_carburant", $this->selectedFuelTypes);
            })
            ->when(!empty($this->selectedFeatures), function ($query) {
                // This requires a column for features (e.g., JSON or pivot table)
                // For simplicity, let's assume 'description' or a 'features' JSON column
                foreach ($this->selectedFeatures as $feature) {
                    $query->where(
                        "description",
                        "like",
                        "%" . str_replace("_", " ", $feature) . "%"
                    );
                    // Or if you have a `features` JSON column:
                    // $query->whereJsonContains('features', $feature);
                }
            })
            ->when(!empty($this->selectedLocation), function ($query) {
                // This requires a `location_id` foreign key on the `vehicules` table
                // $query->where('location_id', $this->selectedLocation);
                // For now, given your current schema and my dummy location, this won't work directly.
                // You NEED a location_id on your vehicules table and a Location model.
                // For this example, I'll comment it out or you'd mock it
            });

        // Apply sorting
        if ($this->sortBy === "price_asc") {
            $vehicules->orderBy("tarif_journalier", "asc");
        } elseif ($this->sortBy === "price_desc") {
            $vehicules->orderBy("tarif_journalier", "desc");
        } elseif ($this->sortBy === "rating_desc") {
            // This would require an `average_rating` column or a join/subquery
            // For now, just order by ID as a placeholder
            $vehicules->orderBy("id", "desc"); // Placeholder
        } elseif ($this->sortBy === "year_desc") {
            $vehicules->orderBy("annee", "desc");
        } elseif ($this->sortBy === "make_asc") {
            $vehicules->orderBy("marque", "asc");
        } else {
            $vehicules->orderBy("created_at", "desc"); // Default fallback
        }

        $vehicules = $vehicules->paginate(10); // Paginate the results

        return view("livewire.vehicule-list", [
            "vehicules" => $vehicules, // Renamed for clarity to match your Blade
        ]);
    }
}
