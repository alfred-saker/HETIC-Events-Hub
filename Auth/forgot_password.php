<?php
include('../config.php');

if($_POST){
  
  $errors_password = array();

  if(isset($_POST['email']) && empty($_POST['email'])){
    $errors_password['email'] = 'Veuillez saisir votre email';
  }
  if(isset($_POST['Nmdp']) && empty($_POST['Nmdp'])){
    $errors_password['Nmdp'] = 'Veuillez saisir votre nouveau mot de passe';
  }
  if(isset(($_POST['CNmdp'])) && empty($_POST['CNmdp'])){
    $errors_password['CNmdp'] = 'Veuillez confirmer  votre mot de passe';
  }
  if((strlen($_POST['Nmdp']) && strlen($_POST['CNmdp'])<=8) && strlen(($_POST['Nmdp'])>0)){
    $errors_password['length_password'] = "La longue du mot de passe ne doit pas être inférieure à 10 caractères";
  }
  if(($_POST['Nmdp'])!=($_POST['CNmdp'])){
    $errors_password['match_password'] = 'Les mots de passes ne correspondent pas';
  }

  $req =$pdo->query("SELECT * FROM users WHERE email='$_POST[email]'");

  if($req->rowCount()>=1){
    $password = password_hash($_POST['Nmdp'],PASSWORD_DEFAULT);
    $pdo->exec("UPDATE users SET mdp = '$password' WHERE email = '$_POST[email]'");
    sleep(5);
    header('Location:connexion.php');
  }
  else{
    $errors_password['check_account'] = "Cet email n'existe pas";
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
  <title>HETIC Events-Hub - Réinitialisation mot de passe </title>
</head>
<body>
  <div class="classLogoFormConnexion">
    <a href="../index.php"><img src="../img/logo.svg" alt="Logo HEH"></a>
  </div>
  <div class="classContainerFormConnexion">
    <p class="classTextWelcomeFormConnexion">Réinitialisation du mot de passe</p>
    <?php if(isset($errors_password)){?>
      <?php if(isset($errors_password['check_account'])):?>
        <p style="color:red; margin-left:1em;"><?php echo $errors_password['check_account'];?></p>
      <?php endif;?>
      <?php if(isset($errors_password['length_password'])):?>
        <p style="color:red; margin-left:1em;"><?php echo $errors_password['length_password'];?></p>
      <?php endif;?>
      <?php if(isset($errors_password['match_password'])):?>
        <p style="color:red; margin-left:1em;"><?php echo $errors_password['match_password'];?></p>
      <?php endif;?>
      <form action="" method="post">
        <div class="itemConnexionform">
          <label for="email">Email<span style="color:red";>*</span></label>
          <input type="email" name="email" id="email" placeholder="Entrer votre email" autocomplete=off value="<?php echo htmlspecialchars($_POST['email']); ?>" >
          <?php if(isset($errors_password['email'])):?>
            <p style="color:red"><?php echo $errors_password['email'];?></p>
          <?php endif;?>
        </div>
        <div class="itemConnexionform">
          <label for="Nmdp">Nouveau mot de passe<span style="color:red";>*</span></label>
          <input type="password" name="Nmdp" id="Nmdp" placeholder="Entrer le nouveau mot de passe"  autocomplete=off value="<?php echo htmlspecialchars($_POST['Nmdp']); ?>">
          <?php if(isset($errors_password['Nmdp'])):?>
            <p style="color:red"><?php echo $errors_password['Nmdp'];?></p>
          <?php endif;?>
        </div>
        <div class="itemConnexionform">
          <label for="CNmdp">Confirmer nouveau Mot de passe<span style="color:red";>*</span></label>
          <input type="password" name="CNmdp" id="CNmdp" placeholder="Confirmer mot de passe"  autocomplete=off value="<?php echo htmlspecialchars($_POST['CNmdp']); ?>">
          <?php if(isset($errors_password['CNmdp'])):?>
            <p style="color:red"><?php echo $errors_password['CNmdp'];?></p>
          <?php endif;?>
        </div>
        <div class="itembtnsubmitConnexionform">
          <button type="submit">Valider</button>
        </div>
      </form>
    <?php }else{?>
      <form action="" method="post">
      <div class="itemConnexionform">
          <label for="email">Email<span style="color:red";>*</span></label>
          <input type="email" name="email" id="email" placeholder="Entrer votre email">
        </div>
        <div class="itemConnexionform">
          <label for="Nmdp">Nouveau mot de passe<span style="color:red";>*</span></label>
          <input type="password" name="Nmdp" id="Nmdp" placeholder="Entrer le nouveau mot de passe"  autocomplete=off>
        </div>
        <div class="itemConnexionform">
          <label for="CNmdp">Confirmer nouveau Mot de passe<span style="color:red";>*</span></label>
          <input type="password" name="CNmdp" id="CNmdp" placeholder="Confirmer mot de passe"  autocomplete=off>
        </div>
        <div class="itembtnsubmitConnexionform">
          <button type="submit">Valider</button>
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