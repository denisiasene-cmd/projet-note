<?php
namespace App\Model\Entite;
class Justificatif
{
    private int $id;
    private int $eleve_id;
    private ?string $extrait_naissance;
    private ?string $certificat_medical;
    private ?string $anciens_bulletins;
    private ?string $photos_identite;

    public function __construct(
        int $id,
        int $eleve_id,
        ?string $extrait_naissance = null,
        ?string $certificat_medical = null,
        ?string $anciens_bulletins = null,
        ?string $photos_identite = null
    ) {
        $this->id = $id;
        $this->eleve_id = $eleve_id;
        $this->extrait_naissance = $extrait_naissance;
        $this->certificat_medical = $certificat_medical;
        $this->anciens_bulletins = $anciens_bulletins;
        $this->photos_identite = $photos_identite;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEleveId(): int
    {
        return $this->eleve_id;
    }

    public function getExtraitNaissance(): ?string
    {
        return $this->extrait_naissance;
    }

    public function getCertificatMedical(): ?string
    {
        return $this->certificat_medical;
    }

    public function getAnciensBulletins(): ?string
    {
        return $this->anciens_bulletins;
    }

    public function getPhotosIdentite(): ?string
    {
        return $this->photos_identite;
    }
}