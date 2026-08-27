<?php
namespace App\Model\Repository;
use App\Core\Database;

class TuteurRepository
{
    public static function saveTuteur($nom, $prenom, $telephone, $bourse, $adress)
    {
        $sql = "INSERT INTO tuteurs
                (nom, prenom, telephone, bourses, adress)
                VALUES
                (:nom, :prenom, :telephone, :bourses, :adress)
                RETURNING id";

        return Database::query($sql, [
            'nom'       => $nom,
            'prenom'    => $prenom,
            'telephone' => $telephone,
            'bourses'   => $bourse,
            'adress'    => $adress
        ]);
    }
}