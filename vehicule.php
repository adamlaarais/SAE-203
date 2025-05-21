<?php
// Connexion à la base de données
try {
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $bdd = new PDO('mysql:host=localhost;dbname=sae_203', 'root', '', $options);
} catch(Exception $err) {
    die('Erreur connexion MySQL : ' . $err->getMessage());
}

// Récupération des données pour les menus déroulants
$vehicule = $bdd->query("SELECT * FROM vehicule")->fetchAll(PDO::FETCH_ASSOC);

$bdd = null; // Fermeture de la connexion

// Génération du HTML
$resultat = '<div class="pourquoi-cube">';
foreach($vehicule as $v) {
    $marque = $v['marque'];
    $image = 'img/' . $v['logo_marque'];
    $modele = $v['modele'];
    $description = $v['description'];
    $prix = $v['prix'];

    $resultat .= '<div class="cube">';
    $resultat .= '<div class="logo" style="background-image: url(\'' . $image . '\')"></div>';
    $resultat .= '<h3 class="jaune">' . $marque . ' ' . $modele . '</h3>';
    $resultat .= '<div>' . $prix . '€/jour</div>';
    $resultat .= '<div class="description">' . $description . '</div>';
    $resultat .= '<a class="bouton" href="reserver.php">Réserver maintenant</a>';
    $resultat .= '</div>';
}
$resultat .= '</div>';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoltAuto</title>
    <link rel="stylesheet" href="style/style.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="shortcut icon" href="img/logo.jpg" type="img/jpeg">
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
            <a href="inscription.php"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#FFD700" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></a>
        </div>
    </header>

    <main class="resultat">
        <?= $resultat?>
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