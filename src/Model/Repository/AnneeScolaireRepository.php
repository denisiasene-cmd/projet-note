<?php

namespace App\Model\Repository;

use App\Core\Database;

class AnneeScolaireRepository
{
    public static function getAnneeScolaireActive(): ?object
    {
        $sql = "
            SELECT
                nom,
                actif
            FROM anneescolaires
            WHERE actif = 'OUI'
            LIMIT 1
        ";

        return Database::query($sql, true);
    }
}