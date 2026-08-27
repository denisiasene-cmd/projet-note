<?php

use App\Core\SessionManager;

$eleve = SessionManager::getData('inscription.eleve');
$tuteur = SessionManager::getData('inscription.tuteur');
$justificatifs = SessionManager::getData('inscription.justificatifs');

$step = isset($_GET['step']) ? (int) $_GET['step'] : 1;
if ($step < 1 || $step > 4) {
    $step = 1;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nouvelle inscription - Dossier Élève</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #1e6f5c;
            --primary-dark: #165a4a;
            --primary-light: #e8f4f1;
            --bg: #f8fafb;
            --white: #ffffff;
            --text: #1a202c;
            --text-muted: #718096;
            --border: #e2e8f0;
            --warning: #f59e0b;
            --warning-bg: #fef3c7;
            --success: #10b981;
            --danger: #dc2626;
            --danger-bg: #fee2e2;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg);
            color: var(--text);
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* ==============================
           HEADER
        ============================== */

        .header {
            background: linear-gradient(
                135deg,
                var(--primary) 0%,
                var(--primary-dark) 100%
            );

            color: white;
            padding: 24px 40px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            flex-shrink: 0;

            box-shadow: 0 4px 20px rgba(30, 111, 92, 0.3);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-icon {
            width: 48px;
            height: 48px;

            background: rgba(255, 255, 255, 0.15);

            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            backdrop-filter: blur(10px);
        }

        .header-icon svg {
            width: 24px;
            height: 24px;
            fill: white;
        }

        .header-breadcrumb {
            font-size: 11px;
            font-weight: 600;

            letter-spacing: 1px;

            opacity: 0.9;

            text-transform: uppercase;

            margin-bottom: 4px;
        }

        .header-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .header-subtitle {
            font-size: 12px;
            opacity: 0.85;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.15);

            border: 1px solid rgba(255, 255, 255, 0.3);

            color: white;

            padding: 10px 20px;

            border-radius: 10px;

            cursor: pointer;

            font-size: 13px;
            font-weight: 500;

            display: flex;
            align-items: center;

            gap: 8px;

            transition: all 0.3s ease;

            backdrop-filter: blur(10px);
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.25);
        }


        /* ==============================
           STEPPER
        ============================== */

        .stepper {
            background: var(--white);

            padding: 20px 40px;

            border-bottom: 1px solid var(--border);

            flex-shrink: 0;
        }

        .stepper-container {
            display: flex;

            justify-content: space-between;

            max-width: 900px;

            margin: 0 auto;

            position: relative;
        }

        .stepper-line {
            position: absolute;

            top: 16px;

            left: 12.5%;
            right: 12.5%;

            height: 2px;

            background: var(--border);

            z-index: 0;
        }

        .stepper-line-fill {
            position: absolute;

            top: 16px;

            left: 12.5%;

            height: 2px;

            width: 0%;

            background: var(--primary);

            z-index: 1;

            transition: width 0.5s ease;
        }

        .step {
            display: flex;

            flex-direction: column;

            align-items: center;

            gap: 8px;

            position: relative;

            z-index: 2;

            flex: 1;
        }

        .step-circle {
            width: 34px;
            height: 34px;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            font-weight: 700;

            font-size: 14px;

            background: var(--white);

            border: 3px solid var(--border);

            color: var(--text-muted);

            transition: all 0.3s ease;
        }

        .step.active .step-circle,
        .step.completed .step-circle {
            background: var(--primary);

            border-color: var(--primary);

            color: white;
        }

        .step.active .step-circle {
            box-shadow: 0 4px 12px rgba(30, 111, 92, 0.4);
        }

        .step-label {
            font-size: 11px;

            font-weight: 600;

            color: var(--text-muted);
        }

        .step.active .step-label,
        .step.completed .step-label {
            color: var(--primary);

            font-weight: 700;
        }


        /* ==============================
           MAIN
        ============================== */

        .main-content {
            flex: 1;

            overflow-y: auto;

            padding: 24px 40px;
        }

        .main-content::-webkit-scrollbar {
            width: 6px;
        }

        .main-content::-webkit-scrollbar-track {
            background: var(--bg);
        }

        .main-content::-webkit-scrollbar-thumb {
            background: var(--border);

            border-radius: 3px;
        }


        /* ==============================
           STEPS
        ============================== */

        .step-content {
            display: none;

            animation: fadeIn 0.4s ease;
        }

        .step-content.active {
            display: block;
        }

        @keyframes fadeIn {

            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        /* ==============================
           SECTION
        ============================== */

        .section {
            background: var(--white);

            border-radius: 12px;

            padding: 24px;

            margin-bottom: 16px;

            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);

            border: 1px solid var(--border);
        }

        .section-header {
            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 20px;

            padding-bottom: 14px;

            border-bottom: 2px solid var(--bg);
        }

        .section-number {
            width: 30px;
            height: 30px;

            background: var(--primary-light);

            border-radius: 8px;

            display: flex;

            align-items: center;
            justify-content: center;

            font-weight: 700;

            font-size: 13px;

            color: var(--primary);

            flex-shrink: 0;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
        }

        .section-subtitle {
            font-size: 12px;
            color: var(--text-muted);
        }


        /* ==============================
           FORM
        ============================== */

        .form-grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 18px;
        }

        .form-group {
            display: flex;

            flex-direction: column;

            gap: 6px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            font-size: 12px;

            font-weight: 600;

            color: var(--text);
        }

        .form-label .optional {
            font-weight: 400;

            color: var(--text-muted);

            font-size: 11px;
        }

        .form-input,
        .form-select {
            padding: 11px 14px;

            border: 2px solid var(--border);

            border-radius: 9px;

            font-size: 14px;

            font-family: inherit;

            background: var(--white);

            transition: all 0.3s ease;

            color: var(--text);
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;

            border-color: var(--primary);

            box-shadow: 0 0 0 3px rgba(30, 111, 92, 0.1);
        }

        .form-input.error,
        .form-select.error {
            border-color: var(--danger);

            background: var(--danger-bg);
        }

        .error-message {
            color: var(--danger);

            font-size: 11px;

            font-weight: 600;

            display: none;
        }

        .error-message.active {
            display: block;
        }


        /* ==============================
           UPLOAD
        ============================== */

        .upload-grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 16px;
        }

        .upload-card {
            background: var(--white);

            border: 2px solid var(--border);

            border-radius: 12px;

            padding: 18px;

            transition: all 0.3s ease;
        }

        .upload-card:hover {
            border-color: var(--primary);

            box-shadow: 0 4px 12px rgba(30, 111, 92, 0.1);
        }

        .upload-card-header {
            display: flex;

            justify-content: space-between;

            align-items: flex-start;

            margin-bottom: 12px;
        }

        .upload-card-icon {
            width: 36px;
            height: 36px;

            background: var(--primary-light);

            border-radius: 8px;

            display: flex;

            align-items: center;
            justify-content: center;
        }

        .upload-card-icon svg {
            width: 18px;
            height: 18px;

            stroke: var(--primary);
        }

        .upload-badge {
            padding: 4px 10px;

            border-radius: 6px;

            font-size: 10px;

            font-weight: 700;

            background: var(--warning-bg);

            color: var(--warning);

            display: flex;

            align-items: center;

            gap: 4px;
        }

        .upload-badge::before {
            content: '';

            width: 6px;
            height: 6px;

            background: var(--warning);

            border-radius: 50%;
        }

        .upload-card-title {
            font-size: 14px;

            font-weight: 700;

            margin-bottom: 2px;
        }

        .upload-card-desc {
            font-size: 11px;

            color: var(--text-muted);

            margin-bottom: 4px;
        }

        .upload-card-note {
            font-size: 11px;

            color: var(--warning);

            font-weight: 600;

            margin-bottom: 12px;
        }

        .upload-btn {
            width: 100%;

            padding: 10px;

            background: var(--bg);

            border: 2px dashed var(--border);

            border-radius: 8px;

            cursor: pointer;

            font-size: 13px;

            font-weight: 600;

            color: var(--text);

            transition: all 0.3s ease;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 8px;
        }

        .upload-btn:hover {
            border-color: var(--primary);

            background: var(--primary-light);

            color: var(--primary);
        }


        /* ==============================
           APERCU FICHIER
        ============================== */

        .file-preview {
            margin-top: 12px;

            display: none;
        }

        .file-preview.active {
            display: block;
        }

        .file-preview img {
            display: block;

            width: 100%;

            height: 220px;

            object-fit: cover;

            border-radius: 8px;

            border: 1px solid var(--border);

            background: var(--bg);
        }

        .file-preview iframe {
            width: 100%;

            height: 220px;

            border: 1px solid var(--border);

            border-radius: 8px;
        }

        .file-name {
            margin-top: 8px;

            font-size: 11px;

            color: var(--primary);

            font-weight: 600;

            word-break: break-word;
        }


        /* ==============================
           ALERT
        ============================== */

        .alert-box {
            background: var(--warning-bg);

            border: 1px solid #fde68a;

            border-radius: 10px;

            padding: 16px 20px;

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-top: 16px;
        }

        .alert-box-title {
            font-size: 13px;

            font-weight: 700;

            color: var(--warning);

            margin-bottom: 4px;
        }

        .alert-box-text {
            font-size: 12px;

            color: var(--text-muted);
        }

        .alert-box-btn {
            background: var(--white);

            border: 1px solid var(--border);

            padding: 8px 16px;

            border-radius: 8px;

            cursor: pointer;

            font-size: 12px;

            font-weight: 600;

            color: var(--text);

            display: flex;

            align-items: center;

            gap: 6px;
        }


        /* ==============================
           SUMMARY
        ============================== */

        .summary-card {
            background: var(--white);

            border: 1px solid var(--border);

            border-radius: 12px;

            padding: 20px;

            margin-bottom: 16px;
        }

        .summary-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            padding-bottom: 16px;

            border-bottom: 1px solid var(--border);

            margin-bottom: 16px;
        }

        .summary-avatar {
            width: 48px;
            height: 48px;

            background: var(--primary-light);

            border-radius: 10px;

            display: flex;

            align-items: center;
            justify-content: center;

            font-weight: 700;

            font-size: 16px;

            color: var(--primary);
        }

        .summary-name {
            font-size: 16px;

            font-weight: 700;

            margin-bottom: 2px;
        }

        .summary-school {
            font-size: 12px;

            color: var(--text-muted);
        }

        .summary-status {
            padding: 6px 14px;

            background: var(--warning-bg);

            color: var(--warning);

            border-radius: 20px;

            font-size: 11px;

            font-weight: 700;
        }

        .summary-grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 16px;
        }

        .summary-item {
            padding: 12px 0;
        }

        .summary-item-label {
            font-size: 10px;

            font-weight: 700;

            color: var(--text-muted);

            text-transform: uppercase;

            letter-spacing: 0.5px;

            margin-bottom: 4px;
        }

        .summary-item-value {
            font-size: 14px;

            font-weight: 600;

            color: var(--text);
        }

        .summary-info {
            background: var(--primary-light);

            border: 1px solid rgba(30, 111, 92, 0.2);

            border-radius: 10px;

            padding: 14px 18px;

            display: flex;

            align-items: center;

            gap: 12px;

            margin-top: 16px;
        }

        .summary-info-icon {
            width: 24px;
            height: 24px;

            background: var(--primary);

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;
        }

        .summary-info-icon svg {
            width: 14px;
            height: 14px;

            stroke: white;
        }

        .summary-info-text {
            font-size: 13px;

            color: var(--primary-dark);

            font-weight: 500;
        }


        /* ==============================
           FOOTER
        ============================== */

        .footer {
            background: var(--white);

            padding: 18px 40px;

            border-top: 1px solid var(--border);

            display: flex;

            justify-content: space-between;

            align-items: center;

            flex-shrink: 0;

            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.05);
        }

        .footer-right {
            display: flex;

            gap: 12px;
        }

        .btn {
            padding: 12px 24px;

            border-radius: 10px;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;

            transition: all 0.3s ease;

            border: none;

            font-family: inherit;

            display: flex;

            align-items: center;

            gap: 8px;
        }

        .btn-secondary {
            background: var(--white);

            color: var(--text);

            border: 2px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--bg);

            border-color: var(--text-muted);
        }

        .btn-primary {
            background: var(--primary);

            color: white;

            box-shadow: 0 4px 12px rgba(30, 111, 92, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-dark);

            transform: translateY(-2px);
        }


        /* ==============================
           RESPONSIVE
        ============================== */

        @media (max-width: 768px) {

            .header {
                padding: 16px 20px;
            }

            .stepper {
                padding: 16px 20px;
            }

            .main-content {
                padding: 16px 20px;
            }

            .form-grid,
            .upload-grid,
            .summary-grid {
                grid-template-columns: 1fr;
            }

            .footer {
                padding: 14px 20px;
            }

            .btn {
                padding: 10px 16px;
            }

        }

    </style>

