<?php

class etablissement {
    private int $id;
    private string $nom_etablissement;
    private statut $statut;

    public function __construct(
        int $id,
        string $nom_etablissement,
        statut $statut
    ) { 
        $this->id = $id;
        $this->nom_etablissement = $nom_etablissement;
        $this->statut = $statut;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNomEtablissement(): string { 
        return $this->nom_etablissement; 
    }

    public function getStatut(): statut { 
        return $this->statut;
    }

    public function setNomEtablissement(string $nom_etablissement): void {
        if (empty(trim($nom_etablissement))) {
            throw new Exception("Le nom de l'établissement ne doit pas être vide.");
        }
        $this->nom_etablissement = $nom_etablissement;
    }

    public function setStatut(statut $statut): void {
        $this->statut = $statut;
    }
}
