<?php
namespace App\Model\Entite;
use App\Model\Entite\StatutInscription;


class Inscription
{
    private int $id;
    private AnneeScolaire $anneeScolaire;
    private Eleve $eleve;
    private Classe $classe;
    private StatutInscription $statutInscription;
    private ?Utilisateur $utilisateur;

    public function __construct(
        int $id,
        AnneeScolaire $anneeScolaire,
        Eleve $eleve,
        Classe $classe,
        StatutInscription $statutInscription,
        ?Utilisateur $utilisateur = null
    ) {
        $this->id = $id;
        $this->anneeScolaire = $anneeScolaire;
        $this->eleve = $eleve;
        $this->classe = $classe;
        $this->statutInscription = $statutInscription;
        $this->utilisateur = $utilisateur;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAnneeScolaire(): AnneeScolaire
    {
        return $this->anneeScolaire;
    }

    public function getEleve(): Eleve
    {
        return $this->eleve;
    }

    public function getClasse(): Classe
    {
        return $this->classe;
    }

    public function getStatutInscription(): StatutInscription
    {
        return $this->statutInscription;
    }

    public function setStatutInscription(
        StatutInscription $statutInscription
    ): void {
        $this->statutInscription = $statutInscription;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): void
    {
        $this->utilisateur = $utilisateur;
    }

    public static function toEntity(object $obj): self
    {
        $statut = StatutInscription::from(
            $obj->statut_nom
        );

        return new self(
            id: (int) ($obj->inscription_id ?? $obj->id),
            anneeScolaire: AnneeScolaire::toEntity($obj),
            eleve: Eleve::toEntity($obj),
            classe: Classe::toEntity($obj),
            statutInscription: $statut,
            utilisateur: null
        );
    }
}