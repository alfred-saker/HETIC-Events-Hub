<?php
include('config.php');
if (!isset($_SESSION['user'])) {
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
  <link rel="stylesheet" href="Css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
  <title>HETIC Events Hub - Accueil</title>
</head>

<body>
  <header>
    <img src="img/menu.png" alt="Menu burger" class="burger" id="menu_Burger">
    <a class="logo" href="home.php"><img src="img/logo1.svg" alt="Logo"></a>
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
  <div class="WrapperHome">
  </div>
  <div class="tittle">
    <h1>Quelques associations</h1>
  </div>
  <div class="gallery">
    <div class="div1">
      <div class="association">
        <div class="item">
          <img src="img/Events.svg" alt="">
          <div class="texte">
            <h1>titre 6</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
          </div>
        </div>
        <div class="item">
          <img src="img/Events.svg" alt="">
          <div class="texte">
            <h1>titre 6</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
          </div>
        </div>
        <div class="item">
          <img src="img/Events.svg" alt="">
          <div class="texte">
            <h1>titre 6</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="btn">
    <a href="#">En savoir plus</a>
  </div>
  <section>
    <div class="type">
      <h1>Les associations</h1>
    </div>
    <div class="foto">
      <div class="divi">
        <?php   
          $sql = $pdo->prepare("SELECT * FROM users WHERE type = 'association'");
          $sql->execute();
          if($sql->rowCount()>0){
            $list = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($list as $listing) {
        ?>
        <div class="box">
          <div class="item1">
            <img src="img/events2.png" alt="">
            <div class="texte">
              <h1><?php echo $listing['nom'];?></h1>
              <p><?php echo $listing['description'];?></p>
            </div>
          </div>
        </div>
      </div>
      <?php }?>
      <?php }?>
    </div>
    <div class="btn">
      <a href="#">En savoir plus</a>
    </div>
  </section>
  <section>
    <div class="Commentaire">
      <h1>Commentaire</h1>
    </div>
    <div class="avis">
      <div class="contenaire">
        <div class="new">
          <div class="info">
            <img src="img/Vector.svg" alt="">
            <span>| Alfred kuate</span>
          </div>
          <div class="phrase">
            <h3>1 jour</h3>
            <p>L evenement etait super cool et j ai compris de nouvelle choses</p>
          </div>
        </div>
        <div class="new">
          <div class="info">
            <img src="img/Vector.svg" alt="">
            <span>| kameni kouleuko</span>
          </div>
          <div class="phrase">
            <h3>3 jour</h3>
            <p>L evenement etait super cool et j ai compris de nouvelle choses</p>
          </div>
        </div>
      </div>
    </div>
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
      <p>Copyright &copy;<?php echo date('Y'); ?> HEH-Site de centralisation de données</p>
    </div>
  </footer>
  <script src="Js/scripts.js"></script>
  <script src="Js/events.js"></script>
  <script src="Js/chat.js"></script>
</body>

</html>