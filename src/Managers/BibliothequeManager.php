<?php

namespace App\Managers;

use App\Abstract\ItemBibliotheque;
use App\Exceptions\LivreException;
use App\Interfaces\Recherchable;
use App\Traits\Loggable;
use App\Models\Livre;
use App\Models\LivreSpecialise;

class BibliothequeManager implements Recherchable
{
    use Loggable;

    const ANNEE_PUBLICATION_LONGUEUR = 4;
    const CATEGORIE_DEFAUT = "Général";

    private array $livres;
    private array $domainesDisponibles;
    private int $prochainIdentifiant;

    public function __construct()
    {
        $this->livres = [];
        $this->domainesDisponibles = ["Science-fiction", "Histoire", "Art", "Technologie", "Roman"];
        $this->prochainIdentifiant = 1;
        $this->chargerLivresInitiaux();
    }

    private function chargerLivresInitiaux()
    {
        $this->ajouterLivre("The Stranger", "Albert Camus", 1942, "Roman");
        $this->ajouterLivre("Le Guide du Voyageur Galactique", "Douglas Adams", 1979, "Science-fiction");
        $this->ajouterLivre("Fondation", "Isaac Asimov", 1951, "Science-fiction");
    }

    public function ajouterLivre(string $titre, string $auteur, int $anneePublication, ?string $domaine = null): void {
        try {
            $identifiant = $this->prochainIdentifiant++;
            $this->verifierEtAjouterDomaine($domaine ?? self::CATEGORIE_DEFAUT);

            if (!self::validerAnneePublication($anneePublication)) {
                throw new LivreException("L'année de publication doit comporter " . self::ANNEE_PUBLICATION_LONGUEUR . " chiffres.");
            }

            $livre = $domaine ? new LivreSpecialise($titre, $auteur, $anneePublication, $domaine) 
                              : new Livre($titre, $auteur, $anneePublication);
            $this->livres[] = $livre;
            // $this->log("Livre ajouté: " . $titre);
        } catch (\Exception $e) {
            throw new LivreException("Erreur lors de l'ajout du livre: " . $e->getMessage());
        }
    }

    // Méthode statique pour valider l'année de publication
    public static function validerAnneePublication(int $annee): bool {
        return strlen((string)$annee) === self::ANNEE_PUBLICATION_LONGUEUR;
    }

    private function verifierEtAjouterDomaine(?string $domaine): void
    {
        if ($domaine && !in_array($domaine, $this->domainesDisponibles)) {
            $this->domainesDisponibles[] = $domaine;
        }
    }

    public function ajouterDomaine(string $nouveauDomaine): void
    {
        if (!in_array($nouveauDomaine, $this->domainesDisponibles)) {
            $this->domainesDisponibles[] = $nouveauDomaine;
        }
    }

    public function supprimerDomaine(string $domaine): void
    {
        $this->domainesDisponibles = array_filter($this->domainesDisponibles, function ($d) use ($domaine) {
            return $d !== $domaine;
        });
    }

    public function getDomainesDisponibles(): array
    {
        return $this->domainesDisponibles;
    }

public function rechercherParTitre(string $critere): array
    {
        $resultats = [];
        foreach ($this->livres as $livre) {
            if (strpos(strtolower($livre->getTitre()), strtolower($critere)) !== false) {
                $resultats[] = $livre;
            }
        }
        return $resultats;
    }

    public function rechercher(string $critere): array
    {
        return $this->rechercherParTitre($critere);
    }

    public function rechercherParDomaine(array $domaines): array
    {
        $resultats = [];
        foreach ($this->livres as $livre) {
            if (in_array(null, $domaines) && !$livre instanceof LivreSpecialise) {
                $resultats[] = $livre;
            } elseif ($livre instanceof LivreSpecialise && in_array($livre->domaine, $domaines)) {
                $resultats[] = $livre;
            }
        }
        return $resultats;
    }

    public function getLivres(): array
    {
        return $this->livres;
    }
}