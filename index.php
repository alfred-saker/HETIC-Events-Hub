<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Css/style.css">
  <link rel="stylesheet" href="Css/reset.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
  <title>Bienvenue à HEH</title>
</head>
<body>
  <div class="classWrapperIndex">
    <div class="classLogoIndex">
      <a href="index.php"><img src="img/logo.svg" alt="logo HEH"></a>
    </div>
    <div class="classTextChoix">
      <p>Veuillez selectionnez le type de compte </p>
    </div>
    <div class="classBlockBtn">
      <a href="Auth/inscription_asso.php">Association</a>
      <a href="Auth/inscription_etudiant.php">Etudiant</a>
    </div>
  </div>
  <footer>
    <div class="containerFooter">
      <div class="classLogoFooter">
        <a href="../index.php"><img src="img/logo.svg" alt="Logo HEH"></a>
      </div>
      <div class="classItemsFooter">
        <ul>
          <li><a href="#">Les Evènements</a></li>
          <li><a href="#">Les Associations</a></li>
          <li><a href="#">Politiques de confidentialités</a></li>
          <li><a href="#">Sécurités et Cookies</a></li>
        </ul>
      </div>
    </div>
    <div class="classCopyRightFooter">
      <p>Copyright &copy;<?= date('Y');?> HEH-Site de centralisation de données</p>
    </div>
  </footer>
</body>
</html>