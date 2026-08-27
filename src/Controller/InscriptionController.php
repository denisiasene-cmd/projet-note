<?php

namespace App\Controller;

use App\Core\SessionManager;

use App\Model\Repository\InscriptionRepository;
use App\Model\Repository\UtilisateurRepository;
use App\Model\Repository\AnneeScolaireRepository;
use App\Model\Repository\ClasseRepository;
use App\Model\Repository\StatutRepository;

class InscriptionController
{
    public static function afficherVue()
    {

        $page = isset($_GET['page'])
            ? (int) $_GET['page']
            : 1;

        $limit = 2;

        if ($page < 1) {
            $page = 1;
        }

        $recherche = trim($_GET['recherche'] ?? '');

        $classe = $_GET['classe'] ?? '';

        $statut = $_GET['statut'] ?? '';

        $classes = ClasseRepository::getAllClasses();

        $status = StatutRepository::getAllStatut();

        $inscriptions = InscriptionRepository::getAllInscription(
            $page,
            $limit,
            $recherche,
            $classe,
            $statut
        );

        $resultat = InscriptionRepository::getTotalByEleves(
            $limit,
            $recherche,
            $classe,
            $statut
        );

        $nombrePages = 0;

        if (!empty($resultat)) {
            $nombrePages = (int) $resultat[0]->nombre_pages;
        }

        $nbr = count($inscriptions);

        $annee = AnneeScolaireRepository::getAnneeScolaireActive();

        SessionManager::saveData(
            'anneeScolaire',
            $annee
        );

        $idUtilisateur = 1;

        $utilisateur = UtilisateurRepository::getUtilisateurConnecte(
            $idUtilisateur
        );

        SessionManager::saveData(
            'utilisateur',
            $utilisateur
        );

        require_once dirname(__DIR__) . '/Views/afficherVue.php';
    }
}