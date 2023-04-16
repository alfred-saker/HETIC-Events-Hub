<?php
include('config.php');

$path = "home.php";

if(isset($_SESSION['user'])){
  header('location:'.$path);
}


if($_POST){
  
  $errors = array();

  if(isset($_POST['email']) && empty($_POST['email'])){
    $errors['email'] = 'Veuillez renseignez votre email';
  }
  if(isset($_POST['mdp']) && empty($_POST['mdp'])){
    $errors['mdp'] = 'Veuillez renseignez votre mot de passe';
  }

  $email = htmlspecialchars(trim($_POST['email']));
  $req = $pdo->query("SELECT * FROM users WHERE email = '$email'");

  if($req->rowCount()>=1){

    $user_find = $req->fetch(PDO::FETCH_ASSOC);

    if(password_verify($_POST['mdp'], $user_find['mdp'])){
      $_SESSION['user']['nom'] = $user_find['nom'];
      $_SESSION['user']['id_users'] = $user_find['id_users'];
      $_SESSION['user']['prenom'] = $user_find['prenom'];
      $_SESSION['user']['type'] = $user_find['type'];
      $_SESSION['user']['email'] = $user_find['email'];
      $_SESSION['user']['date_creation'] = $user_find['date_creation'];
      $_SESSION['user']['date_update'] = $user_find['date_update'];
      $_SESSION['user']['type_account'] = $user_find['type'];
      $_SESSION['user']['promotion'] = $user_find['promotion'];
      header('location:'.$path);
    }
    else{
      $errors['check_mdp'] = 'Mot de passe incorrect';
    }
  }
  else{
    $errors['account_exist'] = "Désolé,ce compte est introuvable!";
  }
}
?>

<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Css/reset.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Css/style.css">
  <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
  <title>HETIC - Events Hub - Connexion </title>
</head>
<body>
  <div class="classLogoFormConnexion">
    <a href="../index.php"><img src="img/logo.svg" alt="Logo HEH"></a>
  </div>
  <div class="classContainerFormConnexion">
    <p class="classTextWelcomeFormConnexion">Connectez-vous sur votre compte Hetic Events Hub (HEH) pour ne manquer aucun évènements</p>
    <?php if(isset($errors)){?>
      <?php if(isset($errors['account_exist'])):?>
        <p style="color:red;margin-left:1em;">
          <?php echo $errors['account_exist'];?>
        </p>
      <?php endif;?>
      <?php if(isset($errors['check_mdp'])):?>
        <p style="color:red; margin-left:1em;">
          <?php echo $errors['check_mdp'];?>
        </p>
      <?php endif;?>
    <form action="" method="post">
      <p style="margin-left:1em;";>Tous les champs suivis d'un <span style="color:red";>*</span> sont obligatoires</p>
      <div class="itemConnexionform">
        <label for="email">Email<span style="color:red";>*</span></label>
        <input type="email" name="email" id="email" placeholder="Entrer votre adresse mail " autocomplete=off value = "<?php echo htmlspecialchars($_POST['email']); ?>">
        <?php if (isset($errors['email'])): ?>
            <p style="color:red;"><?php echo $errors['email']; ?></p>
        <?php endif; ?>
      </div>
      <div class="itemConnexionform">
        <label for="mdp">Mot de passe<span style="color:red";>*</span></label>
        <input type="password" name="mdp" id="mdp" placeholder="Entrer votre mot de passe" autocomplete=off value = "<?php echo htmlspecialchars($_POST['mdp']); ?>">
        <?php if (isset($errors['mdp'])): ?>
            <p style="color:red;"><?php echo $errors['mdp']; ?></p>
        <?php endif; ?>
      </div>
      <div class="itembtnsubmitConnexionform">
        <button type="submit">Connexion</button>
      </div>
      <p><a href="Auth/forgot_password.php">Mot de passe oublié?</a></p><br>
      <p>Pas de compte ? <a href="../index.php">Inscrivez-vous</a> </p>
    </form>
    <?php }else{?>
      <form action="" method="post">
        <p style="margin-left:1em;";>Tous les champs suivis d'un <span style="color:red";>*</span> sont obligatoires</p>
        <div class="itemConnexionform">
          <label for="email">Email<span style="color:red";>*</span></label>
          <input type="email" name="email" id="email" placeholder="Entrer votre adresse mail hetic" autocomplete=off>
        </div>
        <div class="itemConnexionform">
          <label for="mdp">Mot de passe<span style="color:red";>*</span></label>
          <input type="password" name="mdp" id="mdp" placeholder="Entrer votre mot de passe"  autocomplete=off>
        </div>
        <div class="itembtnsubmitConnexionform">
          <button type="submit">Connexion</button>
        </div>
        <div class="classTextConnexion">
          <p style="margin-left:1em;"><a href="Auth/forgot_password.php">Mot de passe oublié?</a></p><br>
          <p style="margin-left:1em;">Pas de compte ? <a href="choix_compte.php">Inscrivez-vous</a> </p>
        </div>
      </form>
    <?php }?>
    <hr class="classLigneSeparationFormConnexion">
    <div class="classHaveYouAccountFormConnexion">
      <p>En souscrivant à nos services, vous recevrez des emails de notre part pour  aux informations vous concernant que vous pouvez exercer conformément aux modalités décrites dans notre politique de confidentialité, dont nous vous invitons à prendre connaissance. Vous pouvez également, pour des motifs légitimes, vous opposer au traitement des données vous concernant.</p>
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
  <script src="Js/events.js"></script>
  <script src="Js/chat.js"></script>
</body>
</html>