</head>
<body>

<header class="header">

    <div class="header-left">

        <div class="header-icon">

            <svg viewBox="0 0 24 24">

                <path d="M12 3L1 9l11 6 9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/>

            </svg>

        </div>

        <div>

            <div class="header-breadcrumb">
                Scolarité · Dossier Élève
            </div>

            <h1 class="header-title">
                Nouvelle inscription
            </h1>

            <p class="header-subtitle">
                Complétez les informations obligatoires puis validez le dossier.
            </p>

        </div>

    </div>


    <button type="button" class="btn-back">

        <svg width="14"
             height="14"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2.5"
             stroke-linecap="round"
             stroke-linejoin="round">

            <path d="M19 12H5M12 19l-7-7 7-7"/>

        </svg>

        Retour aux élèves

    </button>

</header>

<div class="stepper">

    <div class="stepper-container">

        <div class="stepper-line"></div>

        <div
            class="stepper-line-fill"
            id="stepperFill">
        </div>


        <div class="step active" data-step="1">

            <div class="step-circle">
                1
            </div>

            <div class="step-label">
                Élève
            </div>

        </div>


        <div class="step" data-step="2">

            <div class="step-circle">
                2
            </div>

            <div class="step-label">
                Responsable
            </div>

        </div>


        <div class="step" data-step="3">

            <div class="step-circle">
                3
            </div>

            <div class="step-label">
                Justificatifs
            </div>

        </div>


        <div class="step" data-step="4">

            <div class="step-circle">
                4
            </div>

            <div class="step-label">
                Validation
            </div>

        </div>

    </div>

