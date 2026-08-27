<?php
namespace App\Model\Entite;
enum StatutInscription: string
{
    case EN_ATTENTE = "EN ATTENTE";
    case INSCRIT = "INSCRIT";
    case NON_AFFECTE = "NON AFFECTE";
}

