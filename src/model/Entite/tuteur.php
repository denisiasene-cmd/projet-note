
    <?php
    class tuteur{
        private int $id;
        private string $nom;
        private string $prenom;
        private string $telephone;
        private string $email;
        private string $adresse;
        public function __construct(
            int $id,
            string $nom,
            string $prenom,
            string $matricule,
            string $email,
            string $adresse,
        ){ 
                if(empty(trim($nom))|| empty(trim($prenom))){
            throw new Exception("le nom et le prenom ne doivent pas etre null.");  
        }
        if (empty(trim($matricule))){
          throw new Exception("le matricule est obligatoire .");
          
        }
        if (empty(trim($telephone))){
          throw new Exception("le telephone est obligatoire .");
          
        }
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->adresse = $adresse;
        }
        public function getId():int{
            return $this->$id;
        }
        public function getnom():string{
            return $this->$nom;
        }
        public function setnom( string $nom):void{
            $this->nom = $nom;
        }
        public function getprenom():string{
            return $this->$prenom;
        }
        public function gettelephone():string{
            return $this->$email;
        }
        public function getadresse():string{
            return $this->adresse;
        }


    }

