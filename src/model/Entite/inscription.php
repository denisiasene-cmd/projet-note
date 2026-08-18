
    <?php
    class inscription{
        private int $id;
        private anneeScolaire $annee_id;
        private eleve $eleve;
        private classe $classe;
        public function __construct(
            int $id,
            anneeScolaire $anneeScolaire,
            eleve $eleve,
            classe $classe, 
        ){ 
        $this->id = $id;
        $this->anneeScolaire= $anneeScolaire;
        $this->eleve = $eleve;
        $this->classe = $classe;
       
        }
        public function getId(){
            return $this->id;
        }
        public function getanneeScolaire():anneeScolaire{
            return $this->anneeScolaire;
        }
        public function geteleve():eleve{
            return $this->eleve;
        }
        public function getclasse():classe{
            return $this->classe;
        }
       

    }