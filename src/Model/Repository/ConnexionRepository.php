<?php

namespace App\Model\Repository;

use App\Core\Database;

class ConnexionRepository
{
    private function __construct()
    {
    }

    public static function getConnexion()
    {
        $sql = "SELECT * FROM eleves WHERE lieu_naissance IS NOT NULL;";

        return Database::query($sql, false);
    }
}