</div>

<main class="main-content">


<form
    method="POST"
    action="/saveEleves"
    enctype="multipart/form-data"
    id="inscriptionForm"
>


<input
    type="hidden"
    name="step"
    id="currentStep"
    value="1"
>

<div class="step-content active" id="step1">


    <!-- IDENTITÉ -->

    <div class="section">

        <div class="section-header">

            <div class="section-number">
                1
            </div>

            <div>

                <div class="section-title">
                    Identité de l'élève
                </div>

                <div class="section-subtitle">
                    Informations d'état civil
                </div>

            </div>

        </div>


        <div class="form-grid">


            <!-- PRENOM -->

            <div class="form-group">

                <label class="form-label">
                    Prénom *
                </label>

                <input
                    type="text"
                    class="form-input required-step1"
                    name="prenom"
                    id="prenom"
                    placeholder="Prénom de l'élève"
                >

                <span class="error-message">
                    Le prénom est obligatoire.
                </span>

            </div>


            <!-- NOM -->

            <div class="form-group">

                <label class="form-label">
                    Nom *
                </label>

                <input
                    type="text"
                    class="form-input required-step1"
                    name="nom"
                    id="nom"
                    placeholder="Nom de famille"
                >

                <span class="error-message">
                    Le nom est obligatoire.
                </span>

            </div>


            <!-- SEXE -->

            <div class="form-group">

                <label class="form-label">
                    Sexe *
                </label>

                <select
                    class="form-select required-step1"
                    name="sexe"
                    id="sexe"
                >

                    <option value="">
                        Sélectionner...
                    </option>

                    <?php foreach ($sexe_eleves as $sexe): ?>

                        <option value="<?= htmlspecialchars($sexe->sexe) ?>">
                            <?= htmlspecialchars($sexe->sexe) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

                <span class="error-message">
                    Le sexe est obligatoire.
                </span>

            </div>


            <!-- DATE -->

            <div class="form-group">

                <label class="form-label">
                    Date de naissance *
                </label>

                <input
                    type="date"
                    class="form-input required-step1"
                    name="date_naissance"
                    id="date_naissance"
                >

                <span class="error-message">
                    La date de naissance est obligatoire.
                </span>

            </div>


            <!-- LIEU -->

            <div class="form-group full-width">

                <label class="form-label">
                    Lieu de naissance *
                </label>

                <input
                    type="text"
                    class="form-input required-step1"
                    name="lieu_naissance"
                    id="lieu_naissance"
                    placeholder="Ville, Pays"
                >

                <span class="error-message">
                    Le lieu de naissance est obligatoire.
                </span>

            </div>

        </div>

    </div>



    <!-- AFFECTATION -->

    <div class="section">

        <div class="section-header">

            <div class="section-number">
                2
            </div>

            <div>

                <div class="section-title">
                    Affectation scolaire
                </div>

                <div class="section-subtitle">
                    Établissement, niveau et classe
                </div>

            </div>

        </div>


        <div class="form-grid">


            <!-- ETABLISSEMENT -->

            <div class="form-group">

                <label class="form-label">
                    Établissement *
                </label>

                <select
                    class="form-select required-step1"
                    name="etablissement"
                    id="etablissement"
                >

                    <option value="">
                        Sélectionner un établissement...
                    </option>

                    <?php foreach ($selectEtablissement as $etablis): ?>

                        <option
                            value="<?= htmlspecialchars($etablis->id_inscription) ?>"
                        >

                            <?= htmlspecialchars($etablis->nom_etablissement) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

                <span class="error-message">
                    L'établissement est obligatoire.
                </span>

            </div>


            <!-- NIVEAU -->

            <div class="form-group">

                <label class="form-label">
                    Niveau *
                </label>

                <select
                    class="form-select required-step1"
                    name="niveau"
                    id="niveau"
                >

                    <option value="">
                        Sélectionner un niveau...
                    </option>

                    <?php foreach ($mon_niveau as $niveau): ?>

                        <option
                            value="<?= htmlspecialchars($niveau->id) ?>"
                        >

                            <?= htmlspecialchars($niveau->nom_niveau) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

                <span class="error-message">
                    Le niveau est obligatoire.
                </span>

            </div>


            <!-- CLASSE -->

            <div class="form-group full-width">

                <label class="form-label">

                    Classe

                    <span class="optional">
                        (facultatif)
                    </span>

                </label>

                <select
                    class="form-select"
                    name="classe"
                    id="classe"
                >

                    <option value="">
                        Non affecté pour le moment
                    </option>

                    <?php foreach ($nom_affecter as $classe): ?>

                        <option
                            value="<?= htmlspecialchars($classe->id) ?>"
                        >

                            <?= htmlspecialchars($classe->nomclasse) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </div>

    </div>

