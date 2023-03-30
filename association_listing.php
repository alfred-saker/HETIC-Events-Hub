<?php
include('config.php');

if(isset($_GET['action']) && ($_GET['action'] == 'is_abonne')){
  // $id = $data['id_users'];
  var_dump($_SESSION['user']['nom']);
  echo 'hello xord';
}
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
    <a class="logo" href=""><img src="img/logo1.svg" alt=""></a>
    <nav>
      <ul class="links" id="menuLink">
        <li><a href="#">Evenements</a></li>
        <li><a href="#">Associations</a></li>
        <li><a href="espace_perso.php">Espace personnel</a></li>
      </ul>
      <ul class="deconnexion">
        <li><a href="#" class="logout">Deconnexion </a></li>
      </ul>
    </nav>
  </header>
  <div class="titre">
    <h1 class="titre-asso">Associations</h1>
    <p>Toutes nos association d'HETIC!</p>
  </div>
  <div class="containerListAsso">
    <?php 
    $req = $pdo->query("SELECT * FROM users WHERE type = 'association'");
    while ($data = $req->fetch()) { ?>
    <div class="itemListAsso">
      <div class="itemBlockImgAsso">
        <?php if(isset($data['profil'])){?>
        <?php echo '<img src="img/folder_profil_user/'.$data['profil'].'" alt="Icon">';?>
        <?php }else{?>
        <img src="img/association.png" alt="Icon">
        <?php }?>
      </div>
      <div class="ItemBlockTextAsso">
        <h2><?php echo $data['nom'];?></h2>
        <p><?php echo $data['description'];?></p>
        <a href="?is_abonner=true" class="sub" id="suscribe">S'abonner</a>
      </div>
    </div>
    <?php }?>
  </div>
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
</body>

</html>