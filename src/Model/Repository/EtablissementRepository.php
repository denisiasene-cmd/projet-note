<?php
namespace App\Model\Repository;

use App\Core\Database;


class EtablissementRepository
{
    private function __construct()
    {
    }

    public static function getAllEtablissement(): array
    {
        $sql = "SELECT * FROM etablissements";

        return Database::query($sql, false);
    }
}