</div>

<div class="step-content" id="step2">

    <div class="section">

        <div class="section-header">

            <div class="section-number">
                2
            </div>

            <div>

                <div class="section-title">
                    Responsable légal
                </div>

                <div class="section-subtitle">
                    Contact et prise en charge
                </div>

            </div>

        </div>


        <div class="form-grid">

            <!-- NOM -->

            <div class="form-group">

                <label class="form-label">
                    Nom *
                </label>

                <input
                    type="text"
                    class="form-input required-step2"
                    name="nom_tuteur"
                    id="nom_tuteur"
                    placeholder="Nom du responsable"
                >

                <span class="error-message">
                    Le nom du responsable est obligatoire.
                </span>

            </div>


            <!-- PRENOM -->

            <div class="form-group">

                <label class="form-label">
                    Prénom *
                </label>

                <input
                    type="text"
                    class="form-input required-step2"
                    name="prenom_tuteur"
                    id="prenom_tuteur"
                    placeholder="Prénom du responsable"
                >

                <span class="error-message">
                    Le prénom du responsable est obligatoire.
                </span>

            </div>


            <!-- TELEPHONE -->

            <div class="form-group">

                <label class="form-label">
                    Téléphone *
                </label>

                <input
                    type="tel"
                    class="form-input required-step2"
                    name="telephone"
                    id="telephone"
                    placeholder="+221 77 000 00 00"
                >

                <span class="error-message">
                    Le téléphone est obligatoire.
                </span>

            </div>


            <!-- EMAIL -->

            <div class="form-group">

                <label class="form-label">

                    Email

                    <span class="optional">
                        (facultatif)
                    </span>

                </label>

                <input
                    type="email"
                    class="form-input"
                    name="email"
                    placeholder="email@exemple.com"
                >

            </div>


            <!-- ADRESSE -->

            <div class="form-group">

                <label class="form-label">

                    Adresse

                    <span class="optional">
                        (facultatif)
                    </span>

                </label>

                <input
                    type="text"
                    class="form-input"
                    name="adress"
                    placeholder="Adresse complète"
                >

            </div>


            <!-- BOURSE -->

            <div class="form-group">

                <label class="form-label">
                    Bourse *
                </label>

                <select
                    class="form-select required-step2"
                    name="bourse"
                    id="bourse"
                >

                    <option value="aucune">
                        Aucune
                    </option>

                    <option value="partielle">
                        Bourse partielle
                    </option>

                    <option value="totale">
                        Bourse totale
                    </option>

                </select>

            </div>

        </div>

    </div>

