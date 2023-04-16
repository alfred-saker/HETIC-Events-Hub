<?php
include('config.php');

if (!isset($_SESSION['user'])) {
  header('location:index.php');
}

if ($_POST) {

  $error_abonne = array();

  $user_id_asso = $_POST['id_user_asso'];
  $user_id_etu = $_POST['id_user_etudiant'];
  $date = date("Y-m-d");

  $check = $pdo->query("SELECT * FROM abonnement WHERE abonnement.id_asso = '$user_id_asso' AND abonnement.id_etudiant = '$user_id_etu' AND abonnement.status = '0' ");

  $chef_if_abonne = $pdo->query("SELECT * FROM abonnement WHERE abonnement.id_asso = '$user_id_asso' AND abonnement.id_etudiant = '$user_id_etu' AND abonnement.status = '1'");

  if ($check->rowCount() >= 1) {
    $pdo->exec("UPDATE abonnement SET abonnement.status = '1' WHERE abonnement.id_asso = '$user_id_asso' AND abonnement.id_etudiant = '$user_id_etu'");
    $error_abonne['reabonne'] = "Votre Abonnement à été mis à jour";
    // echo '<div style="background-color: #26E8A0; color: #ffff; padding: 10px;">Votre Abonnement à été mis à jour</div>';
  }
  if ($chef_if_abonne->rowCount() >= 1) {
    $error_abonne['already_abonne'] = "Vous êtes deja abonné(e) à cette association";
    // echo '<div style="background-color: #26E8A0; color: #ffff; padding: 10px;">Vous êtes deja abonné(e) à cette association!</div>';

  }
  if (empty($error_abonne)) {
    $pdo->exec("INSERT INTO abonnement (id_asso, id_etudiant,  status,date_abonnement) VALUES ('$user_id_asso', '$user_id_etu', '1','$date')");
    $error_abonne['success'] = "Abonnement reussi";
    // echo '<div style="background-color: #26E8A0; color: #ffff; padding: 10px;">Abonnement reussi!</div>';
  }
  header("Refresh: 3; url=association_listing.php");
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
  <title>HETIC - Events Hub Associations</title>
</head>

<body>
  <header>
    <img src="img/menu.png" alt="Menu burger" class="burger" id="menu_Burger">
    <a class="logo" href="home.php"><img src="img/logo1.svg" alt=""></a>
    <nav>
      <ul class="links" id="menuLink">
        <li><a href="Evenements.php">Evenements</a></li>
        <li><a href="association_listing.php">Associations</a></li>
        <li><a href="espace_perso.php">Espace personnel</a></li>
      </ul>
      <ul class="deconnexion">
        <li><a href="?action=logout" class="logout">Deconnexion </a></li>
      </ul>
    </nav>
  </header>
  <div class="titre">
    <h1 class="titre-asso">Associations</h1>
    <p>Toutes nos association d'HETIC!</p>
  </div>
  <?php if (isset($error_abonne)) { ?>
    <?php if (isset($error_abonne['success'])) : ?>
      <div class="generate-error">
        <p style="background-color: #14AE5C; color: #ffff; padding: 20px; text-align:center;"><?php echo $error_abonne['success']; ?></p>
      </div>
    <?php endif; ?>
    <?php if (isset($error_abonne['reabonne'])) : ?>
      <div class="generate-error">
        <p style="background-color: #14AE5C; color: #ffff; padding: 20px;text-align:center;"><?php echo $error_abonne['reabonne']; ?></p>
      </div>
    <?php endif; ?>
    <?php if (isset($error_abonne['already_abonne'])) : ?>
      <div class="generate-error">
        <p style="background-color: red; color: #ffff; padding: 20px;text-align:center;"><?php echo $error_abonne['already_abonne']; ?></p>
      </div>
    <?php endif; ?>
    <div class="containerListAsso">
      <?php
      $req = $pdo->query("SELECT * FROM users WHERE type = 'association'");
      while ($data = $req->fetch()) {
      ?>
        <div class="itemListAsso">
          <div class="itemBlockImgAsso">
            <?php if (isset($data['profil'])) { ?>
              <?php echo '<img src="img/folder_profil_user/' . $data['profil'] . '" alt="Icon">'; ?>
            <?php } else { ?>
              <img src="img/association.png" alt="Icon">
            <?php } ?>
          </div>
          <div class="ItemBlockTextAsso">
            <h2><?php echo $data['nom']; ?></h2>
            <p><?php echo $data['description']; ?></p>
            <form action="" method="post" class="form-abonnement">
              <input type="hidden" value="<?php echo $data['id_users']; ?>" name="id_user_asso">
              <input type="hidden" value="<?php echo $_SESSION['user']['id_users']; ?>" name="id_user_etudiant">
              <?php if ($_SESSION['user']['type'] == 'etudiant') { ?>
                <button class="sub" type="submit">S'abonner</button>
              <?php } else { ?>
                <button class="sub" style="display:none;" type="submit">S'abonner</button>
              <?php } ?>
            </form>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } else { ?>
    <div class="containerListAsso">
      <?php
      $req = $pdo->query("SELECT * FROM users WHERE type = 'association'");
      while ($data = $req->fetch()) {
      ?>
        <div class="itemListAsso">
          <div class="itemBlockImgAsso">
            <?php if (isset($data['profil'])) { ?>
              <?php echo '<img src="img/folder_profil_user/' . $data['profil'] . '" alt="Icon">'; ?>
            <?php } else { ?>
              <img src="img/association.png" alt="Icon">
            <?php } ?>
          </div>
          <?php if (isset($error_abonne['success']) || isset($error_abonne['success1'])) : ?>

          <?php endif; ?>
          <div class="ItemBlockTextAsso">
            <h2><?php echo $data['nom']; ?></h2>
            <p><?php echo $data['description']; ?></p>
            <form action="" method="post" class="form-abonnement">
              <input type="hidden" value="<?php echo $data['id_users']; ?>" name="id_user_asso">
              <input type="hidden" value="<?php echo $_SESSION['user']['id_users']; ?>" name="id_user_etudiant">
              <?php if ($_SESSION['user']['type'] == 'etudiant') { ?>
                <button class="sub" type="submit">S'abonner</button>
              <?php } else { ?>
                <button class="sub" style="display:none;" type="submit">S'abonner</button>
              <?php } ?>
            </form>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } ?>
  <footer>
    <div class="containerFooter">
      <div class="classLogoFooter">
        <a href="../index.php"><img src="img/HEH HETIC EVENTS HUB.png" alt="Logo"></a>
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
  <script src="Js/events.js"></script>
  <script src="Js/chat.js"></script>
</body>

</html>