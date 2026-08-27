<?php
namespace App\Model\Entite;
class Etablissement
{
    private int $id;
    private string $nom_etablissement;

    public function __construct(
        int $id,
        string $nom_etablissement
    ) {
        if (empty(trim($nom_etablissement))) {
            throw new Exception(
                "Le nom de l'établissement est obligatoire."
            );
        }

        $this->id = $id;
        $this->nom_etablissement = $nom_etablissement;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNomEtablissement(): string
    {
        return $this->nom_etablissement;
    }

    public function setNomEtablissement(string $nom_etablissement): void
    {
        if (empty(trim($nom_etablissement))) {
            throw new Exception(
                "Le nom de l'établissement est obligatoire."
            );
        }

        $this->nom_etablissement = $nom_etablissement;
    }

    public static function toEntity(object $obj): self
    {
        return new self(
            id: (int) ($obj->etablissement_id ?? $obj->id),
            nom_etablissement: $obj->nom_etablissement
        );
    }
}