</div>

<div class="step-content" id="step3">

    <div class="section">

        <div class="section-header">

            <div class="section-number">
                3
            </div>

            <div>

                <div class="section-title">
                    Pièces justificatives
                </div>

                <div class="section-subtitle">
                    Ajoutez les documents disponibles au dossier
                </div>

            </div>

        </div>

        <div class="upload-grid">

            <!-- EXTRAIT -->

            <div class="upload-card">

                <div class="upload-card-header">

                    <div class="upload-card-icon">

                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round">

                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>

                            <polyline points="14 2 14 8 20 8"/>

                        </svg>

                    </div>

                    <div class="upload-badge">
                        Manquant
                    </div>

                </div>

                <div class="upload-card-title">
                    Extrait de naissance
                </div>

                <div class="upload-card-desc">
                    Copie lisible du document
                </div>

                <div class="upload-card-note">
                    À fournir plus tard
                </div>

                <input
                    type="file"
                    id="extrait_naissance"
                    name="extrait_naissance"
                    accept=".pdf,.jpg,.jpeg,.png"
                    hidden
                >

                <button
                    type="button"
                    class="upload-btn"
                    onclick="document.getElementById('extrait_naissance').click()"
                >

                    Choisir un fichier

                </button>

                <div
                    class="file-preview"
                    id="preview_extrait_naissance"
                ></div>

            </div>



            <!-- CERTIFICAT -->

            <div class="upload-card">

                <div class="upload-card-header">

                    <div class="upload-card-icon">

                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round">

                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>

                            <polyline points="14 2 14 8 20 8"/>

                        </svg>

                    </div>

                    <div class="upload-badge">
                        Manquant
                    </div>

                </div>

                <div class="upload-card-title">
                    Certificat médical
                </div>

                <div class="upload-card-desc">
                    Aptitude à la vie scolaire
                </div>

                <div class="upload-card-note">
                    À fournir plus tard
                </div>

                <input
                    type="file"
                    id="certificat_medical"
                    name="certificat_medical"
                    accept=".pdf,.jpg,.jpeg,.png"
                    hidden
                >

                <button
                    type="button"
                    class="upload-btn"
                    onclick="document.getElementById('certificat_medical').click()"
                >

                    Choisir un fichier

                </button>

                <div
                    class="file-preview"
                    id="preview_certificat_medical"
                ></div>

            </div>



            <!-- BULLETINS -->

            <div class="upload-card">

                <div class="upload-card-header">

                    <div class="upload-card-icon">

                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round">

                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>

                            <polyline points="14 2 14 8 20 8"/>

                        </svg>

                    </div>

                    <div class="upload-badge">
                        Manquant
                    </div>

                </div>

                <div class="upload-card-title">
                    Anciens bulletins
                </div>

                <div class="upload-card-desc">
                    Dernière année fréquentée
                </div>

                <div class="upload-card-note">
                    À fournir plus tard
                </div>

                <input
                    type="file"
                    id="anciens_bulletins"
                    name="anciens_bulletins"
                    accept=".pdf,.jpg,.jpeg,.png"
                    hidden
                >

                <button
                    type="button"
                    class="upload-btn"
                    onclick="document.getElementById('anciens_bulletins').click()"
                >

                    Choisir un fichier

                </button>

                <div
                    class="file-preview"
                    id="preview_anciens_bulletins"
                ></div>

            </div>



            <!-- PHOTOS -->

            <div class="upload-card">

                <div class="upload-card-header">

                    <div class="upload-card-icon">

                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round">

                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>

                            <polyline points="14 2 14 8 20 8"/>

                        </svg>

                    </div>

                    <div class="upload-badge">
                        Manquant
                    </div>

                </div>

                <div class="upload-card-title">
                    Photos d'identité
                </div>

                <div class="upload-card-desc">
                    Deux photos récentes ou un document regroupé
                </div>

                <div class="upload-card-note">
                    À fournir plus tard
                </div>

                <input
                    type="file"
                    id="photos_identite"
                    name="photos_identite"
                    accept=".jpg,.jpeg,.png"
                    hidden
                >

                <button
                    type="button"
                    class="upload-btn"
                    onclick="document.getElementById('photos_identite').click()"
                >

                    Choisir une photo

                </button>

                <div
                    class="file-preview"
                    id="preview_photos_identite"
                ></div>

            </div>

        </div>


        <div class="alert-box">

            <div>

                <div class="alert-box-title">
                    Vous n'avez pas encore toutes les pièces ?
                </div>

                <div class="alert-box-text">
                    Ce n'est pas bloquant. Les documents manquants
                    resteront indiqués « À fournir ».
                </div>

            </div>

        </div>

        <div style="
            margin-top:12px;
            font-size:11px;
            color:var(--text-muted);
        ">

            Formats acceptés : PDF, JPG ou PNG · 5 Mo maximum par fichier.

        </div>

    </div>

