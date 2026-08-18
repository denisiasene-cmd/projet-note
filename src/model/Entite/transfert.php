<?php

class transfert {
    private int $id;
    private string $type_transfert;
    private inscriptions $inscriptions; 

    public function __construct(
        int $id,
        string $type_transfert,
        inscriptions $inscriptions
    ) {
        $this->id = $id;
        $this->type_transfert = $type_transfert;
        $this->inscriptions = $inscriptions;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getTypeTransfert(): string {
        return $this->type_transfert;
    }

    public function setTypeTransfert(string $type_transfert): void {
        if ($type_transfert === "entrant") { 
           echo "transfert entrant"; 
        } else {
            echo "transfert sortant";
        }
        $this->type_transfert = $type_transfert; 
    }

    public function getInscription(): inscriptions {
        return $this->inscriptions; 
    }

    public function setInscription(inscriptions $inscriptions): void { 
         $this->inscriptions = $inscriptions;
    }
}
