<?php

namespace App\Modules\GestionUtilisateurs\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\GestionVehicules\Models\Vehicule;
// use App\Modules\GestionPermissions\Models\Permission;
use App\Modules\GestionUtilisateurs\Models\Role;
use App\Modules\GestionReservations\Models\Reservation;
class Utilisateur extends Model
{
    protected $fillable = [
        "nom",
        "prenom",
        "email",
        "mot_de_passe",
        "telephone",
        "adresse",
        "role_id", // Assurez-vous que role_id est dans fillable si vous l'assignez massivement
    ];

    protected $hidden = ["mot_de_passe", "remember_token"];
    protected $casts = [
        "email_verified_at" => "datetime",
        "mot_de_passe" => "hashed", // Laravel va hasher automatiquement
    ];

    public function vehicules()
    {
        // ou vehiculesGeres(), vehiculesPossedes()
        return $this->hasMany(Vehicule::class, "utilisateur_id");
    }

    public function role()
    {
        // Le deuxième argument 'role_id' est la clé étrangère sur la table 'utilisateurs'
        // Le troisième argument 'id' est la clé primaire sur la table 'roles' (Laravel le déduit souvent)
        return $this->belongsTo(Role::class, "role_id");
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class, "utilisateur_id");
    }

    public function hasRole(string $nomRole): bool
    {
        return $this->role && $this->role->nom === $nomRole;
    }
}
