<?php

namespace App\Models;

use App\Interfaces\Recherchable;

class Exemple implements Recherchable
{

    private $exe;

    public function getPage()
    {
        return 20 * 10;
    }
}
