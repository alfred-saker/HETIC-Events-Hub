<?php

include('config.php');
include('function.php');
// if(isset($_SESSION['user'])){
//   header('location:home.php');
// }
$date_update = date('Y-m-d:H:i:s');

if (isset($_FILES['photo'])) {

  $error_upload = array();

  $tmp_name = $_FILES['photo']['tmp_name'];

  $file_extension = strrchr($_FILES['photo']['type'], '/');
  $file_extension = str_replace('/', '.', $file_extension);

  $file_name = date("Ymd") . $_SESSION['user']['id_users'] . $file_extension;
  $max_size = 5000000;
  $file_size = filesize($tmp_name);

  $extensions_autorisees = array('.jpg', '.jpeg', '.png');
  $folder1 = "img/folder_profil_user/";
  $folder2 = "img/RemoveImage/";

  if (!in_array($file_extension, $extensions_autorisees)) {
    $msg = "mauvais type de fichier";
    $error_upload['check_type'] = $msg;
  }
  if ($file_size > $max_size) {
    $msg = "fichier trop volumineux";
    $error_upload['check_size'] = $msg;
  }

  if (file_exists($file_name))
    move_uploaded_file($tmp_name, $folder2 . $file_name);
  if (move_uploaded_file($tmp_name, $folder1 . $file_name)) {
    $pdo->exec("UPDATE users SET profil = '$file_name', date_update = '$date_update' WHERE id_users = '" . $_SESSION['user']['id_users'] . "' ");
    $msg = "Votre Photo a été ajouté";
    $error_upload['success_file'] = $msg;
  } else {
    $msg = "Ah.... Il semblerait que ça ne se passe pas comme prévu! Veuillez reessayer.";
    $error_upload['error_add_file'] = $msg;
  }
}

if (isset($_POST['info_perso'])) {
  $errors_update = array();

  if (isset($_POST['nom']) && empty($_POST['nom'])) {
    $errors_update['nom'] = 'Veuillez saisir votre nom';
  }
  if (isset($_POST['prenom']) && empty($_POST['prenom'])) {
    $errors_update['prenom'] = 'Veuillez saisir votre prenom';
  }
  if (isset($_POST['desc']) && empty($_POST['desc'])) {
    $errors_update['desc'] = 'Veuillez saisir votre description';
  }

  $nom = htmlspecialchars(trim($_POST['nom']));
  $prenom = htmlspecialchars(trim($_POST['prenom']));
  $desc = htmlspecialchars(trim($_POST['desc']));
  $pdo->exec("UPDATE users SET nom = '$nom', prenom = '$prenom', date_update = '$date_update', description = '$desc' WHERE id_users = '" . $_SESSION['user']['id_users'] . "'");

  sleep(5);
  $errors_update['success'] = "Vos informations ont été mis à jour avec succès!";
}

