<?php
namespace App\Model\Entite;
class StatutTransfert
{
    private int $id;
    private string $nom;

    public function __construct(
        int $id,
        string $nom
    ) {
        if (empty(trim($nom))) {
            throw new Exception(
                "Le statut de transfert ne doit pas être vide."
            );
        }

        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNom(string $nom): void
    {
        if (empty(trim($nom))) {
            throw new Exception(
                "Le statut de transfert ne doit pas être vide."
            );
        }

        $this->nom = $nom;
    }

    public static function toEntity(object $obj): self
    {
        return new self(
            id: (int) ($obj->statut_id ?? $obj->id),
            nom: $obj->statut
                ?? $obj->statut_nom
                ?? $obj->mode_statuts
                ?? $obj->nom
        );
    }
}
