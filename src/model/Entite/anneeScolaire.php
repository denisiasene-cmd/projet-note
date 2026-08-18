
    <?php
    class anneeScolaire{
        private int $id;
        private string $nom;
        private string $date;
        public function __construct(
            int $id,
            string $nom,
            string $date,
        ){ 
        $this->id = $id;
        $this->nom = $nom;
        $this->date = $date;
       
        }
        public function getId():int{
            return $this->id;
        }
        public function getnom():string{
            return $this->nom;
        }
         public function setnom():string{
             $this->nom;
        }
        public function getdate():string {
            return $this->date;
        }
        public function setDate(string $date):void{
            $this->date = $date;
        }
    
    }