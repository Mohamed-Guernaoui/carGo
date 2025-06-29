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
                "tarif_journalier" => 450.0,
                "description" => "Voiture compacte économique et fiable",
                "owner_id" => 19,
                "image_url" =>
                    "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%2Fid%2FOIP.ap5yoKO4qHc9eCj9mUZJtQHaEK%3Fr%3D0%26pid%3DApi&f=1&ipt=712e4088132431356bc1b43e8d62521bf1e21e8dfd8e6c5b1a8a72bc48beb63b&ipo=images",
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
                "tarif_journalier" => 350.0,
                "description" => "Citadine économique idéale pour la ville",
                "owner_id" => 19,
                "image_url" =>
                    "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%2Fid%2FOIP.8iYfQRoSHXU_YYFczrW5BgHaEs%3Fpid%3DApi&f=1&ipt=e3c9e7864db374e81f9761ef9557aeab41e53ed7f4a29ba0d4d736927d835545&ipo=images",
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
                "tarif_journalier" => 500.0,
                "description" => "Berline familiale confortable et spacieuse",
                "owner_id" => 19,
                "image_url" =>
                    "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.squarespace-cdn.com%2Fcontent%2Fv1%2F55d74953e4b054689caf6e9c%2F1472121397738-HMSJ4E7HPW064SM29376%2FPeugeot%2B12.jpg&f=1&nofb=1&ipt=c3e785eb352b0cbfc158eaa9769e2184b837d75731623f6ad95ad35916e39c0a",
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
                "tarif_journalier" => 550.0,
                "description" => "Compacte allemande robuste et performante",
                "owner_id" => 19,
                "image_url" =>
                    "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%2Fid%2FOIP.30mqKpYpOQVeVrYIqUKHlwAAAA%3Fpid%3DApi&f=1&ipt=4f79827360c27d2e7149d65fb5c60060fec741464192c2a682be71350df39c07&ipo=images",
            ],
        ];

        // Fallback image in case the URL fails
        $fallbackImageUrl =
            "https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Y2FyfGVufDB8fDB8fHww";

        foreach ($vehicules as $vehiculeData) {
            // Extract the image URL from the data and remove it from the array to be passed to create()
            $imageUrl = $vehiculeData["image_url"];
            unset($vehiculeData["image_url"]);

            // Create the vehicle
            $vehicule = Vehicule::create([
                "owner_id" => $vehiculeData["owner_id"],
                "marque" => $vehiculeData["marque"],
                "modele" => $vehiculeData["modele"],
                "plaque_immatriculation" =>
                    $vehiculeData["plaque_immatriculation"],
                "annee" => $vehiculeData["annee"],
                "couleur" => $vehiculeData["couleur"],
                "nombre_places" => $vehiculeData["nombre_places"],
                "transmission" => $vehiculeData["transmission"],
                "type_carburant" => $vehiculeData["type_carburant"],
                "tarif_journalier" => $vehiculeData["tarif_journalier"],
                "description" => $vehiculeData["description"],
            ]);

            // Attach the image to the vehicle
            try {
                $vehiculeData
                    ->addMediaFromUrl($imageUrl)
                    ->toMediaCollection("vehicules");
            } catch (\Exception $e) {
                // Log error and use fallback image
                logger()->error(
                    "Failed to download image: " . $e->getMessage()
                );

                try {
                    $vehicule
                        ->addMediaFromUrl($fallbackImageUrl)
                        ->toMediaCollection("vehicules");
                } catch (\Exception $e) {
                    logger()->error(
                        "Failed to download fallback image: " . $e->getMessage()
                    );
                }
            }
        }
    }
}
