<?php
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

  if(!empty($_POST["modele"]))
    $modele = $_POST["modele"];
  else
    $modele = '';

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
            <a href="reserver.php" class="neon">Réserver</a>
        </div>
        <div class="droit">
            <a href="inscription.php"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#FFD700" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></a>
        </div>
    </header> 

   <main>
  <div class="reserver">
    <div class="texte">
      <h2>Réservez votre <span class="jaune">VoltAuto</span> dès maintenant</h2>
      <div class="description">
        Complétez le formulaire pour réserver votre voiture électrique. Nous vous contacterons rapidement pour confirmer votre réservation.
      </div>

      <div class="card2">
        <div class="titre">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#FFD700" class="bi bi-lightning" viewBox="0 0 16 16">
            <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641zM6.374 1 4.168 8.5H7.5a.5.5 0 0 1 .478.647L6.78 13.04 11.478 7H8a.5.5 0 0 1-.474-.658L9.306 1z"/>
          </svg>
          <h3>Réservation rapide</h3>
        </div>
        <div>
          Notre processus de réservation est rapide et simple. Remplissez le formulaire et recevez une confirmation dans 30 minutes.
        </div>
      </div>

      <div class="card2">
        <div class="titre">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#FFD700" class="bi bi-lightning" viewBox="0 0 16 16">
            <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641zM6.374 1 4.168 8.5H7.5a.5.5 0 0 1 .478.647L6.78 13.04 11.478 7H8a.5.5 0 0 1-.474-.658L9.306 1z"/>
          </svg>
          <h3>Annulation rapide</h3>
        </div>
        <div>
          Annulation gratuite jusqu'à 24h avant le début de votre location. Politique flexible pour votre tranquillité d'esprit.
        </div>
      </div>
    </div>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="reservation-form">
      <div class="form-container3">
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
          <label for="email">Email</label>
          <input type="email" name="email" value="<?= $email ?>" placeholder="votre@email.com">
        </div>

        <div class="form-group">
          <label for="telephone">Téléphone</label>
          <input type="tel" name="telephone" value="<?= $telephone ?>" placeholder="+33 X XX XX XX XX">
        </div>

        <div class="form-group">
          <label for="vehicule">Véhicule souhaité</label>
          <select name="modele">
            <option></option>
            <option value="TESLA" <?= $modele == "TESLA" ? "selected" : "" ?>>TESLA</option>
          </select>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="date-debut">Date de début</label>
            <input type="date" id="date-debut" name="date_debut">
          </div>
          <div class="form-group">
            <label for="date-fin">Date de fin</label>
            <input type="date" id="date-fin" name="date_fin">
          </div>
        </div>

        <button class="creer" type="clic" value="ok">Réserver votre véhicule</button>
      </div>
    </form>
  </div>
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