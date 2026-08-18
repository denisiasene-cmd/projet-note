
    <?php
    class utilisateurs{
        private int $id;
        private string $nom;
        private string $prenom;
        private string $telephone;
        private string $email;
        private string $password;
        public function __construct(
            int $id,
            string $nom,
            string $prenom,
            string $matricule,
            string $email,
            string $password,
        ){ 
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
        $this->email = $email;
        $this ->password = $password;
        }
        public function getId():int{
            return $this->id;
        }
        public function getnom():string{
            return $this->nom;
        }
        public function getprenom():string{
            return $this->prenom;
        }
        public function gettelephone():string{
                return $this->telephone;
        }
        public function getemeail():string{
            return $this->email;
        }
         public function setemeail(string $email):void{
             $this->email = $email;
        }
         public function getpassword():string{
            return $this->password;
        }
         public function setpassword(string $password):void{
             $this->password = $password;
        }

    }