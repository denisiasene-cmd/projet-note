
<?php
class eleve {
    private int $id;
    private string $nom;
    private string $prenom;
     private string $matricle;
    private string $date_naissance;
     public function __construct( 
        int $id,
        string $nom,
        string $prenom,
        string $matricle,
        )
      {
         if(empty(trim($nom))|| empty(trim($prenom))){
            throw new Exception("le nom et le prenom ne doivent pas etre null.");  
        }
        if (empty(trim($matricule))){
          throw new Exception("le matricule est obligatoire .");
          
        }
        $this->id = $id;
        $this->nom = $nom;
        $this->nom = $prenom;
        $this->nom = $matricule;
        $this->nom = $date_naissance;

        }
      public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }
    public function  setnom():void {
      $this->$nom = $nom;
    }
    public function getPrenom(){
      return $this->$prenom;
    }
      public function getMatricule(){
      return $this->$matricule;
    }
    public function getDateNaissance(){
      return $this->$date_naissance;
    }
}