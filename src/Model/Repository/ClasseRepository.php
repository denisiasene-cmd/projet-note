<?php

namespace App\Model\Repository;

use App\Core\Database;

class ClasseRepository
{
    public static function getAllClasses(): array
    {
        $sql = "
            SELECT
                id,
                nomClasse
            FROM classes
            ORDER BY nomClasse ASC
        ";

        return Database::executeQuery(
            $sql,
            [],
            false
        );
    }

    public static function getClasseNonAffecter()
    {
        $sql = "SELECT c.id, c.nomClasse FROM classes c LEFT JOIN niveaux n ON c.id_niveau = n.id WHERE c.id_niveau IS NULL;";

        return Database::query($sql, false);
    }
}