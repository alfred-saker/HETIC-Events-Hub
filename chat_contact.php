<?php
include('config.php');
if(!isset($_SESSION['user'])){
  header('location:index.php');
}

if ($_POST) {
  $error_search = '';
  if (empty($eror_search)) {
    $search_sql = $pdo->prepare("SELECT * FROM users WHERE nom IN('$_POST[search]') OR prenom IN('$_POST[search]') AND type='etudiant'");
    $search_sql->execute();
    if ($search_sql->rowCount() > 0) {
      $resul = $search_sql->fetchAll(PDO::FETCH_ASSOC);
      foreach ($resul as $rows_result) {
        $error_search .= ' <div class="search-down" id="div_display">
            <div class="infos_search">
              <p>'.$rows_result['nom'].'&nbsp;'.$rows_result['prenom'].'</p>
              <p><button type="submit" class="btn-search">Envoyez un message</button></p>
            </div>
          </div>';
      }
      header("Location" . $_SERVER['PHP_SELF']);
    } else {
      $error_search .=' <div class="search-down" id="div_display">
      <div class="infos_search" style="margin:5em auto;">
        <p>Aucun resultat ne correspond à votre recherche</p>
      </div>
    </div>';
    header("Location" . $_SERVER['PHP_SELF']);
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="Css/reset.css">
<link rel="stylesheet" href="Css/chat.css">
<link rel="stylesheet" href="Css/style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
<title>HETIC - Events Hub Mon Espace personnel - chat contact</title>
</head>

<body>
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
<div class="container-chat">
  <?php if (isset($error_search)) { ?>
    <div class="chat-left">
      <form action="" method="POST">
        <div class="search-container">
          <input type="search" placeholder="Rechercher un contact...." name="search" autocomplete="off" id="search_input" value="<?php echo htmlspecialchars($_POST['search']);?>">
          <button type="submit">Search<i class="fa fa-search"></i></button>
        </div>
        <?php if($error_search):?>
          <?php echo $error_search; ?>
        <?php endif;?>
      </form>
    </div>
  <?php } else { ?>
    <div class="chat-left">
      <form action="" method="POST">
        <div class="search-container">
          <input type="search" placeholder="Rechercher un contact...." name="search" autocomplete="off" id="search_input">
          <button type="submit">Search<i class="fa fa-search"></i></button>
        </div>
      </form>
    </div>
  <?php } ?>
  <div class="chat-right">
    <?php
    $req_chat = $pdo->prepare("SELECT users.nom, users.prenom, users.promotion FROM users WHERE users.id_users IN(
      SELECT invitation.id_user_destinataire FROM invitation WHERE invitation.id_user_emetteur=:id_emetteur AND invitation.statut_invitation=:statut)");
    $req_chat->execute(array(
      ':id_emetteur' => $_SESSION['user']['id_users'],
      ':statut' => 'Accepter'
    ));
    if ($req_chat->rowCount() > 0) {
      $results = $req_chat->fetchAll(PDO::FETCH_ASSOC);
      foreach ($results as $rows_result) {
    ?>
      <div class="row_demandes">
        <div class="image_rows">
          <img src="img/user_avatar.png" alt="Profil invitation">
        </div>
        <div class="info_rows">
          <h3><?php echo $rows_result['nom']; ?>&nbsp;<?php echo $rows_result['prenom']; ?></h3>
          <form>
            <button type="submit" name="echec" class="btn-rejets">Envoyez un message</button>
          </form>
        </div>
      </div>
      <?php } ?>
    <?php } else { ?>
      <h3 class="blockMsgAsso1">Vous n'avez aucun contact pour le moment</h3>
    <?php } ?>
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
<script src="Js/chat.js"></script>
</body>

</html>