<?php
include('config.php');
if(!isset($_SESSION['user'])){
  header('location:index.php');
}

if ($_POST) {
  $id_emetteur = $_SESSION['user']['id_users'];
  $name = $_SESSION['user']['nom'];
  $error_search =array();
  if (empty($error_search)) {
    $search_sql = $pdo->prepare("SELECT * FROM users WHERE nom IN('$_POST[search]') OR prenom IN('$_POST[search]') AND nom != '$name' AND type='etudiant'");
    $search_sql->execute();
    if ($search_sql->rowCount() > 0) {
      $resul = $search_sql->fetchAll(PDO::FETCH_ASSOC);
      foreach ($resul as $rows_result) {
        $id_destinataire = $rows_result['id_users'];
        // echo $rows_result['id_users'];
        $error_search['display_result'] = '<input type="hidden" name="id_destinataire" value="'.$id_destinataire.'" /><p>'.$rows_result['nom'].'&nbsp;'.$rows_result['prenom'].'</p>';
      }
      header("Location" . $_SERVER['PHP_SELF']);
    } else {
      $error_search['echec_result']=' <div class="search-down" id="div_display">
      <div class="infos_search" style="margin:5em auto;">
        <img src="img/trouver.png" alt="icone not found" style="width:10%;">
        <p>Aucun resultat ne correspond à votre recherche</p>
      </div>
    </div>';
    header("Location" . $_SERVER['PHP_SELF']);
    }
  }
}
if(isset($_POST['invitation_form'])){
  $msg_send = "";
  $id_dest = $_POST['id_destinataire'];
  $id_emet = $_POST['id_emetteur'];

  $req_sql = $pdo->prepare("INSERT INTO invitation (id_user_emetteur,id_user_destinataire,statut_invitation) VALUES (:id_emetteur,:id_destinataire,:statut)");
  $req_sql->execute(array(
    ':id_emetteur'=>$id_emet,
    ':id_destinataire'=>$id_dest,
    ':statut'=>'En attente'
  ));
  $msg_send .="Votre invitation a bien été envoyé!"; 
  header("Refresh: 3; url=chat_contact.php");
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
      <li><a href="Evenements.php">Evenements</a></li>
      <li><a href="association_listing.php">Associations</a></li>
      <li><a href="espace_perso.php">Espace personnel</a></li>
    </ul>
    <ul class="deconnexion">
      <li><a href="?action=logout" class="logout">Deconnexion </a></li>
    </ul>
  </nav>
</header>
<?php if(isset($msg_send)):?>
  <div class="generate-error">
    <p style="background-color: #14AE5C; color: #ffff; padding: 20px;text-align:center;"><?php echo $msg_send; ?></p>
  </div>
<?php endif;?>
<div class="container-chat">
  <?php if (isset($error_search)) { ?>
    <div class="chat-left">
      <form action="" method="POST">
        <div class="search-container">
          <input type="search" placeholder="Rechercher un contact...." name="search" autocomplete="off" id="search_input">
          <button type="submit">Search<i class="fa fa-search"></i></button>
        </div>
      </form>
      <?php if(isset($error_search['display_result'])):?>
        <div class="search-down" id="div_display">
          <form action="" method="POST">
            <input type="hidden" name="id_emetteur" value="<?php echo $_SESSION['user']['id_users'];?>"/>
            <div class="infos_search">
              <?php echo $error_search['display_result']; ?>
              <p><button type="submit" name="invitation_form" class="btn-search">Envoyez une invitation</button></p>
            </div>
          </form>
        </div>
      <?php endif;?>
      <?php if(isset($error_search['echec_result'])):?>
        <?php echo $error_search['echec_result']; ?>
      <?php endif;?>
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
          <a href="messagerie.php">messagerie</a>
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
<script src="Js/events.js"></script>
<script src="Js/chat.js"></script>
</body>

</html>