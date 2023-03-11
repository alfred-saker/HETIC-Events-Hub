<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Css/style.css">
  <link rel="stylesheet" href="../Css/reset.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="shortcut icon" href="../img/logo.svg" type="image/x-icon">
  <title>HEH - Inscritpion Etudiant</title>
</head>
<body>
  <div class="classLogoFormEtu">
    <a href="../index.php"><img src="../img/logo.svg" alt="Logo HEH"></a>
  </div>
  <div class="classContainerFormEtu">
    <p class="classTextWelcomeFormEtu">Inscrivez vous sur Hetic Events Hub (HEH) pour ne manquer aucun évènements<p>
    <form action="#" method="post">
      <p>Tous les champs suivis d'un <span style="color:red";>*</span> sont obligatoires</p>
      <div class="itemEtuform">
        <label for="nom">Nom de l'étudiant<span style="color:red";>*</span></label>
        <input type="text" name="nom" id="nom" placeholder="Entrer votre nom" required>
      </div>
      <div class="itemEtuform">
        <label for="nom">Prenom<span style="color:red";>*</span></label>
        <input type="text" name="prenom" id="prenom" placeholder="Entrer votre prenom" required>
      </div>
      <div class="itemEtuform">
        <label for="email">Email<span style="color:red";>*</span></label>
        <input type="email" name="email" id="email" placeholder="Entrer votre adresse mail hetic" required>
      </div>
      <div class="itemEtuform">
        <label for="promo">Promotion<span style="color:red";>*</span></label>
        <select name="promo" id="promo" required>
          <option value="" selected>Choisissez votre promotion</option>
          <optgroup label="Web">
            <option value="web1">Web1</option>
            <option value="web2">Web2</option>
            <option value="web3">Web3</option>
          </optgroup>
          <optgroup label="Mastère">
              <option value="data">Data et IA</option>
              <option value="marketing-Ux">Marketing et UX design</option>
              <option value="cyber">Cybersecurité</option>
          </optgroup>
          <option value="PMD">Prépa master Digital (PMD)</option>
        </select>
      </div>
      <div class="itemEtuform">
        <label for="mdp">Mot de passe<span style="color:red";>*</span></label>
        <input type="password" name="mdp" id="mdp" placeholder="Saisissez votre mot de passe" required>
      </div>
      <div class="itemEtuform">
        <label for="cmdp">Confirmation Mot de passe<span style="color:red";>*</span></label>
        <input type="password" name="cmdp" id="cmdp" placeholder="Confirmer votre mot de passe" required>
      </div>
      <div class="itemBtnradioEtuform">
        <input type="checkbox" name="secure" id="secure" required>
        <span>J’ accepte les conditions d’ utilisation politique et de  confidentialité de HEH</span>
      </div>
      <div class="itempôEtuform">
        <p>Vos informations renseignées ci-dessus ainsi que vos activités sur le Career Center seront visibles par les administrateurs de HETIC afin de vous accompagner dans votre orientation et vos démarches d’insertion professionnelle.</p>
      </div>
      <div class="itembtnsubmitEtuform">
        <button type="submit">S'inscrire</button>
        <a href="../index.php">Retour</a>
      </div>
      <p>Déjà un compte ? <a href="connexion.php">Connectez-vous</a> </p>
    </form>
    <hr class="classLigneSeparationFormEtu">
    <div class="classHaveYouAccountFormEtu">
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