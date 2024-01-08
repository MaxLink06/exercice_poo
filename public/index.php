<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Helpers\UIHelper;


use App\Models\Exemple;
use App\Models\LivreSpecialise;

$DefaultBook = new LivreSpecialise("Le Petit Prince", 'Antoine de Saint-Exupéry', 1943, "Livre");
$DefaultBook2 = new LivreSpecialise("Son odeur après la pluie", 'Cédric Sapin-Defour', 2023, "Roman");
$array = [$DefaultBook, $DefaultBook2];

echo "Livre par défaut : \n";
echo sprintf("Titre: %s \n", $DefaultBook->getTitre());
echo sprintf("Auteur: %s \n", $DefaultBook->getAuthor());
echo sprintf("Année de publication: %s \n", $DefaultBook->getPublicationYear());
echo sprintf("Type: %s \n", $DefaultBook->getType());

$DefaultBook->setTitre("Veiller sur elle");
echo sprintf("Titre: %s \n", $DefaultBook->getTitre());

echo sprintf("Page DefaultBook: %s \n", $DefaultBook->getPage());
$Exemple = new Exemple();
echo sprintf("Page Exemple: %s \n", $Exemple->getPage());
echo "\n";

// UIHelper::afficherMenu();
UIHelper::afficherLivresSousFormeDeTableau($array);
