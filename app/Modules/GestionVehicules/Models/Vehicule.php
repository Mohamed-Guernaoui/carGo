<?php

namespace App\Modules\GestionVehicules\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\GestionReservations\Models\Reservation; // Important: namespace correct
use App\Modules\GestionUtilisateurs\Models\Utilisateur;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vehicule extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        "marque",
        "modele",
        "annee",
        "plaque_immatriculation",
        "description",
        "image_principale_path",
        "tarif_journalier",
        "tarif_hebdomadaire",
        "categorie_vehicule_id",
        "depot_actuel_id",
        "statut",
        "caracteristiques_json",
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, "vehicule_id"); // Assurez-vous que Reservation est bien importé
    }

    public function utilisateur(): BelongsTo
    {
        // ou proprietaire(), agentResponsable()
        return $this->belongsTo(Utilisateur::class, "utilisateur_id");
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection("Vehicules")->useDisk("public")->singleFile(); // If you want only one image per vehicle
    }

    // Accessor for the first image URL
    public function getImageUrlAttribute(): string
    {
        return $this->getFirstMediaUrl("Vehicules") ?:
            "https://source.unsplash.com/random/600x400/?car";
    }

    // new methodes
    public function getAverageRatingAttribute()
    {
        // Implement logic to calculate average rating (e.g., from a 'reviews' relationship)
        // For static example:
        return rand(30, 50) / 10; // Random rating between 3.0 and 5.0
    }

    public function getReviewsCountAttribute()
    {
        // Implement logic to count reviews
        // For static example:
        return rand(5, 50);
    }

    public function getOriginalPriceAttribute()
    {
        // For demonstration, let's say original price is 20% higher sometimes
        if ($this->discount_percentage > 0) {
            return round(
                $this->tarif_journalier /
                    (1 - $this->discount_percentage / 100),
                2
            );
        }
        return $this->tarif_journalier;
    }

    public function getDiscountPercentageAttribute()
    {
        // For demonstration, apply random discount to some vehicles
        if ($this->id % 3 == 0) {
            // Example: every 3rd vehicle has a discount
            return rand(5, 20); // 5% to 20% discount
        }
        return 0;
    }

    // Relationship to Utilisateur (owner)
    public function owner()
    {
        return $this->belongsTo(Utilisateur::class, "owner_id");
    }

    // Assuming you have a locations table and model
    // For your provided HTML, `vehicle->location->name` suggests a relationship.
    // Let's assume you have a `Location` model and `location_id` on `vehicules` table.
    // If not, you'll need to adapt this or handle locations differently.
    // Adding a dummy location attribute for now to match the frontend,
    // but ideally, you'd add a `location_id` column and a relationship.
    public function getLocationAttribute()
    {
        // This is a placeholder. In a real app, you'd have a `location_id`
        // on the `vehicules` table and a `belongsTo` relationship to a `Location` model.
        $locations = [
            (object) ["id" => 1, "name" => "New York, NY"],
            (object) ["id" => 2, "name" => "Los Angeles, CA"],
            (object) ["id" => 3, "name" => "Chicago, IL"],
            (object) ["id" => 4, "name" => "Houston, TX"],
        ];
        return $locations[$this->id % count($locations)];
    }
}
