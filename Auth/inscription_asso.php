<?php
  include('../config.php');
  include('../function.php');


  $type_user = "association";
  $date = date('Y-m-d:H:i:s');
  $path = "../index.php";

  if(isset($_SESSION['user'])){
    header('location:../espace_perso.php');
  }
 
  if (($_POST)) {

    $error = array();
    $success = array();

    if(isset($_POST['nom_asso']) && empty($_POST['nom_asso'])){
      $error['nom'] = "Veuillez renseignez le nom de l'association!!";
    }
    if(isset($_POST['description_asso']) && empty($_POST['description_asso'])){
      $error['desc'] = "Veuillez renseignez la description!!";
    }
    if(isset($_POST['mdp_asso']) && empty($_POST['mdp_asso'])){
      $error['mdp'] = 'Veuillez renseignez le mot de passe!!';
    }
    if(isset($_POST['cmdp_asso']) && empty($_POST['cmdp_asso'])){
      $error['cmdp'] = 'Veuillez confirmer le mot de passe!!';
    }
    
    if(isset($_POST['email_asso']) && empty($_POST['email_asso'])){
      $error['email'] = "Veuillez renseignez l'email!!";
      if(!filter_var($_POST['email_asso'], FILTER_VALIDATE_EMAIL)){
        $error['email'] = "Cette adresse mail n'est pas valide";
      }
    }
    if(($_POST['mdp_asso']) != ($_POST['cmdp_asso'])){
      $error['mdp'] = "Les mots de passes ne correspondent pas!!";
      if((strlen($_POST['mdp_asso'])<=10)){
        $error['mdp'] = "La longue du mot de passe ne doit pas être inférieure à 10 caractères!!";
      }
    }

    $req = "SELECT * FROM users WHERE email = '$_POST[email_asso]'";
    $result = $pdo->query($req);
    $bool = false;
    if ($result->rowCount()>=1) {
      $bool = true;
      $error_account = "Ce compte existe deja!!";
    }

    $nom = htmlspecialchars(trim($_POST['nom_asso']));
    $email = htmlspecialchars(trim($_POST['email_asso']));
    $desc = htmlspecialchars(trim($_POST['description_asso']));
    $mdp = password_hash($_POST['mdp_asso'],PASSWORD_DEFAULT);

    if(empty($error)){
      $pdo->exec("INSERT INTO users (nom, email,description,date_creation,type,mdp) VALUES ('$nom','$email','$desc','$date','$type_user','$mdp')");
      // sleep(5);
      // echo '<script>alert("Votre inscription a été bien prise en compte! Veuillez vous connecter"); window.location.href = "../index.php";</script>';
      echo '<div style="background-color: #26E8A0; color: #ffff; padding: 10px;">Votre inscription a été bien prise en compte! Veuillez vous connecter !</div>';
      header("Refresh: 3; url=../index.php");
    }
  }
?>

<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Css/reset.css">
  <link rel="stylesheet" href="../Css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="shortcut icon" href="../img/logo.svg" type="image/x-icon">
  <title>HEH - Inscritpion Association</title>
