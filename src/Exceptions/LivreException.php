<?php

namespace App\Exceptions;

class LivreException extends \Exception {

    public function __construct(string $message, int $code = 0, ?\Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function unkownArgument($var_name){
        $error="\nDésolé, l'attribut \"{$var_name}\" n'éxiste pas.\n";
        echo $error;
        return $error;
    }
}