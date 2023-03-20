<?php
  include('../config.php');
  include('../function.php');

  $type_user = "etudiant";
  $date = date('Y-m-d');

  if(isset($_SESSION['user'])){
    header('location:../espace_personnel.php');
  }
 
  if (($_POST)) {

    $error = array();
    $success = array();

    if(isset(($_POST['nom'])) && empty($_POST['nom'])){
      $error['nom'] = 'Veuillez renseignez votre nom!!';
    }
    if(isset(($_POST['prenom'])) && empty($_POST['prenom'])){
      $error['prenom'] = 'Veuillez renseignez votre prenom!!';
    }
    if(isset(($_POST['email'])) && empty($_POST['email'])){
      $error['email'] = 'Veuillez renseignez votre email!!';
    }
    if(isset(($_POST['promo'])) && empty($_POST['promo'])){
      $error['promo'] = 'Veuillez renseignez votre promotion!!';
    }
    if(isset(($_POST['mdp'])) && empty($_POST['mdp'])){
      $error['mdp'] = 'Veuillez renseignez votre mot de passe!!';
    }
    if(isset(($_POST['cmdp'])) && empty($_POST['cmdp'])){
      $error['cmdp'] = 'Veuillez confirmer votre mot de passe!!';
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $error['email'] = "Cette adresse mail n'est pas valide";
    }
    if(!(checkEmail($_POST['email']))){
      $error['email'] = "Veuillez renseignez votre adresse mail HETIC";
    }
    if(($_POST['mdp']) != ($_POST['cmdp'])){
      $error['mdp'] = "Les mots de passes ne correspondent pas!!";
      if((strlen($_POST['mdp'])<=10)){
        $error['mdp'] = "La longue du mot de passe ne doit pas être inférieure à 10 caractères!!";
      }
    }

    $req = "SELECT * FROM users WHERE email = '$_POST[email]'";
    $result = $pdo->query($req);
    $bool = false;
    if ($result->rowCount()>=1) {
      $bool = true;
      $error_account = "Ce compte existe deja!!";
    }

    $nom =addslashes ($_POST['nom']);
    $prenom =addslashes ($_POST['prenom']);
    $promo = addslashes($_POST['promo']);
    $email = addslashes($_POST['email']);
    $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);

    if(empty($error)){
      $pdo->exec("INSERT INTO users (nom, prenom, email,promotion,date_creation,type,mdp) VALUES ('$nom','$prenom','$email','$promo','$date','$type_user','$mdp')");
      $success['account']= "Votre inscription a été bien prise en compte! Veuillez vous connecter";
      sleep(5);
      header('Location:../Auth/connexion.php?');
    }

  }
?>

<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Css/reset.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../Css/style.css">
  <link rel="shortcut icon" href="../img/logo.svg" type="image/x-icon">
  <title>HEH - Inscritption Etudiant</title>
