<?php
include('config.php');
if(!isset($_SESSION['user'])){
  header('location:index.php');
}
?>


<!DOCTYPE html>
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
  <title>HETIC - Events Hub Mon Espace personnel</title>
</head>

<body>
  <!-- header et menu -->
  <header>
    <img src="img/menu.png" alt="Menu burger" class="burger" id="menu_Burger">
    <a class="logo" href="Evenements.php"><img src="img/logo1.svg" alt="Logo"></a>
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

  
  <h2 class="classTitleWelcome">Recapitulatif de vos évènements</h2>
  <div class="classContainerEvenement">
    <?php
    $req1 = $pdo->prepare("SELECT * FROM events WHERE id_users")
     ?>
    <div class="classBlockEvenement">
      <div class="classImageEvenement">
        <img src="img/association.png" alt="Image Association">
      </div>
      <div>
        <p>Nom de l'Evenement:</p>
        <p>Periode:</p>
        <p>Lieu:</p>
        <p><a href="#" style="background-color:brown;">Terminer</a></p>
      </div>
    </div>
    <div class="classBlockEvenement">
      <div class="classImageEvenement">
        <img src="img/association.png" alt="Image Association">
      </div>
      <div>
        <p>Nom de l'Evenement:</p>
        <p>Periode:</p>
        <p>Lieu:</p>
        <p><a href="#" style="background-color:#B3B3B3;">Pas commencé</a></p>
      </div>
    </div>
    <div class="classBlockEvenement">
      <div class="classImageEvenement">
        <img src="img/association.png" alt="Image Association">
      </div>
      <div>
        <p>Nom de l'Evenement:</p>
        <p>Periode:</p>
        <p>Lieu:</p>
        <p><a href="#" style="background-color:#14AE5C;">En cours</a></p>
      </div>
    </div>
    <div class="classBlockEvenement">
      <div class="classImageEvenement">
        <img src="img/association.png" alt="Image Association">
      </div>
      <div>
        <p>Nom de l'Evenement:</p>
        <p>Periode:</p>
        <p>Lieu:</p>
        <p><a href="#" style="background-color:brown;">Terminer</a></p>
      </div>
    </div>
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
      <p>Copyright &copy;<?= date('Y'); ?> HEH-Site de centralisation de données</p>
    </div>
  </footer>
  <script src="Js/scripts.js"></script>
<script src="Js/events.js"></script>
<script src="Js/chat.js"></script>
</body>

</html>