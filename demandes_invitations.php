<?php
include('config.php');
if (!isset($_SESSION['user'])) {
header('location:index.php');
}
if (isset($_POST['success'])) {
var_dump($_POST['id_destinataire']);
var_dump($_POST['id_emetteur']);
$sql = $pdo->prepare("UPDATE invitation SET statut_invitation =:statut WHERE id_user_destinataire = :id_destinataire AND id_user_emetteur = :id_emetteur ");
$sql->execute(array(
  ':statut' => 'Accepter',
  'id_emetteur' => $_POST['id_emetteur'],
  'id_destinataire' => $_POST['id_destinataire'],
));
echo 'Vous êtes maintenant amis';
header("Location: " . $_SERVER['PHP_SELF']);
}

if (isset($_POST['echec'])) {
$sql = $pdo->prepare("UPDATE invitation SET statut_invitation =:statut WHERE id_user_destinataire = :id_destinataire AND id_user_emetteur = :id_emetteur ");
$sql->execute(array(
  ':statut' => 'Refuser',
  'id_emetteur' => $_POST['id_emetteur'],
  'id_destinataire' => $_POST['id_destinataire'],
));
}
// if (isset($_POST['delete'])) {
// $sql = $pdo->prepare("UPDATE invitation SET statut_invitation =:statut WHERE id_user_destinataire = :id_destinataire AND id_user_emetteur = :id_emetteur ");
// $sql->execute(array(
//   ':statut' => 'Annuler',
//   'id_emetteur' => $_POST['id_emetteur'],
//   'id_destinataire' => $_POST['id_destinataire'],
// ));
// echo '<div style="background-color: #26E8A0; color: #ffff; padding: 10px;">Votre invitation a bien été annulée</div>';
// header("Location" . $_SERVER['PHP_SELF']);
// }
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
<title>HETIC - Events Hub Mon Espace personnel - Mes demandes</title>
</head>

<body>
<!-- header et menu -->
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
<div class="tittle-demande">
  <h1>VOS AMIS</h1>
</div>
<div class="containerdemande">
  <div class="demande-left">
    <h1>LISTE DES INVITATIONS ENVOYEES</h1>
    <?php
    $req_ask = $pdo->prepare("SELECT users.nom, users.prenom, users.promotion FROM users WHERE users.id_users IN(
      SELECT invitation.id_user_destinataire FROM invitation WHERE invitation.id_user_emetteur=:id_emetteur AND invitation.statut_invitation=:statut)");
    $req_ask->execute(array(
      ':id_emetteur' => $_SESSION['user']['id_users'],
      ':statut' => 'En attente'
    ));
    if ($req_ask->rowCount() > 0) {
      $results = $req_ask->fetchAll(PDO::FETCH_ASSOC);
      foreach ($results as $rows_lignes) {
    ?>
      <div class="row_demande">
        <div class="image_row">
          <img src="img/user_avatar.png" alt="Profil invitation">
        </div>
        <div class="info_row">
          <p><?php echo $rows_lignes['prenom']; ?>&nbsp;<?php echo $rows_lignes['nom']; ?></p>
          <p style="text-transform: capitalize;"><?php echo $rows_lignes['promotion']; ?></p>
          <form action="#" method="post">
            <input type="hidden" name="id_destinataire" value="<?php echo $_SESSION['user']['id_users']; ?>">
            <!-- <input type="hidden" name="id_emetteur" value="<?php echo $rows_lignes['id_user_emetteur']; ?>"> -->
            <button type="submit" name="delete" class="btn-rejet">Annuler invitation</button>
          </form>
        </div>
      </div>
      <?php } ?>
    <?php } else { ?>
      <h3 class="blockMsgAsso" style="width:80%;color:black;margin:0 auto;border-radius:10px;">Vous n'avez aucune d'ami pour le moment 😑</h3>
    <?php } ?>
  </div>
  <div class="demande-right">
    <h1>LISTE DES INVITATIONS RECUES</h1>
    <?php
    $req_ask = $pdo->prepare("SELECT users.id_users, invitation.id_user_destinataire, users.promotion,users.nom,users.prenom,users.profil,invitation.id_user_destinataire,invitation.id_user_emetteur, invitation.statut_invitation 
    FROM invitation, users 
    WHERE invitation.id_user_emetteur=users.id_users AND invitation.id_user_destinataire=:id_dest AND invitation.statut_invitation=:statut");
    $req_ask->execute(array(
      ':id_dest' => $_SESSION['user']['id_users'],
      ':statut' => 'En attente'
    ));
    if ($req_ask->rowCount() > 0) {
      $results = $req_ask->fetchAll(PDO::FETCH_ASSOC);
      foreach ($results as $rows_ligne) {
    ?>
        <div class="row_demande">
          <div class="image_row">
            <?php if (isset($rows_ligne['profil'])) { ?>
              <?php echo '<img src="img/folder_profil_user/' . $rows_ligne['profil'] . '" alt="Profil Invitation">'; ?>
            <?php } else { ?>
              <img src="img/user_avatar.png" alt="Profil invitation">
            <?php } ?>
          </div>
          <div class="info_row">
            <h3></h3>
            <p><?php echo $rows_ligne['prenom']; ?>&nbsp;<?php echo $rows_ligne['nom']; ?></p>
            <p style="text-transform: capitalize;"><?php echo $rows_ligne['promotion']; ?> </p>
            <form action="" method="POST">
              <input type="hidden" name="id_destinataire" value="<?php echo $_SESSION['user']['id_users']; ?>">
              <input type="hidden" name="id_emetteur" value="<?php echo $rows_ligne['id_user_emetteur']; ?>">
              <button type="submit" name="success" class="btn-succes">Confirmer</button>
              <button type="submit" name="echec" class="btn-rejet">Supprimer</button>
            </form>
          </div>
        </div>
      <?php } ?>
    <?php } else { ?>
      <h3 class="blockMsgAsso" style="width:80%;color:black;margin:0 auto;border-radius:10px;">Vous n'avez aucune invitation d'ami pour le moment 😑</h3>
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