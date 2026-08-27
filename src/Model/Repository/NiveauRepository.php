<?php
namespace App\Model\Repository;
use App\Core\Database;

class NiveauRepository{
    private function __construct(){}

    public static function getAllNiveau(){
        $sql = "SELECT * FROM niveaux;";
        return Database::query($sql,false);
    }
}