<?php

namespace App\Models;

class Livre
{
    private $Titre;
    private $Author;
    private $PublicationYear;

    public function __construct($Titre, $Author, $PublicationYear)
    {
        $this->Titre = $Titre;
        $this->Author = $Author;
        $this->PublicationYear = $PublicationYear;
    }

    public function getTitre()
    {
        return $this->Titre;
    }
    public function setTitre($Titre)
    {
        return $this->Titre = $Titre;
    }


    public function getAuthor()
    {
        return $this->Author;
    }
    public function setAuthor($Author)
    {
        return $this->Author = $Author;
    }

    public function getPublicationYear()
    {
        return $this->PublicationYear;
    }
    public function setPublicationYear($PublicationYear)
    {
        return $this->PublicationYear = $PublicationYear;
    }
}
