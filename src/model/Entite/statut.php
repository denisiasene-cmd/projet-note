
    <?php
    class statut{
        private int $id;
        private string $mode_statuts;
       
        public function __construct(
            int $id,
            string $mode_statuts,
        ){ 
        $this->id = $id;
        $this->mode_statuts = $mode_statuts;
    
        }
        public function getId(){
             return $this->$id;
        }
        public function getmode_statuts(){
             return $this->$mode_statuts;
        }
        public function setmode_statuts(){
            if(empty(trim($mode_statuts))){
                throw new Exception("le mode de statut ne doit pas etre vide .");
                
            }
             return $this->mode_statuts = $mode_statuts;
        }
      
       

    }