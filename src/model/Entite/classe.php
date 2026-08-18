<?php
class classe{
    private int $id;
    private string $nomClasse ;

    public function __construct( 
        int $id,
        string $nomClasse
        )
      {
        if(empty(trim($nom))|| empty(trim($prenom))){
            throw new Exception("le nom et le prenom ne doivent pas etre null.");  
        }
        $this->id = $id;
        $this->nom = $nom;
        }
          public function getId(): int
    {
        return $this->id;
    }

    public function getNomClasse(): string
    {
        return $this->getNomClasse;
    }
    public function  setnomClasse(string $nomClasse):void{
        $this->getNomClasse = $nomClasse;
    }
}
