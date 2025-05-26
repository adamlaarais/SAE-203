<?php
require "fonctions_BDD.php";

// Initialisation
$resultat = "";
$erreur = "";

// Récupération des valeurs POST
  if(!empty($_POST["prenom"]))
    $prenom = $_POST["prenom"];
  else
    $prenom = '';

  if(!empty($_POST["nom"]))
    $nom = $_POST["nom"];
  else
    $nom = '';

  if(!empty($_POST["telephone"]))
    $telephone = $_POST["telephone"];
  else
    $telephone = '';

  if(!empty($_POST["email"]))
    $email = $_POST["email"];
  else
    $email = '';

  if(!empty($_POST["mot_de_passe"]))
    $mot_de_passe = $_POST["mot_de_passe"];
  else
    $mot_de_passe = '';

// Traitement du formulaire
if (isset($_POST["clic"])) {
    if (empty($nom) || is_numeric($nom)) {
        $erreur .= "Veuillez entrer un nom valide<br>";
    }

    if (empty($prenom) || is_numeric($prenom)) {
        $erreur .= "Veuillez entrer un prénom valide<br>";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur .= "Veuillez entrer un email valide<br>";
    }

    if (empty($telephone) || !is_numeric($telephone)) {
        $erreur .= "Veuillez entrer un téléphone valide (uniquement des chiffres)<br>";
    }

    if (empty($mot_de_passe)) {
        $erreur .= "Veuillez entrer un mot de passe<br>";
    } else if (strlen($mot_de_passe) < 3) {
        $erreur .= "Le mot de passe doit contenir au moins 3 caractères<br>";
    }

    if (empty($erreur)) {
        $requete = "INSERT INTO client (nom, prenom, email, telephone, mot_de_passe) VALUES ('$nom', '$prenom', '$email', '$telephone', '$mot_de_passe')";
        $nb_ecriture = ecritureBDD($requete);

        if ($nb_ecriture == 1) {
            $resultat = "<div>Bienvenue dans l'équipe VoltAuto <span class='jaune'>$prenom $nom</span></div>";
        } else {
            $erreur = "Échec lors de la création du compte";
        }
    }
}
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
            <a href="vehicule.php" class="trait">Nos Véhicules</a>
            <a href="plus.html" class="trait">En Savoir Plus</a>
            <a href="reserver.php" class="trait">Réserver</a>
        </div>
        <div class="droit">
            <a href="inscription.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#FFD700" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </a>
        </div>
    </header>

    <main class="animate-on-scroll">
        <div class="compte">
            <h2 class="jaune">Créer votre compte</h2>
            <div class="description">Rejoignez la révolution de la mobilité électrique</div>
        </div>

        <form class="reservation-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-container2">
                <div class="form-row">
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" value="<?= $prenom ?>" placeholder="Votre prénom">
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" value="<?= $nom ?>" placeholder="Votre nom">
                    </div>
                </div>

                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" name="telephone" value="<?= $telephone ?>" placeholder="+33 X XX XX XX XX">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?= $email ?>" placeholder="votre@email.com">
                </div>

                <div class="form-group">
                    <label for="mot_de_passe">Mot de passe</label>
                    <input type="password" name="mot_de_passe" value="<?= $mot_de_passe ?>" placeholder="Votre mot de passe">
                </div>

                <button class="creer" type="submit" name="clic" value="ok">Créer mon compte</button>
            </div>
        </form>

        <?php
            if (!empty($erreur)) {
                echo "<div class='erreur'>$erreur</div>";
            } else if (!empty($resultat)) {
                echo "<div class='succes'>$resultat</div>";
            }
        ?>
    </main>

    <footer class="animate-on-scroll">
        <div>2025 VoltAuto. Tous droits réservés.</div>
        <div class="legalite">
            <div>Mentions légales</div>
            <div>Politiques de confidentialité</div>
            <div>CGV</div>
        </div>
    </footer>
<script src="js/anim.js"></script>
</body>
</html>
