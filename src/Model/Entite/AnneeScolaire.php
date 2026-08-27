<?php
namespace App\Model\Entite;
class AnneeScolaire
{
    private int $id;
    private string $nom;
    private string $date;
    private int $actif;

    public function __construct(
        int $id,
        string $nom,
        string $date,
        int $actif
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->date = $date;
        $this->actif = $actif;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getActif(): int
    {
        return $this->actif;
    }

    public function setActif(int $actif): void
    {
        $this->actif = $actif;
    }

    public static function toEntity(object $obj): self
    {
        return new self(
            id: (int) $obj->id,
            nom: $obj->nom,
            date: $obj->date,
            actif: $obj->actif
        );
    }
}