<?php
namespace App\Model\Entite;

class Eleve
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $matricule;
    private string $date_naissance;
    private ?Tuteur $tuteur;

    public function __construct(
        int $id,
        string $nom,
        string $prenom,
        string $matricule,
        string $date_naissance,
        ?Tuteur $tuteur = null
    ) {
        if (empty(trim($nom))) {
            throw new Exception("Le nom est obligatoire.");
        }

        if (empty(trim($prenom))) {
            throw new Exception("Le prénom est obligatoire.");
        }

        if (empty(trim($matricule))) {
            throw new Exception("Le matricule est obligatoire.");
        }

        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->matricule = $matricule;
        $this->date_naissance = $date_naissance;
        $this->tuteur = $tuteur;
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

    public function getMatricule(): string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): void
    {
        $this->matricule = $matricule;
    }

    public function getDateNaissance(): string
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(string $date_naissance): void
    {
        $this->date_naissance = $date_naissance;
    }

    public function getTuteur(): ?Tuteur
    {
        return $this->tuteur;
    }

    public function setTuteur(?Tuteur $tuteur): void
    {
        $this->tuteur = $tuteur;
    }

    public static function toEntity(object $obj): self
    {
        $tuteur = null;

        if (
            isset($obj->tuteur_id) &&
            $obj->tuteur_id !== null
        ) {
            $tuteur = Tuteur::toEntity($obj);
        }

        return new self(
            id: (int) ($obj->eleve_id ?? $obj->id),
            nom: $obj->eleve_nom ?? $obj->nom,
            prenom: $obj->eleve_prenom ?? $obj->prenom,
            matricule: $obj->eleve_matricule ?? $obj->matricule,
            date_naissance: $obj->eleve_date_naissance ?? $obj->date_naissance,
            tuteur: $tuteur
        );
    }
}