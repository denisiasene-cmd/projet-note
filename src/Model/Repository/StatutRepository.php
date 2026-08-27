<?php

namespace App\Model\Repository;
use App\Core\Database;

class StatutRepository
{
    public static function getAllStatut(): array
    {
        $sql = "
            SELECT
                id,
                mode_statuts
            FROM statuts
            ORDER BY mode_statuts ASC
        ";

        return Database::executeQuery(
            $sql,
            [],
            false
        );
    }
}