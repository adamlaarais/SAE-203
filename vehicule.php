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
      <div class="filtresContainer">
  <svg id="toggleFiltres" xmlns="http://www.w3.org/2000/svg" width="54" height="54" fill="#FFD700" class="bi bi-funnel-fill" viewBox="0 0 16 16" style="cursor:pointer;">
    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z"/>
  </svg>

  <div class="zoneFiltres hidden">
    <a href="?tri=marque&ordre=ASC" class="<?= ($tri === 'marque' && $ordre === 'ASC') ? 'active' : '' ?>">Marque 
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentcolor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371zm1.57-.785L11 2.687h-.047l-.652 2.157z"/>
            <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z"/>
        </svg>
    </a>
    <a href="?tri=marque&ordre=DESC" class="<?= ($tri === 'marque' && $ordre === 'DESC') ? 'active' : '' ?>">Marque
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
            <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645z"/>
            <path fill-rule="evenodd" d="M10.082 12.629 9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371zm1.57-.785L11 9.688h-.047l-.652 2.156z"/>
            <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z"/>
        </svg>
    </a>
    <a href="?tri=prix&ordre=ASC" class="<?= ($tri === 'prix' && $ordre === 'ASC') ? 'active' : '' ?>">Prix
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-sort-numeric-down" viewBox="0 0 16 16">
            <path d="M12.438 1.668V7H11.39V2.684h-.051l-1.211.859v-.969l1.262-.906h1.046z"/>
            <path fill-rule="evenodd" d="M11.36 14.098c-1.137 0-1.708-.657-1.762-1.278h1.004c.058.223.343.45.773.45.824 0 1.164-.829 1.133-1.856h-.059c-.148.39-.57.742-1.261.742-.91 0-1.72-.613-1.72-1.758 0-1.148.848-1.835 1.973-1.835 1.09 0 2.063.636 2.063 2.687 0 1.867-.723 2.848-2.145 2.848zm.062-2.735c.504 0 .933-.336.933-.972 0-.633-.398-1.008-.94-1.008-.52 0-.927.375-.927 1 0 .64.418.98.934.98"/>
            <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z"/>
        </svg>
    </a>
    <a href="?tri=prix&ordre=DESC" class="<?= ($tri === 'prix' && $ordre === 'DESC') ? 'active' : '' ?>">Prix
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-sort-numeric-down-alt" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.36 7.098c-1.137 0-1.708-.657-1.762-1.278h1.004c.058.223.343.45.773.45.824 0 1.164-.829 1.133-1.856h-.059c-.148.39-.57.742-1.261.742-.91 0-1.72-.613-1.72-1.758 0-1.148.848-1.836 1.973-1.836 1.09 0 2.063.637 2.063 2.688 0 1.867-.723 2.848-2.145 2.848zm.062-2.735c.504 0 .933-.336.933-.972 0-.633-.398-1.008-.94-1.008-.52 0-.927.375-.927 1 0 .64.418.98.934.98"/>
            <path d="M12.438 8.668V14H11.39V9.684h-.051l-1.211.859v-.969l1.262-.906h1.046zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z"/>
        </svg>
    </a>
  </div>
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
<script src="js/filtre.js"></script>
</body>
</html>
