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
        Schema::create("vehicules", function (Blueprint $table) {
            $table->id();
            $table->string("marque");
            $table->string("modele");
            $table->string("plaque_immatriculation")->unique();
            $table->year("annee")->nullable();
            $table->string("couleur")->nullable();
            $table
                ->unsignedTinyInteger("nombre_places")
                ->nullable()
                ->default(5);
            $table->string("transmission")->nullable(); // Ex: 'manuelle', 'automatique'
            $table->string("type_carburant")->nullable(); // Ex: 'essence', 'diesel', 'electrique'
            $table->decimal("tarif_journalier", 8, 2);
            $table->boolean("disponible")->default(true);
            $table->string("image_principale_url")->nullable(); // URL ou chemin vers l'image
            $table->text("description")->nullable();
            $table
                ->foreignId("user_id")
                ->nullable()
                ->comment(
                    'Référence à l\'user propriétaire ou gestionnaire du véhicule'
                )
                ->constrained("users")
                ->onDelete("set null");

            // Clés étrangères optionnelles (nécessitent les migrations des tables correspondantes)
            // $table->foreignId('categorie_vehicule_id')->nullable()->constrained('categorie_vehicules')->onDelete('set null');
            // $table->foreignId('depot_id')->nullable()->constrained('depots')->onDelete('set null'); // Si chaque véhicule est rattaché à un dépôt principal

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("vehicules");
    }
};