</div>

<div class="step-content" id="step4">

    <div class="section">

        <div class="section-header">

            <div class="section-number">
                4
            </div>

            <div>

                <div class="section-title">
                    Vérification du dossier
                </div>

                <div class="section-subtitle">
                    Contrôlez les informations avant l'envoi
                </div>

            </div>

        </div>


        <div class="summary-card">
            <div class="summary-header">

                <div style="
                    display:flex;
                    align-items:center;
                    gap:14px;
                ">

                    <!-- AVATAR -->

                    <div class="summary-avatar">

                        <?= strtoupper(
                            substr($eleve['prenom'] ?? 'X', 0, 1) .
                            substr($eleve['nom'] ?? 'X', 0, 1)
                        ) ?>

                    </div>


                    <!-- IDENTITÉ -->

                    <div>

                        <div class="summary-name">

                            <?= htmlspecialchars(
                                $eleve['prenom'] ?? ''
                            ) ?>

                            <?= htmlspecialchars(
                                $eleve['nom'] ?? ''
                            ) ?>

                        </div>


                        <div class="summary-school">

                            Établissement :

                            <?= htmlspecialchars(
                                $eleve['etablissement'] ?? ''
                            ) ?>

                            · Niveau :

                            <?= htmlspecialchars(
                                $eleve['niveau'] ?? ''
                            ) ?>

                        </div>

                    </div>

                </div>


                <!-- STATUT -->

                <div class="summary-status">

                    Préinscription

                </div>

            </div>

            <div class="summary-grid">

                <div class="summary-item">

                    <div class="summary-item-label">
                        Naissance
                    </div>

                    <div class="summary-item-value">

                        <?= htmlspecialchars(
                            $eleve['date_naissance'] ?? ''
                        ) ?>

                        ·

                        <?= htmlspecialchars(
                            $eleve['lieu_naissance'] ?? ''
                        ) ?>

                    </div>

                </div>
                <div class="summary-item">

                    <div class="summary-item-label">
                        Responsable
                    </div>

                    <div class="summary-item-value">

                        <?= htmlspecialchars(
                            $tuteur['prenom'] ?? ''
                        ) ?>

                        <?= htmlspecialchars(
                            $tuteur['nom'] ?? ''
                        ) ?>

                        ·

                        <?= htmlspecialchars(
                            $tuteur['telephone'] ?? ''
                        ) ?>

                    </div>

                </div>


                <!-- CLASSE -->

                <div class="summary-item">

                    <div class="summary-item-label">
                        Classe
                    </div>

                    <div class="summary-item-value">

                        <?= htmlspecialchars(
                            $eleve['classe'] ?? 'Non affecté'
                        ) ?>

                    </div>

                </div>


                <!-- PIÈCES FOURNIES -->

                <div class="summary-item">

                    <div class="summary-item-label">
                        Pièces fournies
                    </div>

                    <div class="summary-item-value">

                        <?php

                        $nombrePieces = 0;

                        if (!empty($justificatifs)) {

                            foreach ($justificatifs as $piece) {

                                if (!empty($piece)) {

                                    $nombrePieces++;

                                }

                            }

                        }

                        ?>

                        <?= $nombrePieces ?>
                        pièce(s) fournie(s)

                    </div>

                </div>

            </div>

            <div class="summary-info">

                <div class="summary-info-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <polyline points="20 6 9 17 4 12"/>

                    </svg>

                </div>


                <div class="summary-info-text">

                    Le dossier sera créé « En étude ».
                    Il devra être accepté avant
                    l'encaissement des frais d'inscription.

                </div>

            </div>

        </div>

    </div>

