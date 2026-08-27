<?php

namespace App\Core;
use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private static ?PDO $pdoInstance = null;
   

    private function __construct()
    {
    }

    private static function getInstance(): PDO
    {
        if (self::$pdoInstance === null) {

            try {

                $dsn = "pgsql:host=localhost;dbname=classes_eleves";

                self::$pdoInstance = new PDO(
                    $dsn,
                    "postgres",
                    "sene"
                );

                self::$pdoInstance->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

            } catch (PDOException $e) {

                error_log(
                    "Connexion PostgreSQL échouée : "
                    . $e->getMessage()
                );

                throw new Exception(
                    "Erreur de connexion à la base de données."
                );
            }
        }

        return self::$pdoInstance;
    }

    public static function query(
        string $sql,
        bool $single = true
    ): mixed {

        $query = self::getInstance()->query($sql);

        return $single
            ? $query->fetch(PDO::FETCH_OBJ)
            : $query->fetchAll(PDO::FETCH_OBJ);
    }

    private static function prepare(
        string $sql,
        array $datas
    ): PDOStatement {

        $prepare = self::getInstance()->prepare($sql);

        $prepare->execute($datas);

        return $prepare;
    }

    public static function executeQuery(
        string $sql,
        array $datas,
        bool $single = true
    ): mixed {

        $statement = self::prepare($sql, $datas);

        return $single
            ? $statement->fetch(PDO::FETCH_OBJ)
            : $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function executeUpdate(
        string $sql,
        array $datas
    ): int|string {

        $statement = self::prepare($sql, $datas);

        if (
            str_starts_with(
                strtoupper(trim($sql)),
                'INSERT'
            )
        ) {
            return self::getInstance()->lastInsertId();
        }

        return $statement->rowCount();
    }

    public static function getAllData(
        string $tableName
    ): array {

        $sql = "SELECT * FROM $tableName";

        return self::query($sql, false);
    }
}