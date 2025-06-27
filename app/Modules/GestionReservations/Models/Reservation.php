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
        "notes_speciales",
        "date_debut_location",
        "date_fin_location",
    ];

    protected $casts = [
        "date_debut_location" => "datetime",
        "date_fin_location" => "datetime",
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, "vehicule_id");
    }

    public function client()
    {
        return $this->belongsTo(Utilisateur::class, "utilisateur_id");
    }
}
