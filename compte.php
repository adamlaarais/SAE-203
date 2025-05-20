<?php
  // TRAITEMENT DU FORMULAIRE
  // Initialisation des chaines de caractères


  // Initialisation des variables
  if(!empty($_POST["email"]))
    $email = $_POST["email"];
  else
    $email = '';

  if(!empty($_POST["motdepasse"]))
    $motdepasse = $_POST["motdepasse"];
  else
    $motdepasse = '';

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
            <a href="accueil.php" class="trait">Accueil</a>
            <a href="vehicule.php" class="trait">Nos Véhicules</a>
            <a href="plus.php" class="trait">En Savoir Plus</a>
            <a href="reserver.php" class="trait">Réserver</a>
        </div>
        <div class="droit">
            <a href="compte.php"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#FFD700" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></a>
        </div>
    </header>

    <main>
      <div class="compte">
        <h2 class="jaune">Connectez vous à votre compte</h2>
        <div class="description">Rejoignez la révolution de la mobilité électrique</div>
      </div>
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-container2">
            <form class="reservation-form">
              
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="<?= $email ?>" placeholder="votre@email.com">
              </div>
        
              <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="motdepasse"value="<?= $motdepasse ?>" placeholder="Votre mot de passe">
              </div>

              <button class="creer" type="clic" value="ok">Se connecter à mon compte</button>

              <div class="inscription">
                <a href="inscription.php">Pas de compte ? S'inscrire</a>
              </div>
            </form>
          </div>
          </form>
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