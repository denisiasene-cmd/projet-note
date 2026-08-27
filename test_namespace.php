<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Model\Repository\AnneeScolaireRepository;
use App\Model\Repository\ClasseRepository;
use App\Model\Repository\ConnexionRepository;
use App\Model\Repository\ElevesRepository;
use App\Model\Repository\EtablissementRepository;
use App\Model\Repository\InscriptionRepository;
use App\Model\Repository\JustificatifRepository;
use App\Model\Repository\NiveauRepository;
use App\Model\Repository\UtilisateurRepository;
use App\Model\Repository\TuteurRepository;


echo "=== TEST REPOSITORIES ===" . PHP_EOL;

var_dump(AnneeScolaireRepository::class);
var_dump(ClasseRepository::class);
var_dump(ConnexionRepository::class);
var_dump(ElevesRepository::class);
var_dump(EtablissementRepository::class);
var_dump(InscriptionRepository::class);
var_dump(JustificatifRepository::class);
var_dump(NiveauRepository::class);
var_dump(UtilisateurRepository::class);
var_dump(TuteurRepository::class);

echo "=== FIN TEST ===" . PHP_EOL;