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
}
