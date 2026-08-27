<?php
namespace App\Model\Entite;
class Tuteur
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $telephone;

    public function __construct(
        int $id,
        string $nom,
        string $prenom,
        string $telephone
    ) {
        if (empty(trim($nom))) {
            throw new Exception("Le nom est obligatoire.");
        }

        if (empty(trim($prenom))) {
            throw new Exception("Le prénom est obligatoire.");
        }

        if (empty(trim($telephone))) {
            throw new Exception("Le téléphone est obligatoire.");
        }

        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
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

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public static function toEntity(object $obj): self
    {
        return new self(
            id: (int) ($obj->tuteur_id ?? $obj->id),
            nom: $obj->tuteur_nom ?? $obj->nom,
            prenom: $obj->tuteur_prenom ?? $obj->prenom,
            telephone: $obj->telephone
        );
    }
}