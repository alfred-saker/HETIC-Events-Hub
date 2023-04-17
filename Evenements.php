<?php
include('config.php');

if(isset($_POST['btn-like'])){
  $likes_sql = $pdo->prepare("SELECT * FROM likes WHERE id_users = '$_POST[id_users]' AND id_events = '$_POST[id_events]' AND statut_likes = 'true'");
  $likes_sqls = $pdo->prepare("SELECT * FROM likes WHERE id_users = '$_POST[id_users]' AND id_events = '$_POST[id_events]' AND statut_likes = 'false'");
  $likes_sqls->execute();
  $likes_sql->execute();
  
  if($likes_sql->rowCount()>=1){
    $find = $pdo->prepare("UPDATE likes SET count_likes=count_likes-1,statut_likes='false' WHERE id_users = '$_POST[id_users]' AND id_events = '$_POST[id_events]'");
    $find->execute();
    header("Location: " . $_SERVER['PHP_SELF']);
  }
  elseif($likes_sqls->rowCount()>=1){
    $finds = $pdo->prepare("UPDATE likes SET count_likes=count_likes+1,statut_likes='true' WHERE id_users = '$_POST[id_users]' AND id_events = '$_POST[id_events]'");
    $finds->execute();
    $msg_like = "Merci pour votre like 😍";
    header("Refresh: 3; url=Evenements.php");
  }
  else{
    $like_sql = $pdo->prepare("INSERT INTO likes(id_users,count_likes,statut_likes,id_events) VALUES (:id_users,:count_likes,:statut_likes,:id_events)");
    $like_sql->execute(array(
      ':id_users' =>$_POST['id_users'],
      ':count_likes' =>1,
      ':statut_likes' =>'true',
      ':id_events' =>$_POST['id_events'],
    ));
    $msg_like = "Merci pour votre like 😍";
    header("Refresh: 3; url=Evenements.php");
  }
}
if (isset($_POST['btn-comment'])) {
  $heure = date('H:i:s');
  $comment_sql = $pdo->prepare("INSERT INTO commentaire(id_events,id_users,commentaire,date,heure) VALUES (:id_events,:id_users,:comment,:date_comment,:heure)");
  $comment_sql->execute(array(
    ':id_events' =>$_POST['id_event_comment'],
    ':id_users' =>$_POST['id_users_comment'],
    ':comment' =>$_POST['commentaire'],
    ':date_comment' =>date('Y/m/d'),
    ':heure'=>$heure
  ));
  // header("Refresh: 3; url=Evenements.php");
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
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
  <title>HETIC - Events Hub Creation évènements</title>
</head>

<body>
  <header>
    <img src="img/menu.png" alt="Menu burger" class="burger">
    <a class="logo" href="Evenements.php"><img src="img/logo1.svg" alt=""></a>
    <nav>
      <ul class="links">
        <li><a href="Evenements.php">Evenements</a></li>
        <li><a href="association_listing.php">Associations</a></li>
        <li><a href="espace_perso.php">Espace personnel</a></li>
      </ul>
      <ul class="deconnexion">
        <li><a href="?action=logout" class="logout">Deconnexion </a></li>
      </ul>
    </nav>
  </header>
  <?php if(isset($msg_like)):?>
    <p style="background-color: #14AE5C; color: #ffff; padding: 20px;text-align:center;"><?php echo $msg_like; ?></p>
  <?php endif;?>
  <?php
  $id = $_SESSION['user']['id_users'];
  $check = $pdo->prepare("SELECT * FROM users WHERE id_users= '$id' ");
  $check->execute();
  $check_result = $check->fetchAll();
  foreach ($check_result as $key) {
    if ($key['type'] == 'association') {
  ?>
      <div class="creat-event">
        <a href="create_events.php">Creér un event</a>
      </div>
    <?php } ?>
  <?php } ?>
  <div class="events">
    <?php
    $check_event = $pdo->prepare("SELECT events.id_events, events.id_users, events.titre_event, events.date_debut, events.date_fin, events.profile_event, events.lieu, events.description, users.id_users,users.profil, users.nom FROM events, users WHERE  events.id_users = users.id_users ORDER BY id_events DESC");
    $check_event->execute();
    $check_evenement = $check_event->fetchAll();
    foreach ($check_evenement as $check_events) {
    ?>
      <div class="event">
        <div class="autor-events">
          <img src="img/folder_profil_user/<?php echo $check_events['profil']; ?>" alt=" invitation">
          <h1 style="text-transform: uppercase;"><?php echo $check_events['nom']; ?></h1>
        </div>
        <div class="eventTittle">
          <div class="maps_time">
            <div>
              <img src="img/maps.svg" alt=""><span style="font-weight:bold;"><?php echo $check_events['lieu'];?></span>
            </div>
            <div>
              <img src="img/time.svg" alt=""><span style="font-weight:bold;">Du&nbsp;<?php echo $check_events['date_debut'];?>&nbsp; Au &nbsp;<span><?php echo $check_events['date_fin'];?></span>
            </div>
          </div>
          <h2><?php echo $check_events['titre_event']; ?></h2>
          <p><?php echo $check_events['description']; ?></p>
        </div>
        <div class="img-event">
          <img src="img/photo_events/<?php echo $check_events['profile_event']; ?>" alt="">
        </div>
        <div class="stat-event">
          <?php 
            $id = $_SESSION['user']['id_users'];
            $nbre_like = $pdo->prepare("SELECT SUM(count_likes) AS Nombre_likes FROM likes WHERE  id_events = '$check_events[id_events]' AND statut_likes = 'true'");
            $nbre_like->execute();
            $nbre_likes = $nbre_like->fetchAll();
            foreach ($nbre_likes as $count_nbre_likes) {
            ?>
          <div class="nbre_like" >
            <?php if($count_nbre_likes['Nombre_likes']>1){?>
            <p><?php echo $count_nbre_likes['Nombre_likes'];?> personnes aiment ça</p>
            <?php } elseif($count_nbre_likes['Nombre_likes']==0) {?>
              <p> 0 personne aime ça</p>
              <?php }else{?>
                <p><?php echo $count_nbre_likes['Nombre_likes'];?> personne aime ça</p>
              <?php }?>

          </div>
          <?php }?>
          <?php 
            $id = $_SESSION['user']['id_users'];
            $nbre_comment = $pdo->prepare("SELECT COUNT(id_commentaire) AS Nombre_comment FROM commentaire WHERE  id_events = '$check_events[id_events]'");
            $nbre_comment->execute();
            $nbre_comments = $nbre_comment->fetchAll();
            foreach ($nbre_comments as $count_nbre_comment) {
            ?>
          <div class="nbre_comment" >
            <?php if($count_nbre_comment['Nombre_comment']>1){?>
            <p id="nbre_comments" title="voir les commentaires"><?php echo $count_nbre_comment['Nombre_comment'];?> commentaires</p>
            <?php }elseif($count_nbre_comment['Nombre_comment']==0){?>
              <p id="nbre_comments" title="voir les commentaires">0 commentaire</p>
              <?php }else{?>
                <p id="nbre_comments" title="voir les commentaires"><?php echo $count_nbre_comment['Nombre_comment'];?> commentaire</p>
            <?php }?>
          </div>
          <?php }?>
        </div>
        <div class="icons-event">
          <div class="heart">
            
            <form action="" method="post">
              <input type="hidden" name="id_users" value="<?php echo $id;?>">
              <input type="hidden" name="id_events" value="<?php echo $check_events['id_events'] ?>">
              <input type="hidden" name="count_likes" value="0">
              <button type="submit" name="btn-like">
                <img src="img/heart.svg" alt="" id="coeur">
                <p>J'aime</p>
              </button>
            </form>
          </div>
          <div class="heart" id="logo_comment">
              <button>
                <img src="img/comment.svg" alt="">
                <p>Commenter</p>
              </button>
          </div>
          <div class="heart">
            <form action="#" method="post">
              <button type="submit">
                <img src="img/send.svg" alt="">
                <p>Envoyer</p>
              </button>
            </form>
          </div>
        </div>
        <div class="comment" id="div_input">
          <?php
            $id = $_SESSION['user']['id_users'];
            $check_profile = $pdo->prepare("SELECT * FROM users WHERE id_users='$id'");
            $check_profile->execute();
            $check_profiles = $check_profile->fetchAll();
            foreach($check_profiles as $list){
          ?>
          <div class="autor-comment">
            <?php if(!empty($list['profil'])){?>
            <img src="img/folder_profil_user/<?php echo $list['profil'];?>" alt="Profil invitation">
            <?php } else {?>
              <img src="img/user_avatar.png" alt="Profil invitation">
            <?php } ?>
          </div>
          
          <?php 
            $id_user = $_SESSION['user']['id_users'];
          ?>
          <form action="" method="post"  class="comment-forms">
            <input type="hidden" name="id_users_comment" value="<?php echo $id;?>">
            <input type="hidden" name="id_event_comment" value="<?php echo $check_events['id_events'];?>">
            <textarea class="comment-text" id="" cols="20" rows="10" id="input_comment" name="commentaire" required></textarea>
            <button type="submit" name="btn-comment" id="btn-comment-form">Commenter</button>
          </form>
        </div>
        <div class="space-comment" id="comment_events" style="display:block;">
          <?php 
            $id_user = $_SESSION['user']['id_users'];
            $query_comment =$pdo->prepare("SELECT commentaire.id_events, users.profil, commentaire.id_users, users.id_users, events.id_events,commentaire.commentaire FROM commentaire,events,users WHERE commentaire.id_events = events.id_events AND commentaire.id_users=users.id_users  AND commentaire.id_events ='$check_events[id_events]' ORDER BY commentaire.id_commentaire DESC ");
            $query_comment->execute();
            $query = $query_comment->fetchAll();
            foreach($query as $query_list){
          ?>
          <div>
            <img src="img/folder_profil_user/<?php echo $query_list['profil'];?>" alt="profil user">  
            <p><?php echo $query_list['commentaire'];?></p>
          </div>
          <?php }?>
        </div>
      <?php }?>
      </div>
    <?php } ?>
  </div>

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
  <script src="Js/scripts.js"></script>
  <script src="Js/events.js"></script>
  <script src="Js/chat.js"></script>
</body>

</html>