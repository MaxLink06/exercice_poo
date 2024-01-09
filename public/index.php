<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Helpers\UIHelper;
use App\Managers\BibliothequeManager;

$manager = new BibliothequeManager();

while (true) {
    UIHelper::afficherMenu();
    $choix = readline();

    switch ($choix) {
    case "1":
        $titre = readline("Entrez le titre : ");
        $auteur = readline("Entrez l'auteur : ");
        $anneePublicationStr = readline("Entrez l'année de publication : ");
        $domaine = readline("Entrez le domaine (ou laissez vide) : ");

        $anneePublication = filter_var($anneePublicationStr, FILTER_VALIDATE_INT, [
            "options" => [
                "min_range" => 1000,
                "max_range" => 9999
            ]
        ]);

        if ($anneePublication === false) {
            echo "L'année de publication doit être un nombre à 4 chiffres. Echec de l'ajout.\n";
            break; 
        }

        $manager->ajouterLivre($titre, $auteur, $anneePublication, $domaine);
        break;

        case "2":
            $livres = $manager->getLivres();
            echo "\nListe des livres :\n";
            UIHelper::afficherLivresSousFormeDeTableau($livres);
            break;

        case "3":
            $critere = readline("Entrez le titre à rechercher : ");
            $resultats = $manager->rechercherParTitre($critere);
            echo "\nRésultats de la recherche par titre :\n";
            UIHelper::afficherLivresSousFormeDeTableau($resultats);
            break;

        case "4":
            echo "\nDomaines disponibles :\n";
            UIHelper::afficherDomaines($manager->getDomainesDisponibles());
            $indicesDomaines = explode(',', readline("Choisissez les numéros des domaines (séparés par une virgule, '0' pour sans domaine) : "));
            $domainesChoisis = [];

            foreach ($indicesDomaines as $indice) {
                if ($indice == "0") {
                    $domainesChoisis[] = null;
                } else {
                    $domaine = $manager->getDomainesDisponibles()[$indice - 1] ?? null;
                    if ($domaine) {
                        $domainesChoisis[] = $domaine;
                    }
                }
            }

            $resultats = $manager->rechercherParDomaine($domainesChoisis);
            echo "\nRésultats de la recherche par domaine :\n";
            UIHelper::afficherLivresSousFormeDeTableau($resultats);
            break;

        case "5":
            exit("\033[1;32mFin du programme.\n\033[0m");

        default:
            echo "\033[1;31mOption non valide. Veuillez réessayer.\n\033[0m";
    }
}
