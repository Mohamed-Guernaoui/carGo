<?php

namespace App\Modules\GestionUtilisateurs\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        "name",
        "email",
        "password",
        "cin",
        "company_name",
        "telephone",
        "address",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
        ];
    }

    /**
     * Scope a query to only include clients.
     */
    public function scopeClients($query)
    {
        return $query->where("role", "client");
    }

    /**
     * Scope a query to only include vehicle owners.
     */
    public function scopeOwners($query)
    {
        return $query->where("role", "owner");
    }

    public function isClient(): bool
    {
        return $this->role === "client";
    }

    public function vehicles()
    {
        return $this->hasMany(
            \App\Modules\GestionVehicules\Models\Vehicule::class,
            "owner_id"
        );
    }
    /**
     * Check if user is a vehicle owner.
     */
    public function isOwner(): bool
    {
        return $this->role === "owner";
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(" ")
            ->map(fn(string $name) => Str::of($name)->substr(0, 1))
            ->implode("");
    }
}
