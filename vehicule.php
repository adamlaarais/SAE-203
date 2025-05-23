<?php
// Connexion à la base de données
try {
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $bdd = new PDO('mysql:host=localhost;dbname=sae_203', 'root', '', $options);
} catch(Exception $err) {
    die('Erreur connexion MySQL : ' . $err->getMessage());
}

// Paramètres de tri (venant de l'URL)
$tri = isset($_GET['tri']) ? $_GET['tri'] : 'marque';
$ordre = isset($_GET['ordre']) ? $_GET['ordre'] : 'ASC';

// Sécurisation des paramètres
$colonnes_autorisees = ['marque', 'modele', 'prix'];
$ordres_autorises = ['ASC', 'DESC'];

if (!in_array($tri, $colonnes_autorisees)) $tri = 'marque';
if (!in_array($ordre, $ordres_autorises)) $ordre = 'ASC';

// Requête SQL
$requete = $bdd->prepare("SELECT * FROM vehicule ORDER BY $tri $ordre");
$requete->execute();
$vehicules = $requete->fetchAll(PDO::FETCH_ASSOC);
$bdd = null;

// Génération HTML
$resultat = '<div class="vehicule">';
foreach($vehicules as $v) {
    $image = 'img/' . $v['image'];
    $marque = $v['marque'];
    $description = $v['description'];
    $modele = $v['modele'];
    $prix = $v['prix'];

    $resultat .= '<div class="v">';
    $resultat .= '<div class="car-image" style="background-image: url(\'' . $image . '\');"></div>';
    $resultat .= '<h3 class="jaune">' . $marque . ' ' . $modele . '</h3>';
    $resultat .= '<div class="sous-titre"><span class="jaune">' . $prix . '€</span> /jour</div>';
    $resultat .= '<p class="description">' . $description . '</p>';
    $resultat .= '<a class="bouton-car" href="reserver.php">Réserver Maintenant</a>';
    $resultat .= '</div>';
}
$resultat .= '</div>';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>VoltAuto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="shortcut icon" href="img/logo.jpg" type="image/jpeg">
</head>
<body>
    <header>
        <div class="gauche">
            <img class="logo" src="img/logo.jpg" alt="logo">
            <h1>.VoltAuto</h1>
        </div>
        <div class="centre">
            <a href="accueil.html" class="trait">Accueil</a>
            <a href="vehicule.php" class="neon">Nos Véhicules</a>
            <a href="plus.html" class="trait">En Savoir Plus</a>
            <a href="reserver.html" class="trait">Réserver</a>
        </div>
        <div class="droit">
            <a href="inscription.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#FFD700" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </a>
        </div>
    </header>

    <main class="resultat">
        <div class="zoneFiltres">
            <a href="?tri=marque&ordre=ASC" class="<?= ($tri === 'marque' && $ordre === 'ASC') ? 'active' : '' ?>">Marque (A-Z)</a>
            <a href="?tri=marque&ordre=DESC" class="<?= ($tri === 'marque' && $ordre === 'DESC') ? 'active' : '' ?>">Marque (Z-A)</a>
            <a href="?tri=prix&ordre=ASC" class="<?= ($tri === 'prix' && $ordre === 'ASC') ? 'active' : '' ?>">Prix (Croissant)</a>
            <a href="?tri=prix&ordre=DESC" class="<?= ($tri === 'prix' && $ordre === 'DESC') ? 'active' : '' ?>">Prix (Décroissant)</a>
        </div>
        <?= $resultat ?>
    </main>

    <footer>
        <div>2025 VoltAuto. Tous droits réservés.</div>
        <div class="legalite">
            <div>Mentions légales</div>
            <div>Politiques de confidentialité</div>
            <div>CGV</div>
        </div>
    </footer>
</body>
</html>