if (isset($_POST['connexion'])) {
  $errors_update_connexion = array();

  if (isset($_POST['email']) && empty($_POST['email'])) {
    $errors_update_connexion['email'] = 'Veuillez saisir votre email';
    if ($_SESSION['user']['type_account'] == 'etudiant') {
      if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors_update_connexion['email'] = "Cette adresse mail n'est pas valide";
      }
      if (!(checkEmail($_POST['email']))) {
        $errors_update_connexion['email'] = "Veuillez renseignez votre adresse mail HETIC";
      }
    }
  }
  if (isset($_POST['mdp']) && empty($_POST['mdp'])) {
    $errors_update_connexion['mdp'] = 'Veuillez saisir votre mot de passe';
    if ((strlen($_POST['mdp']) <= 10)) {
      $errors_update_connexion['mdp'] = "La longue du mot de passe ne doit pas être inférieure à 10 caractères!!";
    }
  }
  // $is_exist = false;
  if (empty($errors_update_connexion['email']) && empty($errors_update_connexion['mdp'])) {
    // $is_exist = false;
    $password_update = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    $email = htmlspecialchars(trim($_POST['email']));
    $pdo->exec("UPDATE users SET email = '$email', mdp = '$password_update', date_update = '$date_update' WHERE id_users = '" . $_SESSION['user']['id_users'] . "'");
    $errors_update_connexion['success'] = "Vos identifiants ont été mis à jour avec succès!";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Css/reset.css">
  <link rel="stylesheet" href="Css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
  <title>HETIC - Events Hub Mon Espace personnel - Mon profil</title>
</head>

<body>
  <header>
    <img src="img/menu.png" alt="Menu burger" class="burger" id="menu_Burger">
    <a class="logo" href="home.php"><img src="img/logo1.svg" alt="Logo"></a>
    <nav>
      <ul class="links" id="menuLink">
        <li><a href="#">Evenements</a></li>
        <li><a href="association_listing.php">Associations</a></li>
        <li><a href="espace_perso.php">Espace personnel</a></li>
      </ul>
      <ul class="deconnexion">
        <li><a href="?action=logout" class="logout">Deconnexion </a></li>
      </ul>
    </nav>
  </header>
  <section class="classContainerDisplayProfil">
    <div class="classBlockInfosProfil">
      <?php
      $id = $_SESSION['user']['id_users'];

      $req = $pdo->query("SELECT profil FROM users WHERE id_users = '$id'");
      while ($data = $req->fetch()) { ?>
        <div class="classAvatarProfil">
          <?php if (!empty($data['profil'])) { ?>
            <?php
            echo ('<a href="#"><img src="img/folder_profil_user/' . $data['profil'] . '" alt="Photo de Profil"></a>');
            ?>
          <?php } else { ?>
            <img src="img/user_avatar.png" alt="Photo de Profil">
          <?php } ?>
        </div>
      <?php } ?>
      <div>
        <p>
          Nom: <strong><?php echo $_SESSION['user']['nom'] ?></strong>
          <?php if (isset($_SESSION['user']['prenom'])) : ?>
            <?php echo $_SESSION['user']['prenom']; ?>
          <?php endif; ?>
        </p>
        <p>
          Email: <?php echo $_SESSION['user']['email']; ?>
        </p>
        <p>
          Date Inscription: <?php echo $_SESSION['user']['date_creation'] ?>
        </p>
        <p>
          Type de compte: <?php echo $_SESSION['user']['type_account']; ?>
        </p>
        <p>
          Date Dernière modification: <?php echo $_SESSION['user']['date_update']; ?>
        </p>
      </div>
      <button class="classBtnUpdateInfosProfil" id="btn_display">Modifier</button>
      <button class="classBtnUpdateInfosProfil" id="btn_display">Modifier</button>
    </div>
    <section class="classContainerUpdateProfil" id="UpdateProfil">
      <div class="BlockLamda">
        <fieldset class="fielset1">
          <legend>Mes Informations Personnelles</legend>
          <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
            <div class="itemUpdateform">
              <div>
                <img id="preview" src="" alt="Aperçu de l'image">
              </div>
              <?php if (isset($error_upload)) : ?>
                <?php if (isset($error_upload['check_type'])) : ?>
                  <p style="color:red;margin-bottom:1em;"><?php echo $error_upload['check_type']; ?></p>
                <?php endif; ?>
                <?php if (isset($error_upload['check_size'])) : ?>
                  <p style="color:red;margin-bottom:1em;"><?php echo $error_upload['check_size']; ?></p>
                <?php endif; ?>
                <?php if (isset($error_upload['success_file'])) : ?>
                  <p style="color:green;margin-bottom:1em;"><?php echo $error_upload['success_file']; ?></p>
                <?php endif; ?>
                <?php if (isset($error_upload['error_add_file'])) : ?>
                  <p style="color:red;margin-bottom:1em;"><?php echo $error_upload['error_add_file']; ?></p>
                <?php endif; ?>
              <?php endif; ?>
              <div class="itembtnsubmitUpdateform">
                <input type="file" id="image" accept="image/*" name="photo">
                <button type="submit">Mettre à jour</button>
              </div>
            </div>
          </form>
          <form action="" method="post">
            <?php if (isset($errors_update['success'])) : ?>
              <p style="color:green;"><?php echo $errors_update['success']; ?></p>
            <?php endif; ?>

            <div class="itemUpdateform">
              <label for="nom">Nom</label>
              <input type="text" name="nom" id="nom" autocomplete=off placeholder="Saisissez votre nom">
              <?php if (isset($errors_update['nom'])) : ?>
                <p style="color:red;"><?php echo $errors_update['nom']; ?></p>
              <?php endif; ?>
            </div>
            <?php if (!empty($_SESSION['user']['prenom'])) { ?>
              <div class="itemUpdateform">
                <label for="prenom">Prenom</label>
                <input type="text" name="prenom" id="prenom" placeholder="Saisissez votre nom" autocomplete=off>
              </div>
            <?php } else { ?>
              <div class="itemUpdateform" style="display:none;">
                <label for="prenom">Prenom</label>
                <input type="text" name="prenom" id="prenom" placeholder="Saisissez votre prenom" autocomplete=off>
              </div>
            <?php } ?>
            <?php if ($_SESSION['user']['type_account'] == 'etudiant') { ?>
              <div class="itemUpdateform" style="display:none;">
                <label for="desc">Description</label>
                <textarea name="desc" id="description" placeholder="Saisissez votre description......" cols="30" rows="10"></textarea>
              </div>
            <?php } else { ?>
              <div class="itemUpdateform">
                <label for="desc">Description</label>
                <textarea name="desc" id="description" placeholder="Saisissez votre description......" cols="30" rows="10"></textarea>
                <?php if (isset($errors_update['desc'])) : ?>
                  <p style="color:red;"><?php echo $errors_update['desc']; ?></p>
                <?php endif; ?>
              </div>
            <?php } ?>
            <div class="itembtnsubmitUpdateform">
              <button type="submit" name="info_perso">Mettre à jour</button>
            </div>
          </form>
        </fieldset>
        <?php if (isset($errors_update_connexion)) { ?>
          <fieldset class="fielset2">
            <legend>Mes Identifiants</legend>
            <form action="" method="post">
              <?php if (isset($errors_update_connexion['success'])) : ?>
                <p style="color:green;"><?php echo $errors_update_connexion['success']; ?></p>
              <?php endif; ?>
              <?php if (isset($errors_exist)) : ?>
                <p style="color:red;"><?php echo $errors_exist; ?></p>
              <?php endif; ?>
              <div class="itemUpdateform">
                <label for="nom">Email</label>
                <input type="email" name="email" id="email" autocomplete=off placeholder="Saisissez votre email" value="<?php echo htmlspecialchars($_POST['email']) ?>">
                <?php if (isset($errors_update_connexion['email'])) : ?>
                  <p style="color:red;"><?php echo $errors_update_connexion['email']; ?></p>
                <?php endif; ?>
              </div>
              <div class="itemUpdateform">
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" autocomplete=off placeholder="Saisissez votre mot de passe">
                <?php if (isset($errors_update_connexion['mdp'])) : ?>
                  <p style="color:red;"><?php echo $errors_update_connexion['mdp']; ?></p>
                <?php endif; ?>
              </div>
              <div class="itembtnsubmitUpdateform">
                <button type="submit" name="connexion">Mettre à jour</button>
              </div>
            </form>
          </fieldset>
        <?php } else { ?>
          <fieldset class="fielset2">
            <form action="" method="post">
              <legend>Mes Identifiants</legend> <br>
              <div class="itemUpdateform">
                <label for="nom">Email</label>
                <input type="email" name="email" id="email" autocomplete=off placeholder="Saisissez votre email">
              </div>
              <div class="itemUpdateform">
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" autocomplete=off placeholder="Saisissez votre mot de passe">
              </div>
              <div class="itembtnsubmitUpdateform">
                <button type="submit" name="connexion">Mettre à jour</button>
              </div>
            </form>
          </fieldset>
        <?php } ?>
    </section>
  </section>
  <footer>
    <div class="containerFooter">
      <div class="classLogoFooter">
        <img src="img/logo.svg" alt="Logo Footer">
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
      <p>Copyright &copy;<?= date('Y'); ?> HEH-Site de centralisation de données</p>
    </div>
  </footer>
  <script src="Js/scripts.js"></script>
</body>

</html>