</head>
<body>
  <div class="classLogoFormAsso">
    <a href="../index.php"><img src="../img/logo.svg" alt="Logo HEH"></a>
  </div>
  <div class="classContainerFormAsso">
    <div style="backgound-color:#14AE5C;">
      <h1 class="classTitleFormAsso">Inscription</h1>
      <p class="classTextWelcomeFormAsso">Inscrivez vous sur Hetic Events Hub (HEH) pour diffuser vos évènements<p>
    </div>
    <?php if(isset($error)){?>
      <form action="" method="post">
      <p>Tous les champs suivis d'un <span style="color:red";>*</span> sont obligatoires</p>
      <p style="color:red;margin-left:1em;">
        <?php if($bool==true):?>
          <?php echo $error_account;?>
        <?php endif;?>
      </p>
      <div class="itemAssoform">
        <label for="nom_asso">Nom de l'association <span style="color:red";>*</span></label>
        <input type="text" name="nom_asso" id="nom" placeholder="Entrer le nom de l'association" autocomplete=off value="<?php echo htmlspecialchars($_POST['nom_asso']); ?>">
        <?php if (isset($error['nom'])): ?>
            <p style="color:red;"><?php echo $error['nom']; ?></p>
        <?php endif; ?>
      </div>
      <div class="itemAssoform">
        <label for="email_asso">Email<span style="color:red";>*</span></label>
        <input type="email" name="email_asso" id="email_asso" placeholder="Entrer l'adresse mail de l'association" autocomplete=off value="<?php echo htmlspecialchars($_POST['email_asso']); ?>">
        <?php if (isset($error['email'])): ?>
            <p style="color:red;"><?php echo $error['email']; ?></p>
          <?php endif; ?>
      </div>
      <div class="itemAssoform">
        <label for="description_asso">Description<span style="color:red";>*</span></label>
        <textarea name="description_asso" id="description" cols="30" rows="10" placeholder = "Donnez les objectifs et but en quelques lignes..." autocomplete=off value="<?php echo htmlspecialchars($_POST['description_asso']);?>"></textarea>
        <?php if (isset($error['desc'])): ?>
            <p style="color:red;"><?php echo $error['desc']; ?></p>
        <?php endif; ?>
      </div>
      <div class="itemAssoform">
        <label for="mdp_asso">Mot de passe<span style="color:red";>*</span></label>
        <input type="password" name="mdp_asso" id="mdp" placeholder="Saisissez votre mot de passe" autocomplete=off value="<?php echo htmlspecialchars($_POST['mdp_asso']); ?>">
        <?php if (isset($error['mdp'])): ?>
            <p style="color:red;"><?php echo $error['mdp']; ?></p>
        <?php endif; ?>
      </div>
      <div class="itemAssoform">
        <label for="cmdp_asso">Confirmation Mot de passe<span style="color:red";>*</span></label>
        <input type="password" name="cmdp_asso" id="cmdp" placeholder="Confirmer votre mot de passe" >
        <?php if (isset($error['cmdp'])): ?>
            <p style="color:red;"><?php echo $error['cmdp']; ?></p>
        <?php endif; ?>
      </div>
      <div class="itemBtnradioAssoform">
        <input type="checkbox" name="secure" id="secure" >
        <span>J’ accepte les conditions d’ utilisation politique et de  confidentialité de HEH<span style="color:red";>*</span></span>
      </div>
      <div class="itempôAssoform">
        <p>Vos informations renseignées ci-dessus ainsi que vos activités sur le Career Center seront visibles par les administrateurs de HETIC afin de vous accompagner dans votre orientation et vos démarches d’insertion professionnelle.</p>
      </div>
      <div class="itembtnsubmitAssoform">
        <button type="submit">S'inscrire</button>
        <a href="../index.php">Retour</a>
      </div>
      <p>Déjà un compte ? <a href="../index.php">Connectez-vous</a> </p>
    </form>
    <?php }else{?>
      <form action="" method="post">
      <p>Tous les champs suivis d'un <span style="color:red";>*</span> sont obligatoires</p>
      <div class="itemAssoform">
        <label for="nom_asso">Nom de l'association <span style="color:red";>*</span></label>
        <input type="text" name="nom_asso" id="nom" placeholder="Entrer le nom de l'association">
      </div>
      <div class="itemAssoform">
        <label for="email_asso">Email<span style="color:red";>*</span></label>
        <input type="email" name="email_asso" id="email_asso" placeholder="Entrer l'adresse mail de l'association" >
      </div>
      <div class="itemAssoform">
        <label for="description_asso">Description<span style="color:red";>*</span></label>
        <textarea name="description_asso" id="description" cols="30" rows="10" placeholder = "Donnez les objectifs et but en quelques lignes..."></textarea>
      </div>
      <div class="itemAssoform">
        <label for="mdp_asso">Mot de passe<span style="color:red";>*</span></label>
        <input type="password" name="mdp_asso" id="mdp" placeholder="Saisissez votre mot de passe" >
      </div>
      <div class="itemAssoform">
        <label for="cmdp_asso">Confirmation Mot de passe<span style="color:red";>*</span></label>
        <input type="password" name="cmdp_asso" id="cmdp" placeholder="Confirmer votre mot de passe" >
      </div>
      <div class="itemBtnradioAssoform">
        <input type="checkbox" name="secure" id="secure" >
        <span>J’ accepte les conditions d’ utilisation politique et de  confidentialité de HEH<span style="color:red";>*</span></span>
      </div>
      <div class="itempôAssoform">
        <p>Vos informations renseignées ci-dessus ainsi que vos activités sur le Career Center seront visibles par les administrateurs de HETIC afin de vous accompagner dans votre orientation et vos démarches d’insertion professionnelle.</p>
      </div>
      <div class="itembtnsubmitAssoform">
        <button type="submit">S'inscrire</button>
        <a href="../index.php">Retour</a>
      </div>
      <p>Déjà un compte ? <a href="../index.php">Connectez-vous</a> </p>
    </form>
    <?php }?>
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