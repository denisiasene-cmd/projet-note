<?php
namespace App\Model\Repository;

use App\Core\Database;

class InscriptionRepository
{
    public static function getAllInscription(
        int $page = 1,
        int $limit = 2,
        string $recherche = '',
        string $classe = '',
        string $statut = ''
    ): array {

        $offset = ($page - 1) * $limit;

        $sql = "
            SELECT
                i.id,
                e.nom,
                e.prenom,
                e.date_naissance,
                e.matricule,
                c.nomClasse,
                et.nom_etablissement,
                t.nom AS tuteur_nom,
                t.prenom AS tuteur_prenom,
                s.mode_statuts AS statut_nom

            FROM inscriptions i

            INNER JOIN classes c
                ON i.classe_id = c.id

            INNER JOIN eleves e
                ON i.eleve_id = e.id

            INNER JOIN tuteurs t
                ON e.id_tuteur = t.id

            INNER JOIN etablissements et
                ON et.id_inscription = i.id

            INNER JOIN statuts s
                ON i.id_statuts_inscription = s.id

           WHERE
(
    e.nom ILIKE :recherche
    OR e.prenom ILIKE :recherche
    OR e.matricule ILIKE :recherche
    OR CONCAT(e.prenom, ' ', e.nom) ILIKE :recherche
    OR CONCAT(e.nom, ' ', e.prenom) ILIKE :recherche
    OR t.nom ILIKE :recherche
    OR t.prenom ILIKE :recherche
    OR CONCAT(t.prenom, ' ', t.nom) ILIKE :recherche
    OR CONCAT(t.nom, ' ', t.prenom) ILIKE :recherche
)

            AND (:classe = '' OR c.nomClasse = :classe)

            AND (:statut = '' OR s.mode_statuts = :statut)

            ORDER BY i.id DESC

            LIMIT $limit
            OFFSET $offset
        ";

        return Database::executeQuery(
            $sql,
            [
                'recherche' => '%' . $recherche . '%',
                'classe' => $classe,
                'statut' => $statut
            ],
            false
        );
    }


    public static function getTotalByEleves(
        int $limit = 2,
        string $recherche = '',
        string $classe = '',
        string $statut = ''
    ): array {

        $sql = "
            SELECT CEIL(COUNT(*)::numeric / $limit) AS nombre_pages

            FROM inscriptions i

            INNER JOIN classes c
                ON i.classe_id = c.id

            INNER JOIN eleves e
                ON i.eleve_id = e.id

            INNER JOIN tuteurs t
                ON e.id_tuteur = t.id

            INNER JOIN etablissements et
                ON et.id_inscription = i.id

            INNER JOIN statuts s
                ON i.id_statuts_inscription = s.id

            WHERE
            (
                e.nom ILIKE :recherche
                OR e.prenom ILIKE :recherche
                OR e.matricule ILIKE :recherche
                OR t.nom ILIKE :recherche
                OR t.prenom ILIKE :recherche
            )

            AND (:classe = '' OR c.nomClasse = :classe)

            AND (:statut = '' OR s.mode_statuts = :statut)
        ";

        return Database::executeQuery(
            $sql,
            [
                'recherche' => '%' . $recherche . '%',
                'classe' => $classe,
                'statut' => $statut
            ],
            false
        );
    }
}