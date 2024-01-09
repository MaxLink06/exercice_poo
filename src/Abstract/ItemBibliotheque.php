<?php

namespace App\Abstract;
use App\Exceptions\LivreException;

abstract class ItemBibliotheque {
    protected $titre;
    protected $auteur;
    protected $anneePublication;

    public function __construct($titre, $auteur, $anneePublication) {
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->anneePublication = $anneePublication;
    }

    public function __get($var_name){
        try{
            return $this->{$var_name}; 
        } catch(LivreException $e){
            throw new LivreException($e->unkownArgument($var_name));
        }
    }

    public function __set($var_name, $value){
        try{
            $this->{$var_name} = $value;
        } catch(LivreException $e){
            throw new LivreException($e->unkownArgument($var_name));
        }
    }
}