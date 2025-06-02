<?php

namespace App\Modules\GestionReservations\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\GestionVehicules\Models\Vehicule;
use App\Modules\GestionUtilisateurs\Models\Utilisateur;

class Reservation extends Model
{
    protected $fillable = [
        "vehicule_id",
        "client_id",
        "date_debut",
        "date_fin",
        "prix_total",
        "statut",
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, "vehicule_id");
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, "utilisateur_id");
    }
}
