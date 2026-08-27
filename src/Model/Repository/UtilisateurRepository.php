<?php
namespace App\Model\Repository;
use App\Core\Database;


class UtilisateurRepository
{
    public static function getUtilisateurConnecte(int $id): ?object
    {
        $sql = "
            SELECT
                u.id,
                u.prenom,
                u.nom,
                r.nomRole AS role,
                CONCAT(
                    LEFT(u.prenom, 1),
                    LEFT(u.nom, 1)
                ) AS initiales

            FROM utilisateurs u

            INNER JOIN roles r
                ON u.role_id = r.id

            WHERE u.id = :id
        ";

        return Database::executeQuery(
            $sql,
            [
                'id' => $id
            ],
            true
        );
    }
}