</div>

<footer class="footer">


    <button
        type="button"
        class="btn btn-secondary"
        id="btnPrev"
        style="visibility:hidden;"
    >

        <svg
            width="16"
            height="16"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2.5"
            stroke-linecap="round"
            stroke-linejoin="round"
        >

            <path d="M19 12H5M12 19l-7-7 7-7"/>

        </svg>

        Précédent

    </button>


    <div class="footer-right">


        <button
            type="button"
            class="btn btn-secondary"
            id="btnCancel"
        >

            Annuler

        </button>


        <button
            type="button"
            class="btn btn-primary"
            id="btnNext"
        >

            <span id="btnNextText">
                Continuer
            </span>

            <svg
                id="btnNextIcon"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2.5"
                stroke-linecap="round"
                stroke-linejoin="round"
            >

                <path d="M5 12h14M12 5l7 7-7 7"/>

            </svg>

        </button>

    </div>

</footer>


</form>

</main>
<script>

let currentStep = 1;

const totalSteps = 4;

const form = document.getElementById('inscriptionForm');

const btnNext = document.getElementById('btnNext');

const btnPrev = document.getElementById('btnPrev');

const btnNextText = document.getElementById('btnNextText');

const btnNextIcon = document.getElementById('btnNextIcon');

const currentStepInput =
    document.getElementById('currentStep');

const stepperFill =
    document.getElementById('stepperFill');



/* =====================================================
   AFFICHER UNE ÉTAPE
===================================================== */

function afficherStep(step) {

    currentStep = step;

    currentStepInput.value = step;


    document
        .querySelectorAll('.step-content')
        .forEach(function(element) {

            element.classList.remove('active');

        });


    const currentContent =
        document.getElementById('step' + step);


    if (currentContent) {

        currentContent.classList.add('active');

    }


    document
        .querySelectorAll('.step')
        .forEach(function(element) {

            const stepNumber =
                parseInt(element.dataset.step);


            element.classList.remove('active');

            element.classList.remove('completed');


            if (stepNumber === step) {

                element.classList.add('active');

            }

            else if (stepNumber < step) {

                element.classList.add('completed');

            }

        });


    const progress =
        ((step - 1) / (totalSteps - 1)) * 75;


    stepperFill.style.width =
        progress + '%';


    /* Bouton précédent */

    if (step === 1) {

        btnPrev.style.visibility =
            'hidden';

    }

    else {

        btnPrev.style.visibility =
            'visible';

    }


    /* Bouton suivant / validation */

    if (step === totalSteps) {

        btnNextText.textContent =
            'Valider le dossier';


        btnNextIcon.innerHTML =
            '<polyline points="20 6 9 17 4 12"/>';

    }

    else {

        btnNextText.textContent =
            'Continuer';


        btnNextIcon.innerHTML =
            '<path d="M5 12h14M12 5l7 7-7 7"/>';

    }

}



/* =====================================================
   VALIDATION STEP 1
===================================================== */

function validerStep1() {

    const champs =
        document.querySelectorAll('.required-step1');

    let valide = true;


    champs.forEach(function(champ) {

        const message =
            champ.parentElement
                .querySelector('.error-message');


        if (champ.value.trim() === '') {

            champ.classList.add('error');


            if (message) {

                message.classList.add('active');

            }


            valide = false;

        }

        else {

            champ.classList.remove('error');


            if (message) {

                message.classList.remove('active');

            }

        }

    });


    if (!valide) {

        alert(
            'Veuillez remplir tous les champs obligatoires de l’étape 1.'
        );

    }


    return valide;

}



/* =====================================================
   VALIDATION STEP 2
===================================================== */

