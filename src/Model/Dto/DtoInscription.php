<?php
namespace App\Model\Dto;
class DtoInscription
{
    private string $prenom;
    private string $nom;
    private string $sexe;
    private string $lieuNaissance;
    private string $dateNaissance;

    private int $etablissement;
    private int $niveau;
    private ?int $classe;

    public function __construct(
        string $prenom,
        string $nom,
        string $sexe,
        string $lieuNaissance,
        string $dateNaissance,
        int $etablissement,
        int $niveau,
        ?int $classe
    ) {
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->sexe = $sexe;
        $this->lieuNaissance = $lieuNaissance;
        $this->dateNaissance = $dateNaissance;
        $this->etablissement = $etablissement;
        $this->niveau = $niveau;
        $this->classe = $classe;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getSexe(): string
    {
        return $this->sexe;
    }

    public function getLieuNaissance(): string
    {
        return $this->lieuNaissance;
    }

    public function getDateNaissance(): string
    {
        return $this->dateNaissance;
    }

    public function getEtablissement(): int
    {
        return $this->etablissement;
    }

    public function getNiveau(): int
    {
        return $this->niveau;
    }

    public function getClasse(): ?int
    {
        return $this->classe;
    }
}