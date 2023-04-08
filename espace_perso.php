<?php
include('config.php');
if(!isset($_SESSION['user'])){
  header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

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
  <title>HETIC - Events Hub Mon Espace personnel</title>
</head>

<body>
  <!-- header et menu -->
  <header>
    <img src="img/menu.png" alt="Menu burger" class="burger" id="menu_Burger">
    <a class="logo" href="home.php"><img src="img/logo1.svg" alt="Logo"></a>
    <nav>
      <ul class="links" id="menuLink">
        <li><a href="">Evenements</a></li>
        <li><a href="association_listing.php">Associations</a></li>
        <li><a href="espace_perso.php">Espace personnel</a></li>
      </ul>
      <ul class="deconnexion">
        <li><a href="?action=logout" class="logout">Deconnexion </a></li>
      </ul>
    </nav>
  </header>
  <h2 class="classTitleWelcome">Bienvenu dans votre Espace personnel, <?php echo $_SESSION['user']['prenom'];?>&nbsp;<?php echo $_SESSION['user']['nom'];?></h2>
  <?php
    $sql = $pdo->prepare("SELECT * FROM users WHERE id_users =:id_user AND type='association'");
    $sql->execute(array(
      ':id_user' => $_SESSION['user']['id_users']
    )); 
    if ($sql->rowCount() > 0){
  ?>
  <div class="classContainerEspacePerso">
    <a href="profil.php">
      <div class="classBlockProfil">
        <img src="img/avatar-user.svg" alt="Avatar user">
        <p class="classTextprofil">Mon Profil</p>
      </div>
    </a>
    <a href="E_evenement.php">
      <div class="classBlockProfil">
        <img src="img/event-calendar.svg" alt="Avatar user">
        <p class="classTextprofil">Mes Evenements</p>
      </div>
    </a>
  </div>
  <?php }else{?>
    <div class="classContainerEspacePerso">
    <a href="profil.php">
      <div class="classBlockProfil">
        <img src="img/avatar-user.svg" alt="Avatar user">
        <p class="classTextprofil">Mon Profil</p>
      </div>
    </a>
    <a href="E_evenement.php">
      <div class="classBlockProfil">
        <img src="img/event-calendar.svg" alt="Avatar user">
        <p class="classTextprofil">Mes Evenements</p>
      </div>
    </a>
    <a href="Abonnement_asso.php">
      <div class="classBlockProfil">
        <img src="img/check-subscribe.svg" alt="Avatar user">
        <p class="classTextprofil">Mes Associations</p>
      </div>
    </a>
    <a href="demandes.php">
      <div class="classBlockProfil">
        <img src="img/group.png" alt="Avatar user">
        <p class="classTextprofil">Mes demandes </p>
      </div>
    </a>
    <a href="chat.php">
      <div class="classBlockProfil">
        <img src="img/chat.svg" alt="Avatar user">
        <p class="classTextprofil">Ma Messagerie</p>
      </div>
    </a>
  </div>
  <?php } ?>

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