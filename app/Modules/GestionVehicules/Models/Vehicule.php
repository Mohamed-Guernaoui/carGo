<?php

namespace App\Modules\GestionVehicules\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\GestionReservations\Models\Reservation; // Important: namespace correct
use App\Modules\GestionUtilisateurs\Models\Utilisateur;
class Vehicule extends Model
{
    use HasFactory;

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

    public function reservations()
    {
        return $this->hasMany(Reservation::class, "vehicule_id"); // Assurez-vous que Reservation est bien importé
    }

    public function utilisateur()
    {
        // ou proprietaire(), agentResponsable()
        return $this->belongsTo(Utilisateur::class, "utilisateur_id");
    }
}
