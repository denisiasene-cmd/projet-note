<?php
namespace App\Model\Entite;
class Role
{
    private int $id;
    private string $nomRole;

    public function __construct(
        int $id,
        string $nomRole
    ) {
        if (empty(trim($nomRole))) {
            throw new Exception("Le nom du rôle est obligatoire.");
        }

        $this->id = $id;
        $this->nomRole = $nomRole;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNomRole(): string
    {
        return $this->nomRole;
    }

    public function setNomRole(string $nomRole): void
    {
        if (empty(trim($nomRole))) {
            throw new Exception("Le nom du rôle est obligatoire.");
        }

        $this->nomRole = $nomRole;
    }

    public static function toEntity(object $obj): self
    {
        return new self(
            id: (int) ($obj->role_id ?? $obj->id),
            nomRole: $obj->role_nom ?? $obj->nomRole
        );
    }
}