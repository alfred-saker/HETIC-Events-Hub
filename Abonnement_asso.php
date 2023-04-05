<?php
include('config.php');
if(!isset($_SESSION['user'])){
  header('location:index.php');
}
if($_POST){

  $data_id = array(
    'id_asso'=>$_POST['id_association'],
    'id_etu'=>$_SESSION['user']['id_users']
  );
  $reqt = $pdo->exec("UPDATE abonnement SET abonnement.status = '0' WHERE abonnement.id_asso = '$data_id[id_asso]' AND abonnement.id_etudiant = '$data_id[id_etu]'");
  echo '<div style="background-color: #26E8A0; color: #ffff; padding: 10px;">Désabonnement reussie!</div>';
  header("Location: " . $_SERVER['PHP_SELF']);
  exit();
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
  <title>HETIC - Events Hub Mon Espace personnel</title>
</head>

<body>
  <!-- header et menu -->
  <header>
    <img src="img/menu.png" alt="Menu burger" class="burger" id="menu_Burger">
    <a class="logo" href="home.php"><img src="img/logo1.svg" alt="Logo"></a>
    <nav>
      <ul class="links" id="menuLink">
        <li><a href="#">Evenements</a></li>
        <li><a href="association_listing.php">Associations</a></li>
        <li><a href="espace_perso.php">Espace personnel</a></li>
      </ul>
      <ul class="deconnexion">
        <li><a href="?action=logout" class="logout">Deconnexion </a></li>
      </ul>
    </nav>
  </header>

  <div class="classContainerAbonnement_asso">
    <?php 
       $requete = $pdo->prepare("
       SELECT users.nom,users.profil, users.id_users, abonnement.id_asso, abonnement.id_etudiant , abonnement.date_abonnement,abonnement.status
       FROM abonnement 
       INNER JOIN users ON abonnement.id_asso = users.id_users 
       WHERE abonnement.id_etudiant = :id_etudiant AND abonnement.status = '1'
     ");
     $requete->execute(array(
       ':id_etudiant' => $_SESSION['user']['id_users']
     ));
     if ($requete->rowCount() > 0){
      $results = $requete->fetchAll(PDO::FETCH_ASSOC);
      foreach ($results as $result) {
    ?>
     <div class="itemListAsso">
      <div class="itemBlockImgAsso">
        <?php if(isset($result['profil'])){?>
        <?php echo '<img src="img/folder_profil_user/'.$result['profil'].'" alt="Icon">';?>
        <?php }else{?>
        <img src="img/association.png" alt="Icon">
        <?php }?>
      </div>
      <div class="ItemBlockTextAsso">
        <h2><?php echo $result['nom'];?></h2>
        <p>
          Vous êtes bonné(e) à <?php echo $result['nom'];?> depuis le <?php echo $result['date_abonnement'];?>
        </p>
        <form action="" method="post" class="form-abonnement">
          <input type="hidden" value="<?php echo $result['id_asso'];?>" name="id_association">
          <input type="hidden" value="<?php echo $result['id_etudiant'];?>" name="id_etudiant">
          <?php if($_SESSION['user']['type'] == 'etudiant'){?>
            <button class="sub" type="submit">Se desabonner</button>
          <?php }else{?>
            <button class="sub" style="display:none;" type="submit">S'abonner</button>
          <?php }?>
        </form>
      </div>
    </div>
    <?php }?>
    <?php }else{?>
      <h3 class="blockMsgAsso" style="color:black;">Vous n'êtes abonné(e) à aucune association pour le moment 😥 Retrouvez toutes nos associations <a href="association_listing.php"><strong> ici</strong></a> </h3>
    <?php }?>
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
</body>

</html>