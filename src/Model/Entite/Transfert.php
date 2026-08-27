<?php

namespace App\Model\Entite;

use App\Model\Entite\Etablissement;
use App\Model\Entite\Inscription;
use App\Model\Entite\StatutTransfert;

class Transfert
{
    private int $id;
    private Etablissement $etablissementSortant;
    private Etablissement $etablissementEntrant;
    private Inscription $inscription;
    private StatutTransfert $statut;

    public function __construct(
        int $id,
        Etablissement $etablissementSortant,
        Etablissement $etablissementEntrant,
        Inscription $inscription,
        StatutTransfert $statut
    ) {
        $this->id = $id;
        $this->etablissementSortant = $etablissementSortant;
        $this->etablissementEntrant = $etablissementEntrant;
        $this->inscription = $inscription;
        $this->statut = $statut;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEtablissementSortant(): Etablissement
    {
        return $this->etablissementSortant;
    }

    public function getEtablissementEntrant(): Etablissement
    {
        return $this->etablissementEntrant;
    }

    public function getInscription(): Inscription
    {
        return $this->inscription;
    }

    public function getStatut(): StatutTransfert
    {
        return $this->statut;
    }

    public function setStatut(StatutTransfert $statut): void
    {
        $this->statut = $statut;
    }

    public static function toEntity(object $obj): self
    {
        return new self(
            id: (int) ($obj->transfert_id ?? $obj->id),

            etablissementSortant:
                Etablissement::toEntity($obj),

            etablissementEntrant:
                Etablissement::toEntity($obj),

            inscription:
                Inscription::toEntity($obj),

            statut:
                StatutTransfert::toEntity($obj)
        );
    }
}