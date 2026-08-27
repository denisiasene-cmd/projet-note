<?php
namespace App\Model\Entite;
use App\Model\Entite\Role;


class Utilisateur
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $telephone;
    private string $email;
    private Role $role;

    public function __construct(
        int $id,
        string $nom,
        string $prenom,
        string $telephone,
        string $email,
        Role $role
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

        if (empty(trim($email))) {
            throw new Exception("L'email est obligatoire.");
        }

        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->role = $role;
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): void
    {
        $this->role = $role;
    }

    public static function toEntity(object $obj): self
    {
        return new self(
            id: (int) ($obj->utilisateur_id ?? $obj->id),
            nom: $obj->utilisateur_nom ?? $obj->nom,
            prenom: $obj->utilisateur_prenom ?? $obj->prenom,
            telephone: $obj->telephone,
            email: $obj->email,
            role: Role::toEntity($obj)
        );
    }
}