function validerStep2() {

    const champs =
        document.querySelectorAll('.required-step2');

    let valide = true;


    champs.forEach(function(champ) {

        const message =
            champ.parentElement
                .querySelector('.error-message');


        if (champ.value.trim() === '') {

            champ.classList.add('error');


            if (message) {

                message.classList.add('active');

            }


            valide = false;

        }

        else {

            champ.classList.remove('error');


            if (message) {

                message.classList.remove('active');

            }

        }

    });


    if (!valide) {

        alert(
            'Veuillez remplir tous les champs obligatoires de l’étape 2.'
        );

    }


    return valide;

}



/* =====================================================
   BOUTON SUIVANT
===================================================== */

btnNext.addEventListener(
    'click',
    function() {


        /* =============================================
           STEP 1
        ============================================= */

        if (currentStep === 1) {

            if (!validerStep1()) {

                return;

            }


            form.action =
                '/saveEleves';


            form.submit();


            return;

        }



        /* =============================================
           STEP 2
        ============================================= */

        if (currentStep === 2) {

            if (!validerStep2()) {

                return;

            }


            form.action =
                '/saveTuteur';


            form.submit();


            return;

        }



        /* =============================================
           STEP 3
        ============================================= */

        if (currentStep === 3) {

            form.action =
                '/saveJustification';


            form.submit();


            return;

        }



        /* =============================================
           STEP 4
        ============================================= */

        if (currentStep === 4) {

            form.action =
                '/validerInscription';


            form.submit();


            return;

        }

    }
);



/* =====================================================
   BOUTON PRÉCÉDENT
===================================================== */

btnPrev.addEventListener(
    'click',
    function() {

        if (currentStep > 1) {

            afficherStep(
                currentStep - 1
            );

        }

    }
);



/* =====================================================
   SUPPRIMER LES ERREURS PENDANT LA SAISIE
===================================================== */

document
    .querySelectorAll(
        '.required-step1, .required-step2'
    )
    .forEach(function(champ) {


        champ.addEventListener(
            'input',
            function() {

                if (champ.value.trim() !== '') {

                    champ.classList.remove('error');


                    const message =
                        champ.parentElement
                            .querySelector('.error-message');


                    if (message) {

                        message.classList.remove('active');

                    }

                }

            }
        );


        champ.addEventListener(
            'change',
            function() {

                if (champ.value.trim() !== '') {

                    champ.classList.remove('error');


                    const message =
                        champ.parentElement
                            .querySelector('.error-message');


                    if (message) {

                        message.classList.remove('active');

                    }

                }

            }
        );

    });



/* =====================================================
   AFFICHAGE DES FICHIERS
===================================================== */

function afficherFichier(
    inputId,
    previewId
) {

    const input =
        document.getElementById(inputId);


    const preview =
        document.getElementById(previewId);


    if (!input || !preview) {

        return;

    }


    input.addEventListener(
        'change',
        function() {


            preview.innerHTML = '';


            if (input.files.length === 0) {

                preview.classList.remove(
                    'active'
                );

                return;

            }


            const fichier =
                input.files[0];


            preview.classList.add(
                'active'
            );



            /* =========================================
               IMAGE
            ========================================= */

            if (
                fichier.type.startsWith(
                    'image/'
                )
            ) {

                const image =
                    document.createElement(
                        'img'
                    );


                image.src =
                    URL.createObjectURL(
                        fichier
                    );


                image.alt =
                    fichier.name;


                preview.appendChild(
                    image
                );


                image.style.width =
                    '100%';


                image.style.height =
                    '220px';


                image.style.objectFit =
                    'cover';


                image.style.objectPosition =
                    'center';

            }



            /* =========================================
               PDF
            ========================================= */

            else if (
                fichier.type ===
                'application/pdf'
            ) {

                const pdf =
                    document.createElement(
                        'iframe'
                    );


                pdf.src =
                    URL.createObjectURL(
                        fichier
                    );


                preview.appendChild(
                    pdf
                );

            }



            /* =========================================
               NOM DU FICHIER
            ========================================= */

            const nom =
                document.createElement(
                    'div'
                );


            nom.className =
                'file-name';


            nom.textContent =
                fichier.name;


            preview.appendChild(
                nom
            );

        }
    );

}



/* =====================================================
   INITIALISATION DES FICHIERS
===================================================== */

afficherFichier(
    'extrait_naissance',
    'preview_extrait_naissance'
);


afficherFichier(
    'certificat_medical',
    'preview_certificat_medical'
);


afficherFichier(
    'anciens_bulletins',
    'preview_anciens_bulletins'
);


afficherFichier(
    'photos_identite',
    'preview_photos_identite'
);



/* =====================================================
   BOUTON ANNULER
===================================================== */

document
    .getElementById('btnCancel')
    .addEventListener(
        'click',
        function() {

            window.history.back();

        }
    );



/* =====================================================
   INITIALISATION DE L'ÉTAPE
===================================================== */

afficherStep(
    <?= $step ?>
);

</script>
</body>

</html>