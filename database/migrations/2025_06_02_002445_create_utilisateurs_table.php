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
        Schema::create("utilisateurs", function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom")->nullable();
            $table->string("email")->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("mot_de_passe");
            $table->string("telephone")->nullable();
            $table->text("adresse")->nullable();
            $table->rememberToken();

            $table
                ->foreignId("role_id")
                ->nullable()
                ->constrained("roles")
                ->onDelete("set null");
            // Si un rôle est obligatoire, enlevez nullable() et onDelete('set null')
            // et assurez-vous qu'un rôle par défaut est assigné.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("utilisateurs");
    }
};
