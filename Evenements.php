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
  <link rel="stylesheet" href="Css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
  <title>HETIC - Events Hub Creation évènements</title>
</head>

<body>
  <header>
    <img src="img/menu.png" alt="Menu burger" class="burger">
    <a class="logo" href=""><img src="img/logo1.svg" alt=""></a>
    <nav>
      <ul class="links">
        <li><a href="#">Evenements</a></li>
        <li><a href="association_listing.php">Associations</a></li>
        <li><a href="espace_perso.php">Espace personnel</a></li>
      </ul>
      <ul class="deconnexion">
        <li><a href="?action=logout" class="logout">Deconnexion </a></li>
      </ul>
    </nav>
  </header>

  <div class="tittle">
    <h1>LES EVENEMENTS</h1>
    <p>Quelques uns de nos evènements</p>
  </div>
  <?php 
  $id = $_SESSION['user']['id_users'];
  $check = $pdo->prepare("SELECT * FROM users WHERE id_users= '$id' ");
  $check->execute();
  $check_result = $check->fetchAll();
  foreach ($check_result as $key) {
    if($key['type']=='association'){
  ?> 
  <div class="sous-tittle">
    <a href="create_events.php" class="btn-creat">CREER UN EVENT</a>
  </div>
  <?php }?>
  <?php }?>

  <div class="events">
    <div class="event">
      <img src="img/Rectangle 64.svg" alt="">
      <h2>TITRE :</h2>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur praesentium beatae ad deserunt totam facere illum architecto reiciendis, quod, vel,</p>
    </div>

    <div class="event">
      <img src="img/Rectangle 64.svg" alt="">
      <h2>TITRE :</h2>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur praesentium beatae ad deserunt totam facere illum architecto reiciendis, quod, vel,</p>
    </div>
    <div class="event">
      <img src="img/Rectangle 64.svg" alt="">
      <h2>TITRE :</h2>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur praesentium beatae ad deserunt totam facere illum architecto reiciendis, quod, vel, </p>
    </div>
    <div class="event">
      <img src="img/Rectangle 64.svg" alt="">
      <h2>TITRE :</h2>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur praesentium beatae ad deserunt totam facere illum architecto reiciendis, quod, vel, </p>
    </div>
  </div>
</body>

<footer>
  <div class="containerFooter">
    <div class="classLogoFooter">
      <img src="img/HEH HETIC EVENTS HUB.png" alt="Logo Footer">
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

</html>