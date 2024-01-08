<?php

namespace App\Models;

use App\Interfaces\Recherchable;

class LivreSpecialise extends Livre implements Recherchable
{
    private $Type;

    public function __construct($Titre, $Author, $PublicationYear, $Type)
    {
        parent::__construct($Titre, $Author, $PublicationYear);
        $this->Type = $Type;
    }

    public function getType()
    {
        return $this->Type;
    }

    public function setType($Type)
    {
        $this->Type = $Type;

        return $this;
    }
    public function getPage()
    {
        return 20 * 5;
    }
}
