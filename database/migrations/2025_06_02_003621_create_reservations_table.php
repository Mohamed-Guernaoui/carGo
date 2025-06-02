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
                ->foreignId("utilisateur_id")
                ->constrained("utilisateurs")
                ->onDelete("cascade"); // Si l'utilisateur est supprimé, ses réservations aussi
            $table
                ->foreignId("vehicule_id")
                ->constrained("vehicules")
                ->onDelete("cascade"); // Si le véhicule est supprimé, ses réservations aussi (à discuter, peut-être 'restrict' ou 'set null' si un véhicule peut être "retiré")

            $table->dateTime("date_debut_location");
            $table->dateTime("date_fin_location");
            $table->decimal("prix_total", 10, 2);
            $table->string("statut")->default("en_attente"); // Ex: 'en_attente', 'confirmee', 'annulee', 'active', 'terminee'
            $table->text("notes_speciales")->nullable();

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
