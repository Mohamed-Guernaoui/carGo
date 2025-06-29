<?php

namespace App\Modules\GestionReservations\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\GestionVehicules\Models\Vehicule;
use App\Modules\GestionUtilisateurs\Models\User;

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
        return $this->belongsTo(User::class, "client_id");
    }

    // Accessor for display duration (e.g., '3 days')
    public function getDurationInDaysAttribute()
    {
        if ($this->date_debut_location && $this->date_fin_location) {
            // Get difference in days and round up to whole days
            $diff = $this->date_debut_location->diffInDays(
                $this->date_fin_location
            );
            return (int) $diff; // Cast to integer to ensure we get a whole number
        }
        return 0;
    }

    // Accessor for readable status
    public function getStatusTextAttribute()
    {
        return str_replace("_", " ", ucfirst($this->status));
    }

    // Accessor for status badge color
    public function getStatusColorAttribute()
    {
        return [
            "en_attente" =>
                "bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300",
            "confirme" =>
                "bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300",
            "actif" =>
                "bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300",
            "termine" =>
                "bg-gray-100 text-gray-800 dark:bg-gray-700/50 dark:text-gray-300",
            "annule" =>
                "bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300",
        ][$this->status] ??
            "bg-gray-100 text-gray-800 dark:bg-gray-700/50 dark:text-gray-300";
    }
}
