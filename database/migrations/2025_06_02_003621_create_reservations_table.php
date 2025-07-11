<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("reservations", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("client_id")
                ->constrained("users")
                ->onDelete("cascade"); // Si l'user est supprimé, ses réservations aussi
            $table
                ->foreignId("vehicule_id")
                ->constrained("vehicules")
                ->onDelete("cascade"); // Si le véhicule est supprimé, ses réservations aussi (à discuter, peut-être 'restrict' ou 'set null' si un véhicule peut être "retiré")

            $table->dateTime("date_debut_location");
            $table->dateTime("date_fin_location");
            $table->decimal("prix_total", 10, 2);
            $table->text("notes_speciales")->nullable();
            $table
                ->enum("status", [
                    "en_attente",
                    "confirme",
                    "actif",
                    "termine",
                    "annule",
                ])
                ->default("en_attente");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("reservations");
    }
};
