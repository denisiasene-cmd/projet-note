<?php
namespace App\Model\Dto;
class DtoTuteur
{
    private string $nom;
    private string $prenom;
    private string $telephone;
    private ?string $bourse;
    private ?string $adress;
    
    public function __construct(
        string $nom,
        string $prenom,
        string $telephone,
        ?string $bourse,
        ?string $adress
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
        $this->bourse = $bourse;
        $this->adress = $adress;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function getBourse(): ?string
    {
        return $this->bourse;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }
}