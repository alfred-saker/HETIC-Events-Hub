<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Css/style.css">
  <link rel="stylesheet" href="../Css/reset.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="shortcut icon" href="../img/logo.svg" type="image/x-icon">
  <title>HEH - Inscritpion Association</title>
</head>
<body>
  <div class="classLogoFormAsso">
    <a href="../index.php"><img src="../img/logo.svg" alt="Logo HEH"></a>
  </div>
  <div class="classContainerFormAsso">
    <p class="classTextWelcomeFormAsso">Inscrivez vous sur Hetic Events Hub (HEH) pour diffuser vos évènements<p>
      <form action="#" method="post">
      <p>Tous les champs suivis d'un <span style="color:red";>*</span> sont obligatoires</p>
      <div class="itemAssoform">
        <label for="nom">Nom de l'association <span style="color:red";>*</span></label>
        <input type="text" name="nom" id="nom" placeholder="Entrer votre nom" required>
      </div>
      <div class="itemAssoform">
        <label for="email">Email<span style="color:red";>*</span></label>
        <input type="email" name="email" id="email" placeholder="Entrer votre adresse mail hetic" required>
      </div>
      <div class="itemAssoform">
        <label for="description">Description<span style="color:red";>*</span></label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
      </div>
      <div class="itemAssoform">
        <label for="mdp">Mot de passe<span style="color:red";>*</span></label>
        <input type="password" name="mdp" id="mdp" placeholder="Saisissez votre mot de passe" required>
      </div>
      <div class="itemAssoform">
        <label for="cmdp">Confirmation Mot de passe<span style="color:red";>*</span></label>
        <input type="password" name="cmdp" id="cmdp" placeholder="Confirmer votre mot de passe" required>
      </div>
      <div class="itemBtnradioAssoform">
        <input type="checkbox" name="secure" id="secure" required>
        <span>J’ accepte les conditions d’ utilisation politique et de  confidentialité de HEH<span style="color:red";>*</span></span>
      </div>
      <div class="itempôAssoform">
        <p>Vos informations renseignées ci-dessus ainsi que vos activités sur le Career Center seront visibles par les administrateurs de HETIC afin de vous accompagner dans votre orientation et vos démarches d’insertion professionnelle.</p>
      </div>
      <div class="itembtnsubmitAssoform">
        <button type="submit">S'inscrire</button>
        <a href="../index.php">Retour</a>
      </div>
      <p>Déjà un compte ? <a href="connexion.php">Connectez-vous</a> </p>
    </form>
    <hr class="classLigneSeparationFormAsso">
    <div class="classHaveYouAccountFormAsso">
      <p>En souscrivant à nos services, vous recevrez des emails de notre part pour  aux informations vous concernant que vous pouvez exercer conformément aux modalités décrites dans notre politique de confidentialité, dont nous vous invitons à prendre connaissance. Vous pouvez également, pour des motifs légitimes, vous opposer au traitement des données vous concernant.</p>
    </div>
  </div>
  <footer>
    <div class="containerFooter">
      <div class="classLogoFooter">
        <img src="../img/logo.svg" alt="Logo Footer">
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