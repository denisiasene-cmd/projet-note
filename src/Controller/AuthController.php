<?php
namespace App\Controller;

use App\Core\SessionManager;
use App\Core\Validator;

use App\Model\Repository\ConnexionRepository;
use App\Model\Repository\EtablissementRepository;
use App\Model\Repository\NiveauRepository;
use App\Model\Repository\ClasseRepository;
use App\Model\Repository\ElevesRepository;
use App\Model\Repository\JustificatifRepository;

use App\Model\Dto\DtoInscription;
use App\Model\Dto\DtoTuteur;

class AuthController
{
    public static function connexion()
    {
        $step = isset($_GET['step'])
            ? (int) $_GET['step']
            : 1;

        if ($step < 1 || $step > 4) {
            $step = 1;
        }
        $connecter = ConnexionRepository::getConnexion();


        $selectEtablissement = EtablissementRepository::getAllEtablissement();


        $mon_niveau = NiveauRepository::getAllNiveau();


        $nom_affecter = ClasseRepository::getClasseNonAffecter();


        $sexe_eleves = ElevesRepository::getSexeByEleve();

        $eleve =SessionManager::getData(
                'inscription.eleve'
            );
        $tuteur = SessionManager::getData(
                'inscription.tuteur'
            );
        $justificatifs =SessionManager::getData(
                'inscription.justificatifs'
            );
        require_once dirname(__DIR__) .
            '/Views/connexion.php';
    }
    public static function saveEleves()
    {
        $nom = $_POST['nom'] ?? '';

        $prenom = $_POST['prenom'] ?? '';

        $sexe = $_POST['sexe'] ?? '';

        $lieu_naissance = $_POST['lieu_naissance'] ?? '';

        $date_naissance = $_POST['date_naissance'] ?? '';

        $etablissement =
            !empty($_POST['etablissement'])
                ? (int) $_POST['etablissement']
                : null;
        $niveau =
            !empty($_POST['niveau'])
                ? (int) $_POST['niveau']
                : null;

        $classe =
            !empty($_POST['classe'])
                ? (int) $_POST['classe']
                : null;
        $errors = [];
        Validator::required(
            $nom,
            'nom',
            $errors
        );
        Validator::required(
            $prenom,
            'prenom',
            $errors
        );
        Validator::required(
            $sexe,
            'sexe',
            $errors
        );
        Validator::required(
            $lieu_naissance,
            'lieu_naissance',
            $errors
        );
        Validator::required(
            $date_naissance,
            'date_naissance',
            $errors
        );

        if (!empty($errors)) {

            $_SESSION['inscription.errors'] =
                $errors;

            header(
                'Location: /connexion?step=1'
            );
            exit;
        }
        $dto =
            new DtoInscription(
                $prenom,
                $nom,
                $sexe,
                $lieu_naissance,
                $date_naissance,
                $etablissement,
                $niveau,
                $classe
            );

        SessionManager::saveData(
            'inscription.eleve',
            [
                'prenom' => $dto->getPrenom(),

                'nom' => $dto->getNom(),

                'sexe' => $dto->getSexe(),

                'lieu_naissance' => $dto->getLieuNaissance(),

                'date_naissance' => $dto->getDateNaissance(),

                'etablissement' => $dto->getEtablissement(),

                'niveau' => $dto->getNiveau(),

                'classe' => $dto->getClasse()
            ]
        );
        header(
            'Location: /connexion?step=2'
        );
        exit;
    }
    public static function saveTuteur()
    {
        $nom = $_POST['nom_tuteur'] ?? '';

        $prenom = $_POST['prenom_tuteur'] ?? '';

        $telephone = $_POST['telephone'] ?? '';

        $bourse = $_POST['bourse'] ?? '';

        $adress = $_POST['adress'] ?? '';
        $errors = [];
        Validator::required(
            $nom,
            'nom_tuteur',
            $errors
        );
        Validator::required(
            $prenom,
            'prenom_tuteur',
            $errors
        );
        Validator::required(
            $telephone,
            'telephone',
            $errors
        );
        Validator::required(
            $bourse,
            'bourse',
            $errors
        );
        Validator::required(
            $adress,
            'adress',
            $errors
        );

        if (!empty($errors)) {

            $_SESSION['inscription.errors'] =
                $errors;

            header(
                'Location: /connexion?step=2'
            );

            exit;
        }
        $dto = new DtoTuteur(
                $nom,
                $prenom,
                $telephone,
                $bourse,
                $adress
            );
        SessionManager::saveData(
            'inscription.tuteur',
            [
                'nom' => $dto->getNom(),

                'prenom' => $dto->getPrenom(),

                'telephone' =>$dto->getTelephone(),

                'bourse' => $dto->getBourse(),

                'adress' => $dto->getAdress()
            ]
        );
        header(
            'Location: /connexion?step=3'
        );
        exit;
    }
    public static function saveJustification()
    {
        $justificatifs = [];
        $fichiers = [
            'extrait_naissance',
            'certificat_medical',
            'anciens_bulletins',
            'photos_identite'
        ];

        $dossierUploads =
            dirname(__DIR__, 2) .
            '/uploads/';
        if (!is_dir($dossierUploads)) {

            mkdir(
                $dossierUploads,
                0777,
                true
            );
        }
        foreach ($fichiers as $fichier) {

            if (
                !isset($_FILES[$fichier]) ||
                $_FILES[$fichier]['error']
                === UPLOAD_ERR_NO_FILE
            ) {

                $justificatifs[$fichier] =
                    null;

                continue;
            }

            if (
                $_FILES[$fichier]['error']
                !== UPLOAD_ERR_OK
            ) {

                $justificatifs[$fichier] =
                    null;

                continue;
            }
            $nomFichier =
                basename(
                    $_FILES[$fichier]['name']
                );
            $destination =
                $dossierUploads .
                $nomFichier;

            if (
                move_uploaded_file(
                    $_FILES[$fichier]['tmp_name'],
                    $destination
                )
            ) {

                $justificatifs[$fichier] =
                    'uploads/' .
                    $nomFichier;

            } else {

                $justificatifs[$fichier] =
                    null;
            }
        }
        SessionManager::saveData(
            'inscription.justificatifs',
            $justificatifs
        );

        header(
            'Location: /connexion?step=4'
        );
        exit;
    }
    public static function validerInscription()
    {
        $eleve =SessionManager::getData(
                'inscription.eleve'
            );
        $tuteur = SessionManager::getData(
                'inscription.tuteur'
            );
        $justificatifs = SessionManager::getData(
                'inscription.justificatifs'
            );
        if (empty($eleve)) {

            header(
                'Location: /connexion?step=1'
            );
            exit;
        }
        if (empty($tuteur)) {

            header(
                'Location: /connexion?step=2'
            );
            exit;
        }
        if ($justificatifs === null) {
            $justificatifs = [];
        }
        SessionManager::saveData(
            'inscription.validee',
            true
        );
        SessionManager::saveData(
            'inscription.date_validation',
            date('Y-m-d H:i:s')
        );
        header(
            'Location: /connexion?step=4&success=1'
        );
        exit;
    }
}