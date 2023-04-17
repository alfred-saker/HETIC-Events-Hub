<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Css/reset.css">
  <link rel="stylesheet" href="Css/style.css">
  <link rel="stylesheet" type="text/css" media="screen and (max-width:520px)" href="Css/mobile.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
  <title>Bienvenue à HETIC - Events - Hub</title>
</head>
<body>
  <div class="classWrapperIndex">
    <div class="classLogoIndex">
      <a href="index.php"><img src="img/logo.svg" alt="logo HEH"></a>
    </div>
    <div class="classTextChoix">
      <h1>TYPES DE COMPTES</h1>
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
        <a href="index.php"><img src="img/logo.svg" alt="Logo HEH"></a>
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
  <script src="Js/scripts.js"></script>
  <script src="Js/chat.js"></script>
  <script src="Js/events.js"></script>
</body>
</html>