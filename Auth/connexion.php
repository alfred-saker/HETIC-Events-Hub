<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Css/style.css">
  <link rel="stylesheet" href="../Css/reset.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="shortcut icon" href="../img/logo.svg" type="image/x-icon">
  <title>HEH - Connexion </title>
</head>
<body>
  <div class="classLogoFormConnexion">
    <a href="../index.php"><img src="../img/logo.svg" alt="Logo HEH"></a>
  </div>
  <div class="classContainerFormConnexion">
    <p class="classTextWelcomeFormConnexion">Connectez-vous sur votre compte Hetic Events Hub (HEH) pour ne manquer aucun évènements<p>
    <form action="#" method="post">
      <p>Tous les champs suivis d'un <span style="color:red";>*</span> sont obligatoires</p>
      <div class="itemConnexionform">
        <label for="email">Email<span style="color:red";>*</span></label>
        <input type="email" name="email" id="email" placeholder="Entrer votre adresse mail hetic" required>
      </div>
      <div class="itemConnexionform">
        <label for="mdp">Mot de passe<span style="color:red";>*</span></label>
        <input type="password" name="mdp" id="mdp" placeholder="Entrer votre mot de passe" required>
      </div>
      <div class="itembtnsubmitConnexionform">
        <button type="submit">Je me connecte</button>
      </div>
      <p>Pas de compte ? <a href="../index.php">Inscrivez-vous</a> </p>
    </form>
    <hr class="classLigneSeparationFormConnexion">
    <div class="classHaveYouAccountFormConnexion">
      <p>En souscrivant à nos services, vous recevrez des emails de notre part pour  aux informations vous concernant que vous pouvez exercer conformément aux modalités décrites dans notre politique de confidentialité, dont nous vous invitons à prendre connaissance. Vous pouvez également, pour des motifs légitimes, vous opposer au traitement des données vous concernant.</p>
    </div>
  </div>
  <footer>
    <div class="containerFooter">
      <div class="classLogoFooter">
        <a href="../index.php"><img src="../img/logo.svg" alt="Logo HEH"></a>
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