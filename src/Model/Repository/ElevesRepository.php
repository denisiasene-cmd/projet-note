<?php

namespace App\Model\Repository;

use App\Core\Database;

class ElevesRepository
{
    private function __construct()
    {
    }

    public static function getSexeByEleve()
    {
        $sql = "SELECT sexe
                FROM eleves
                WHERE sexe IS NOT NULL;";

        return Database::query($sql, false);
    }

    public static function saveEleve(array $data)
    {
        $sql = "INSERT INTO eleves
                (
                    nom,
                    prenom,
                    matricule,
                    date_naissance,
                    lieu_naissance,
                    sexe,
                    id_tuteur
                )
                VALUES
                (
                    :nom,
                    :prenom,
                    :matricule,
                    :date_naissance,
                    :lieu_naissance,
                    :sexe,
                    :id_tuteur
                )";

        return Database::executeUpdate($sql, [
            ':nom'            => $data['nom'],
            ':prenom'         => $data['prenom'],
            ':matricule'      => $data['matricule'],
            ':date_naissance' => $data['date_naissance'],
            ':lieu_naissance' => $data['lieu_naissance'],
            ':sexe'           => $data['sexe'],
            ':id_tuteur'      => $data['id_tuteur']
        ]);
    }
}