<?php

namespace Database\Seeders;

use App\Modules\GestionVehicules\Models\Vehicule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehiculeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // In database/seeders/VehiculeSeeder.php
    public function run()
    {
        $vehicules = [
            [
                "marque" => "Toyota",
                "modele" => "Corolla",
                "plaque_immatriculation" => "AB-123-CD",
                "annee" => 2020,
                "couleur" => "Blanc",
                "nombre_places" => 5,
                "transmission" => "automatique",
                "type_carburant" => "essence",
                "tarif_journalier" => 45.0,
                "description" => "Voiture compacte économique et fiable",
                "owner_id" => 1,
            ],
            [
                "marque" => "Renault",
                "modele" => "Clio",
                "plaque_immatriculation" => "BC-234-DE",
                "annee" => 2019,
                "couleur" => "Rouge",
                "nombre_places" => 5,
                "transmission" => "manuelle",
                "type_carburant" => "diesel",
                "tarif_journalier" => 35.0,
                "description" => "Citadine économique idéale pour la ville",
                "owner_id" => 2,
            ],
            [
                "marque" => "Peugeot",
                "modele" => "308",
                "plaque_immatriculation" => "CD-345-EF",
                "annee" => 2021,
                "couleur" => "Gris",
                "nombre_places" => 5,
                "transmission" => "automatique",
                "type_carburant" => "hybride",
                "tarif_journalier" => 50.0,
                "description" => "Berline familiale confortable et spacieuse",
                "owner_id" => 1,
            ],
            [
                "marque" => "Volkswagen",
                "modele" => "Golf",
                "plaque_immatriculation" => "DE-456-FG",
                "annee" => 2022,
                "couleur" => "Noir",
                "nombre_places" => 5,
                "transmission" => "automatique",
                "type_carburant" => "essence",
                "tarif_journalier" => 55.0,
                "description" => "Compacte allemande robuste et performante",
                "owner_id" => 2,
            ],
            [
                "marque" => "BMW",
                "modele" => "Serie 3",
                "plaque_immatriculation" => "EF-567-GH",
                "annee" => 2021,
                "couleur" => "Bleu",
                "nombre_places" => 5,
                "transmission" => "automatique",
                "type_carburant" => "diesel",
                "tarif_journalier" => 75.0,
                "description" => "Berline premium avec finitions luxueuses",
                "owner_id" => 3,
            ],
            [
                "marque" => "Mercedes",
                "modele" => "Classe C",
                "plaque_immatriculation" => "FG-678-HI",
                "annee" => 2022,
                "couleur" => "Blanc",
                "nombre_places" => 5,
                "transmission" => "automatique",
                "type_carburant" => "hybride",
                "tarif_journalier" => 80.0,
                "description" => "Berline luxueuse avec technologie de pointe",
                "owner_id" => 3,
            ],
            [
                "marque" => "Audi",
                "modele" => "A4",
                "plaque_immatriculation" => "GH-789-IJ",
                "annee" => 2021,
                "couleur" => "Gris",
                "nombre_places" => 5,
                "transmission" => "automatique",
                "type_carburant" => "diesel",
                "tarif_journalier" => 70.0,
                "description" => "Berline allemande élégante et performante",
                "owner_id" => 1,
            ],
            [
                "marque" => "Citroen",
                "modele" => "C3",
                "plaque_immatriculation" => "HI-890-JK",
                "annee" => 2020,
                "couleur" => "Rouge",
                "nombre_places" => 5,
                "transmission" => "manuelle",
                "type_carburant" => "essence",
                "tarif_journalier" => 30.0,
                "description" => "Citadine confortable avec style unique",
                "owner_id" => 2,
            ],
            [
                "marque" => "Ford",
                "modele" => "Focus",
                "plaque_immatriculation" => "IJ-901-KL",
                "annee" => 2021,
                "couleur" => "Blanc",
                "nombre_places" => 5,
                "transmission" => "manuelle",
                "type_carburant" => "essence",
                "tarif_journalier" => 40.0,
                "description" =>
                    "Compacte polyvalente avec bonnes performances",
                "owner_id" => 3,
            ],
            [
                "marque" => "Nissan",
                "modele" => "Qashqai",
                "plaque_immatriculation" => "JK-012-LM",
                "annee" => 2022,
                "couleur" => "Noir",
                "nombre_places" => 5,
                "transmission" => "automatique",
                "type_carburant" => "hybride",
                "tarif_journalier" => 60.0,
                "description" => "SUV compact polyvalent et spacieux",
                "owner_id" => 1,
            ],
            [
                "marque" => "Hyundai",
                "modele" => "Tucson",
                "plaque_immatriculation" => "KL-123-MN",
                "annee" => 2021,
                "couleur" => "Bleu",
                "nombre_places" => 5,
                "transmission" => "automatique",
                "type_carburant" => "hybride",
                "tarif_journalier" => 55.0,
                "description" => "SUV moderne avec équipement complet",
                "owner_id" => 2,
            ],
            [
                "marque" => "Dacia",
                "modele" => "Duster",
                "plaque_immatriculation" => "LM-234-NO",
                "annee" => 2020,
                "couleur" => "Marron",
                "nombre_places" => 5,
                "transmission" => "manuelle",
                "type_carburant" => "diesel",
                "tarif_journalier" => 35.0,
                "description" => "SUV économique robuste et abordable",
                "owner_id" => 3,
            ],
            [
                "marque" => "Seat",
                "modele" => "Leon",
                "plaque_immatriculation" => "MN-345-OP",
                "annee" => 2021,
                "couleur" => "Rouge",
                "nombre_places" => 5,
                "transmission" => "manuelle",
                "type_carburant" => "essence",
                "tarif_journalier" => 45.0,
                "description" => "Compacte sportive et dynamique",
                "owner_id" => 1,
            ],
            [
                "marque" => "Fiat",
                "modele" => "500",
                "plaque_immatriculation" => "NO-456-PQ",
                "annee" => 2022,
                "couleur" => "Jaune",
                "nombre_places" => 4,
                "transmission" => "manuelle",
                "type_carburant" => "essence",
                "tarif_journalier" => 30.0,
                "description" => "Petite citadine stylée et agile",
                "owner_id" => 2,
            ],
            [
                "marque" => "Kia",
                "modele" => "Sportage",
                "plaque_immatriculation" => "OP-567-QR",
                "annee" => 2022,
                "couleur" => "Vert",
                "nombre_places" => 5,
                "transmission" => "automatique",
                "type_carburant" => "hybride",
                "tarif_journalier" => 60.0,
                "description" => "SUV moderne avec garantie longue durée",
                "owner_id" => 3,
            ],
        ];

        foreach ($vehicules as $vehicule) {
            $v = Vehicule::create($vehicule);
            try {
                $v->addMediaFromUrl(
                    "https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Y2FyfGVufDB8fDB8fHww"
                )->toMediaCollection("vehicules");
            } catch (\Exception $e) {
                // Log error or use fallback image
                logger()->error(
                    "Failed to download image: " . $e->getMessage()
                );
            }
        }
    }
}