</head>
<body>
  <div class="classLogoFormEtu">
    <a href="../index.php"><img src="../img/logo.svg" alt="Logo HEH"></a>
  </div>
  <div class="classContainerFormEtu">
    <div class="classBlockTextEtu">
      <h1 class="classTitleFormEtu">Inscription</h1>
      <p class="classTextWelcomeFormEtu">Inscrivez vous sur Hetic Events Hub (HEH) pour ne manquer aucun évènements<p>
    </div>
    <?php if(isset($error)){?>

      <div style="margin-top:1em;">
        <p>Tous les champs suivis d'un <span style="color:red";>*</span> sont obligatoires</p> <br>
      </div>
      <form action="" method="post">
        <p style="color:red;margin-left:1em;">
          <?php if($bool==true):?>
            <?php echo $error_account;?>
          <?php endif;?>
        </p>
        <p style="color:#14AE5C;">
          <?php if(isset($success['account'])):?>
            <?php echo $success['account'];?>
          <?php endif;?>
        </p>
        <div class="itemEtuform">
          <label for="nom">Nom de l'étudiant<span style="color:red";>*</span></label>
          <input type="text" name="nom" id="nom" placeholder="Entrer votre nom" autocomplete=off value="<?php echo htmlspecialchars($_POST['nom']); ?>">
          <?php if (isset($error['nom'])): ?>
            <p style="color:red;"><?php echo $error['nom']; ?></p>
          <?php endif; ?>
        </div>
        <div class="itemEtuform">
          <label for="nom">Prenom<span style="color:red";>*</span></label>
          <input type="text" name="prenom" id="prenom" placeholder="Entrer votre prenom" autocomplete=off value="<?php echo htmlspecialchars($_POST['prenom']); ?>">
          <?php if (isset($error['prenom'])): ?>
            <p style="color:red;"><?php echo $error['prenom']; ?></p>
          <?php endif; ?>
        </div>
        <div class="itemEtuform">
          <label for="email">Email<span style="color:red";>*</span></label>
          <input type="email" name="email" id="email" placeholder="Entrer votre adresse mail hetic"  autocomplete=off value="<?php echo htmlspecialchars($_POST['email']); ?>">
          <?php if (isset($error['email'])): ?>
            <p style="color:red;"><?php echo $error['email']; ?></p>
          <?php endif; ?>
        </div>
        <div class="itemEtuform">
          <label for="promo">Promotion<span style="color:red";>*</span></label>
          <select name="promo" id="promo" autocomplete=off >
            <option value="" selected>Choisissez votre promotion</option>
            <optgroup label="Bachelor">
              <option value="Bachelor Developpement web">Bachelor Developpement web</option>
              <option value="Bachelor 3D">Bachelor 3D</option>
              <option value="Bachelor Data & IA">Bachelor Data & IA</option>
              <option value="Bachelor Webmarketing & UX design">Bachelor Webmarketing & UX design</option>
            </optgroup>
            <optgroup label="Mastère">
                <option value="Mastère Data & IA">Data et IA</option>
                <option value="Mastère marketing digital & Ux">Marketing et UX design</option>
                <option value="Mastère cybersecurité">Cybersecurité</option>
                <option value="Mastère CTO & Tech Lead">Mastère CTO & Tech Lead</option>
                <option value="Mastère Product Manager">Mastère Product Manager</option>
            </optgroup>
            <option value="Prépa Mastère Digital">Prépa master Digital (PMD)</option>
          </select>
          <?php if (isset($error['promo'])): ?>
            <p style="color:red;"><?php echo $error['promo']; ?></p>
          <?php endif; ?>
        </div>
        <div class="itemEtuform">
          <label for="mdp">Mot de passe<span style="color:red";>*</span></label>
          <input type="password" name="mdp" id="mdp" placeholder="Saisissez votre mot de passe" autocomplete=off value="<?php echo htmlspecialchars($_POST['mdp']); ?>">
          <?php if (isset($error['mdp'])): ?>
            <p style="color:red;"><?php echo $error['mdp']; ?></p>
          <?php endif; ?>
        </div>
        <div class="itemEtuform">
          <label for="cmdp">Confirmation Mot de passe<span style="color:red";>*</span></label>
          <input type="password" name="cmdp" id="cmdp" placeholder="Confirmer votre mot de passe"  autocomplete=off>
          <?php if (isset($error['cmdp'])): ?>
            <p style="color:red;"><?php echo $error['cmdp']; ?></p>
          <?php endif; ?>
        </div>
        <div class="itemBtnradioEtuform">
          <input type="checkbox" name="secure" id="secure">
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
    <?php }else{?>
      <form action="" method="post">
        <div>
          <p>Tous les champs suivis d'un <span style="color:red";>*</span> sont obligatoires</p> <br>
        </div>
        <div class="itemEtuform">
          <label for="nom">Nom de l'étudiant<span style="color:red";>*</span></label>
          <input type="text" name="nom" id="nom" placeholder="Entrer votre nom" autocomplete=off>
        </div>
        <div class="itemEtuform">
          <label for="nom">Prenom<span style="color:red";>*</span></label>
          <input type="text" name="prenom" id="prenom" placeholder="Entrer votre prenom" autocomplete=off>
        </div>
        <div class="itemEtuform">
          <label for="email">Email<span style="color:red";>*</span></label>
          <input type="email" name="email" id="email" placeholder="Entrer votre adresse mail hetic"  autocomplete=off>
        </div>
        <div class="itemEtuform">
          <label for="promo">Promotion<span style="color:red";>*</span></label>
          <select name="promo" id="promo" autocomplete=off >
            <option value="" selected>Choisissez votre promotion</option>
            <optgroup label="Bachelor">
              <option value="Bachelor Developpement web">Bachelor Developpement web</option>
              <option value="Bachelor 3D">Bachelor 3D</option>
              <option value="Bachelor Data & IA">Bachelor Data & IA</option>
              <option value="Bachelor Webmarketing & UX design">Bachelor Webmarketing & UX design</option>
            </optgroup>
            <optgroup label="Mastère">
                <option value="Mastère Data & IA">Data et IA</option>
                <option value="Mastère marketing digital & Ux">Marketing et UX design</option>
                <option value="Mastère cybersecurité">Cybersecurité</option>
                <option value="Mastère CTO & Tech Lead">Mastère CTO & Tech Lead</option>
                <option value="Mastère Product Manager">Mastère Product Manager</option>
            </optgroup>
            <option value="Prépa Mastère Digital">Prépa master Digital (PMD)</option>
          </select>
        </div>
        <div class="itemEtuform">
          <label for="mdp">Mot de passe<span style="color:red";>*</span></label>
          <input type="password" name="mdp" id="mdp" placeholder="Saisissez votre mot de passe" autocomplete=off >
        </div>
        <div class="itemEtuform">
          <label for="cmdp">Confirmation Mot de passe<span style="color:red";>*</span></label>
          <input type="password" name="cmdp" id="cmdp" placeholder="Confirmer votre mot de passe"  autocomplete=off>
        </div>
        <div class="itemBtnradioEtuform">
          <input type="checkbox" name="secure" id="secure">
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
      <?php }?>

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