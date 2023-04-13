<?php
include("config.php");

if ($_POST) {
  $errors_events = array();


  if (isset($_FILES['picture']) && $_FILES['picture']['error'] == UPLOAD_ERR_NO_FILE) {
    $errors_events['image'] = "Veuillez selectionner une image";
  } else {
    $tmp_name = $_FILES['picture']['tmp_name'];

    $files_extensions = strrchr($_FILES['picture']['type'], '/');
    $files_extensions = str_replace('/', '.', $files_extensions);

    $files_name = date("Ymdh") . $files_extensions;
    $max_size = 500000;
    $files_size = filesize($tmp_name);

    $extensions_autorisees = array('.jpg', '.png', '.jpeg');
    $dossier = "img/photo_events/";

    if (!in_array($files_extensions, $extensions_autorisees)) {
      $errors_events['image'] = 'Ce type de fichier n\'est pas autorisé';
    }
    if ($files_size > $max_size) {
      $errors_events['image'] = "Le fichier est trop volumineux";
    }
    if (empty($_FILES['picture']['error'])) {
      move_uploaded_file($tmp_name, $dossier . $files_name);
    }
  }

  if (empty($errors_events)) {
    $requete = $pdo->prepare(" UPDATE events  SET id_events = '$_POST[id_events]', id_users = '$_SESSION[user][id_users]' , titres_events ='$_POST[titre_events]',lieu =' $_POST[lieu]', description = '$_POST[description]', profil ='$files_name', date_debut = '$_POST[date_debut]', date_fin = '$_POST[date_fin]' WHERE id_events='$_POST[id_events]'");
    $requete->execute();
    $errors_events['success'] = '<div style="background-color:green;padding:1em;text-align:center;">Félicitation votre évènement a été bien créee!</div>';
    sleep(3000);
    header('Location:Evenements.php');
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
  <link rel="stylesheet" href="Css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
  <title>HETIC - Events Hub Creation évènements</title>
</head>

<body>
  <div class="heh">
    <a href="home.php"><img src="img/HEH HETIC EVENTS HUB.png" alt=""></a>
  </div>
  <div class="titre">
    <h1>RECAPITULATIF D'EVENEMENT</h1>
  </div>
  <?php if (isset($errors_events['success'])) : ?>
    <?php  echo $errors_events['success']; ?>
  <?php endif; ?>
  <section>
   <?php
    $id = $_SESSION['user']['id_users'];
    $select_event = $pdo->prepare("SELECT * FROM events WHERE id_users = '$id' ORDER BY id_events DESC LIMIT 1 ");
    $select_event->execute();
    $result = $select_event->fetchAll();
    foreach ($result as $select_events){
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id_events" value="<?php echo $select_events['id_events'];?>">
      <div style="width:100%;text-align:center;">
        <img id="preview" src="" alt="Aperçu de l'image" style="width:400px;height:auto; margin:0 auto 1em auto;">
      </div>
      <div class="space-img">
        <input type="file" id="image" accept="image/*" name="picture">
        <?php if (isset($errors_events['image'])) : ?>
        <p style="color:red;margin:0px">
          <?php echo $errors_events['image']; ?>
        </p>
        <?php endif; ?>
      </div>
      <div class="content">
        <div class="space">
          <label for="titre_events">Titre Evenement <span style="color:red;">*</span></label>
          <input type="text" name="titre_events" placeholder="Titre Event" value="<?php echo $select_events['titre_event'];?>">
        </div>
        <div class="space">
          <label for="lieu">Lieu</label>
          <input type="text" name="lieu" placeholder="lieu" value="<?php echo $select_events['lieu'];?>">
        </div>
        <div class="space">
          <label for="date">Debut de l'évènement <span style="color:red;">*</span></label>
          <input type="datetime-local" name="date_debut" placeholder="date" value="<?php echo $select_events['date_debut'];?>">
        </div>
        <div class="space">
          <label for="date">Fin de l'évènement <span style="color:red;">*</span></label>
          <input type="datetime-local" name="date_fin" placeholder="date" value="<?php echo $select_events['date_fin'];?>">
        </div>
        <div class="space-description">
          <label for="desc">Decription de l'evenement<span style="color:red;">*</span></label>
          <textarea name="description"><?php echo $select_events['description'];?></textarea>
        </div>
      </div>
      <div class="actions">
        <a href="index.php">Annuler</a>
        <input class="suivant" type="submit" value="Publier">
      </div>
    </form>
    <?php }?>
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
      <p>Copyright &copy;
        <?= date('Y'); ?> HEH-Site de centralisation de données
      </p>
    </div>
  </footer>
  <script src="Js/scripts.js"></script>
</body>

</html>