<?php
namespace App\Model\Repository;
use App\Core\Database;

class JustificatifRepository
{
    public static function save(Justificatif $justificatif)
    {
        $sql = "INSERT INTO justificatifs (
                    eleve_id,
                    extrait_naissance,
                    certificat_medical,
                    anciens_bulletins,
                    photos_identite
                )
                VALUES (?, ?, ?, ?, ?)";

        return Database::executeUpdate($sql, [
            $justificatif->getEleveId(),
            $justificatif->getExtraitNaissance(),
            $justificatif->getCertificatMedical(),
            $justificatif->getAnciensBulletins(),
            $justificatif->getPhotosIdentite()
        ]);
    }
}