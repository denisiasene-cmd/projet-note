
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Élèves & inscriptions</title>

<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:Arial;background:#f7f9f8;color:#18352e;font-size:12px}
button,input,select{font-family:inherit}

.header{height:60px;background:#fff;border-bottom:1px solid #e5ebe8;
display:flex;justify-content:space-between;align-items:center;padding:0 32px}
.logo{font-size:12px;font-weight:bold;letter-spacing:1.5px;color:#82918c}
.header-right,.profil,.annee{display:flex;align-items:center;gap:12px}
.annee{border:1px solid #e1e8e5;border-radius:20px;padding:9px 14px}
.point{width:7px;height:7px;background:#087455;border-radius:50%}
.notif,.avatar{width:36px;height:36px;border:1px solid #e1e8e5;border-radius:10px;background:white}
.avatar{background:#e8f0ed;color:#176c54;display:flex;align-items:center;justify-content:center;font-weight:bold}
.profil-info strong,.profil-info span{display:block}
.profil-info strong{font-size:11px}.profil-info span{font-size:9px;color:#9aa7a3}

.container{padding:38px 43px}
.entete{display:flex;justify-content:space-between;align-items:end;margin-bottom:34px}
.surtitre{font-size:10px;font-weight:bold;letter-spacing:1.3px;color:#087455;margin-bottom:8px}
h1{font-size:30px;margin-bottom:10px;color:#102f28}
.description{color:#71807b}
.btn{background:#076b50;color:white;border:0;border-radius:10px;padding:13px 18px;font-weight:bold;cursor:pointer}

.actions{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:16px}
.action{height:64px;background:white;border:1px solid #e3e9e7;border-radius:12px;
display:flex;align-items:center;padding:10px;cursor:pointer}
.icon{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;margin-right:10px}
.vert{background:#edf8f3;color:#087455}.violet{background:#f2edfb;color:#8260bd}
.bleu{background:#edf5fc;color:#4284be}.jaune{background:#fff8e9;color:#bc8a27}
.action div:nth-child(2){flex:1}.action b{display:block;margin-bottom:5px}.action small{color:#a0aaa6}
.arrow{color:#9ca9a5;font-size:17px}

.filtres{background:white;border:1px solid #e3e9e7;border-radius:12px;padding:11px;
display:flex;gap:8px;margin-bottom:16px}
.search{height:40px;flex:1;border:1px solid #d9e2df;border-radius:9px;padding:0 12px;outline:0}
select{height:40px;border:1px solid #d9e2df;border-radius:9px;padding:0 10px;background:white}
.nombre{padding:12px 5px;white-space:nowrap;color:#52625c}

.table{background:white;border:1px solid #e1e8e5;border-radius:12px;overflow:hidden}
table{width:100%;border-collapse:collapse}
th{height:43px;text-align:left;padding:0 14px;background:#fafcfc;
font-size:9px;color:#82918c;border-bottom:1px solid #dfe7e4}
td{height:59px;padding:0 14px;border-bottom:1px solid #e5ebe9;color:#53645e}
.eleve{display:flex;align-items:center;gap:10px}
.mini{width:38px;height:38px;border-radius:10px;background:#eef5f2;
display:flex;align-items:center;justify-content:center;color:#387263;font-weight:bold}
.eleve strong,.resp strong,.classe strong{display:block;color:#30473f;margin-bottom:4px}
.eleve small,.resp small,.classe small{color:#9aa7a3}
.badge{padding:6px 10px;border-radius:20px;font-size:10px}
.inscrit{background:#ebf8f1;color:#24815e}
.attente{background:#fff8e8;color:#bc841b}
.non{background:#fff0ee;color:#c45143}
.voir{border:1px solid #e0e8e5;background:white;border-radius:9px;padding:8px;cursor:pointer}
.footer{height:49px;padding:0 14px;display:flex;justify-content:space-between;align-items:center;color:#82918c}
.page{background:#076b50;color:white;padding:9px;border-radius:9px}

.modal{position:fixed;inset:0;background:#0005;display:none;align-items:center;justify-content:center}
.modal.active{display:flex}
.modal-box{background:white;width:400px;padding:25px;border-radius:15px}
.modal-box h2{margin-bottom:15px}
.modal-box p{color:#71807b;line-height:1.6}
.close{float:right;border:0;background:none;font-size:22px;cursor:pointer}

@media(max-width:900px){
.actions{grid-template-columns:repeat(2,1fr)}
.container{padding:25px}
.table{overflow:auto}table{min-width:950px}
}
@media(max-width:600px){
.header{padding:0 15px}.profil-info{display:none}
.entete{display:block}.btn{margin-top:20px}
.actions{grid-template-columns:1fr}.filtres{flex-wrap:wrap}
.search{flex-basis:100%}
}
</style>
</head>

<body>
<header class="header">

    <div class="logo">
        ÉCOLE PRIMAIRE AL AMAL
    </div>

    <div class="header-right">

        <div class="annee">
            <span class="point"></span>

            <?= htmlspecialchars($annee->nom) ?>
        </div>

        <button class="notif">
            ♧
        </button>

        <div class="profil">

            <div class="avatar">
                <?= htmlspecialchars($utilisateur->initiales) ?>
            </div>

            <div class="profil-info">

                <strong>
                    <?= htmlspecialchars($utilisateur->prenom) ?>
                    <?= htmlspecialchars($utilisateur->nom) ?>
                </strong>

                <span>
                    <?= htmlspecialchars($utilisateur->role) ?>
                </span>

            </div>

        </div>

    </div>

</header>

<main class="container">

    <div class="entete">
        <div>
            <div class="surtitre">SCOLARITÉ</div>
            <h1>Élèves & inscriptions</h1>
            <p class="description">
                Gérez le dossier de l'élève de son admission jusqu'à sa sortie de l'établissement.
            </p>
        </div>
      <a href="/connexion" class="btn">
    ＋ Inscrire un élève
    </a>
    </div>

    <div class="actions">

        <div class="action" >
            <div class="icon vert">♧</div>
            <div><b>Inscription</b><small>Créer un nouveau dossier</small></div>
            <span class="arrow">→</span>
        </div>

        <div class="action" >
            <div class="icon violet">▣</div>
            <div><b>Réinscription</b><small>Passage à la nouvelle année</small></div>
            <span class="arrow">→</span>
        </div>

        <div class="action" >
            <div class="icon bleu">↓</div>
            <div><b>Transfert entrant</b><small>Élève venant d'une autre école</small></div>
            <span class="arrow">→</span>
        </div>

        <div class="action">
            <div class="icon jaune">↑</div>
            <div><b>Transfert sortant</b><small>Archiver un départ</small></div>
            <span class="arrow">→</span>
        </div>

    </div>

 <form method="GET" action="" class="filtres">

    <input
        class="search"
        type="text"
        name="recherche"
        placeholder="⌕ Nom, matricule ou responsable..."
        value="<?php echo ($_GET['recherche'] ?? '') ?>"
    >

    <select name="classe">
        <option value="">Toutes les classes</option>

        <?php foreach ($classes as $classe) : ?>

    <option
        value="<?= $classe->nomclasse ?>"
        <?= ($_GET['classe'] ?? '') === $classe->nomclasse ? 'selected' : '' ?>
    >
        <?= $classe->nomclasse ?>
    </option>

<?php endforeach; ?>

       
    </select>

    <select name="statut">
    <option value="">Tous les statuts</option>

    <?php foreach ($status as $statut) : ?>

        <option
            value="<?= $statut->mode_statuts ?>"
            <?= ($_GET['statut'] ?? '') === $statut->mode_statuts ? 'selected' : '' ?>
        >
            <?= $statut->mode_statuts ?>
        </option>

    <?php endforeach; ?>

</select>
<button type="submit"
        style="padding: 10px 18px;
              border 0.5px solid;
               border-radius: 8px;
               
              
               font-weight: 600;
               cursor: pointer;">
    filter
</button>

    <span class="nombre">
        <b><?= $nbr ?></b> élève(s)
    </span>

</form>

    <div class="table">

        <table>
            <thead>
                <tr>
                    <th>ÉLÈVE</th>
                    <th>MATRICULE</th>
                    <th>CLASSE</th>
                    <th>ÉTABLISSEMENT</th>
                    <th>RESPONSABLE</th>
                    <th>STATUT</th>
                    <th></th>
                </tr>
            </thead>

            <tbody id="liste">
                <tbody id="liste">

<?php foreach ($inscriptions as $inscription): ?>

    <?php
        $couleur = $inscription->statut_nom === 'INSCRIT'
            ? 'inscrit'
            : ($inscription->statut_nom === 'EN ATTENTE'
                ? 'attente'
                : 'non');

        $initiales =
            strtoupper(substr($inscription->prenom, 0, 1)) .
            strtoupper(substr($inscription->nom, 0, 1));
    ?>

    <tr>

       
        <td>
            <div class="eleve">

                <div class="mini">
                    <?php echo($initiales) ?>
                </div>

                <div>
                    <strong>
                        <?php echo ($inscription->prenom) ?>
                        <?php echo($inscription->nom) ?>
                    </strong>

                    <small>
                        Né(e) le
                        <?php echo($inscription->date_naissance) ?>
                    </small>
                </div>

            </div>
        </td>

        <td>
            <?php echo ($inscription->matricule) ?>
        </td>

        
        <td>
            <div class="classe">
                <strong>
                    <?php echo($inscription->nomclasse) ?>
                </strong>
            </div>
        </td>

       
        <td>
            <?php echo ($inscription->nom_etablissement) ?>
        </td>

        
        <td>
            <div class="resp">

                <strong>
                    <?php echo ($inscription->tuteur_prenom) ?>
                    <?php echo ($inscription->tuteur_nom) ?>
                </strong>

            </div>
        </td>

        <td>
            <span class="badge <?= $couleur ?>">
                <?php echo ($inscription->statut_nom) ?>
            </span>
        </td>

      
        <td>
            <button
                class="voir"
                onclick="('<?php echo ($inscription->prenom . ' ' . $inscription->nom) ?>')"
            >
                ◉
            </button>
        </td>

    </tr>

<?php endforeach; ?>

</tbody>
            </tbody>
        </table>

   <div class="footer">
    <span>Dossiers synchronisés et sauvegardés</span>

    <div class="pagination">
   <div class="pagination">

    <?php if ($nombrePages > 0 && $page > 1): ?>
        <button type="button"
                onclick="window.location.href='?page=<?= $page - 1 ?>'">
            Précédent
        </button>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $nombrePages; $i++): ?>
        <button type="button"
                onclick="window.location.href='?page=<?= $i ?>'">
            <?= $i ?>
        </button>
    <?php endfor; ?>

    <?php if ($nombrePages > 0 && $page < $nombrePages): ?>
        <button type="button"
                onclick="window.location.href='?page=<?= $page + 1 ?>'">
            Suivant
        </button>
    <?php endif; ?>

</div>
    </div>
</div>

    </div>

</main>

<div class="modal" id="modal">
    <div class="modal-box">
        <button class="close" >×</button>
        <h2 id="titre"></h2>
        <p id="texte"></p>
    </div>
</div>
</body>
</html>