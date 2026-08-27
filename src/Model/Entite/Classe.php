<?php
namespace App\Model\Entite;
class Classe
{
    private int $id;
    private string $nomClasse;

    public function __construct(
        int $id,
        string $nomClasse
    ) {
        if (empty(trim($nomClasse))) {
            throw new Exception("Le nom de la classe est obligatoire.");
        }

        $this->id = $id;
        $this->nomClasse = $nomClasse;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNomClasse(): string
    {
        return $this->nomClasse;
    }

    public function setNomClasse(string $nomClasse): void
    {
        if (empty(trim($nomClasse))) {
            throw new Exception("Le nom de la classe est obligatoire.");
        }

        $this->nomClasse = $nomClasse;
    }

   public static function toEntity(object $obj): self
{
    return new self(
        id: (int) ($obj->id ?? 0),
        nomClasse: $obj->nomclasse
    );
}
}