<?php

namespace App\Models;


class LivreSpecialise extends Livre {
    protected $domaine;

    public function __construct($titre, $auteur, $anneePublication, $domaine)
    {
        parent::__construct($titre, $auteur, $anneePublication);
        $this->domaine = $domaine;
    }
}