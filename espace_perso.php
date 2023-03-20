
<?php 
include('config.php');
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

  <h1>Mon Espace personnel</h1>
  <h2>Bienvenu dans votre Espace personnel <?php echo $_SESSION['user']['nom'];?></h2>
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
    <a href="#">
      <div class="classBlockProfil">
        <img src="img/chat.svg" alt="Avatar user">
        <p class="classTextprofil">Ma Messagerie</p>
      </div>
    </a>
    <a href="?action=logout">
      <div class="classBlockProfil">
        <img src="img/logout.svg" alt="Avatar user">
        <p class="classTextprofil">Deconnexion</p>
      </div>
    </a>
  </div>

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
      <p>Copyright &copy;<?= date('Y');?> HEH-Site de centralisation de données</p>
    </div>
  </footer>
</body>
</html>