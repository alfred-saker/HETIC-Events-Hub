<?php
include("config.php");

if ($_POST) {
  $errors_events = array();


  if (isset($_POST['titre_events']) && empty($_POST['titre_events'])) {
    $errors_events['titre_events'] = 'Veuillez saisir le titre de l\'event.';
  }

  if (isset($_POST['date_debut']) && empty($_POST['date_debut'])) {
    $errors_events['date_debut'] = 'Veuillez entrer la date de début  de l\'event.';
  }

  if (isset($_POST['date_fin']) && empty($_POST['date_fin'])) {
    $errors_events['date_fin'] = 'Veuillez entrer la date de fin de l\'event.';
  }

  if (isset($_POST['lieu']) && empty($_POST['lieu'])) {
    $errors_events['lieu'] = 'Veuillez entrer le lieu de l\'event.';
  }

  if (isset($_POST['description']) && empty($_POST['description'])) {
    $errors_events['description'] = 'Veuillez saisir la description de l\'event.';
  }
  if($_POST['date_debut'] > $_POST['date_fin']){
    $errors_events['date'] = "La date de debut ne peut pas être supérieur à la date de fin.";
  }
  if (isset($_FILES['picture']) && $_FILES['picture']['error'] == UPLOAD_ERR_NO_FILE) {
    $errors_events['image'] = "Veuillez selectionner une image";
  } 
  else {
    $tmp_name = $_FILES['picture']['tmp_name'];

    $files_extensions = strrchr($_FILES['picture']['type'], '/');
    $files_extensions = str_replace('/', '.', $files_extensions);

    $files_name = date("YmdHis") . $files_extensions;
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

  $req = $pdo->prepare("SELECT * FROM events WHERE titre_event = :titre_events AND date_debut = :date_debut");
  $req->execute(array(
    ':titre_events' => $_POST['titre_events'],
    ':date_debut' => $_POST['date_debut']
  ));

  if ($req->rowCount() > 0) {
    $errors_events['check_events'] = "Cet evenement existe deja";
  }
  
  if (empty($errors_events)){
    $requete = $pdo->prepare(" INSERT INTO events(id_users, titre_event, lieu, description , profil, date_debut, date_fin) VALUES (:id_users, :titre_events, :lieu,:description, :photo, :date_debut, :date_fin)");
    $timestamp1 = strtotime($_POST['date_debut']);
    $timestamp2 = strtotime($_POST['date_fin']);
    $date_format = 'Y-m-d H:i:s';
    $formatted_date1 =  date($date_format,$timestamp1);
    $formatted_date2 =  date($date_format,$timestamp2);

    $requete->execute(array(
      ':id_users' => $_SESSION['user']['id_users'],
      ':titre_events' => $_POST['titre_events'],
      ':lieu' => $_POST['lieu'],
      ':description' => $_POST['description'],
      ':photo' => $files_name,
      ':date_debut' =>$formatted_date1,
      ':date_fin' => $formatted_date2
    ));
    // header('Location:image_event.php');
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
    <a href="index.php"><img src="img/HEH HETIC EVENTS HUB.png" alt=""></a>
  </div>
  <div class="titre">
    <h1>CREATION D'EVENEMENT</h1>
    <p>Créer un evènement en un clic !</p>
  </div>
  <section>
    <form action="" method="POST" enctype="multipart/form-data">
      <?php
      if (isset($errors_events)) {
      ?>
        <div class="content">
          <div>
            <img id="preview" src="" alt="Aperçu de l'image" style="width:400px;height:auto; margin:0 auto 1em auto;">
          </div>
          <div class="space">
            <input type="file" id="image" accept="image/*" name="picture">
            <?php if (isset($errors_events['image'])) : ?>
              <div class="error">
                <p style="color: red;">
                  <?php echo $errors_events['image']; ?>
                </p>
              </div>
            <?php endif; ?>
          </div>
          <div class="space">
            <?php if (isset($errors_events['check_events'])) : ?>
              <div class="error">
                <p style="color: red;">
                  <?php echo $errors_events['check_events']; ?>
                </p>
              </div>
            <?php endif; ?> <br><br>
            <label for="date">Titre Event <span style="color:red;">*</span></label>
            <input type="text" name="titre_events" placeholder="Titre Event" value="<?php echo htmlspecialchars($_POST['titre_events']); ?>">
            <?php if (isset($errors_events['titre_events'])) : ?>
              <div class="error">
                <p style="color: red;">
                  <?php echo $errors_events['titre_events']; ?>
                </p>
              </div>
            <?php endif; ?>
          </div>
          <div class="space">
            <label for="date">Date debut <span style="color:red;">*</span></label>
            <input type="datetime-local" name="date_debut" value="">
            <?php if (isset($errors_events['date_debut'])) : ?>
              <div class="error">
                <p style="color: red;">
                  <?php echo $errors_events['date_debut']; ?>
                </p>
              </div>
            <?php endif; ?>
            <?php if (isset($errors_events['date'])) : ?>
              <div class="error">
                <p style="color: red;">
                  <?php echo $errors_events['date']; ?>
                </p>
              </div>
            <?php endif; ?>
          </div>
          <div class="space">
            <label for="date">Date fin <span style="color:red;">*</span></label>
            <input type="datetime-local" name="date_fin" value="">
            <?php if (isset($errors_events['date_fin'])) : ?>
              <div class="error">
                <p style="color: red;">
                  <?php echo $errors_events['date_fin']; ?>
                </p>
              </div>
            <?php endif; ?>
          </div>
          <div class="space">
            <label for="lieu">Lieu</label>
            <input type="text" name="lieu" placeholder="lieu" value="<?php echo htmlspecialchars($_POST['lieu']); ?>">
            <?php if (isset($errors_events['lieu'])) : ?>
              <div class="error">
                <p style="color: red;">
                  <?php echo $errors_events['lieu']; ?>
                </p>
              </div>
            <?php endif; ?>
          </div>
          <div class="space">
            <textarea name="description" placeholder="description" value="<?php echo htmlspecialchars($_POST['description']); ?>"></textarea>
            <?php if (isset($errors_events['description'])) : ?>
              <div class="error">
                <p style="color: red;">
                  <?php echo $errors_events['description']; ?>
                </p>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="actions">
          <a href="index.php">Annuler</a>
          <input class="suivant" type="submit" value="Suivant">
        </div>
    </form>
  <?php } else { ?>
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="content">
        <div>
          <img id="preview" src="" alt="Aperçu de l'image" style="width:400px;height:auto; margin:0 auto 1em auto;">
        </div>
        <div class="space">
          <label for="picture">Image de couverture<span style="color:red;">*</span></label>
          <input type="file" id="image" accept="image/*" name="picture">
        </div>
        <div class="space">
          <label for="titre_events">Titre Evenement <span style="color:red;">*</span></label>
          <input type="text" name="titre_events" placeholder="Titre Event">
        </div>
        <div class="space">
          <label for="lieu">Lieu</label>
          <input type="text" name="lieu" placeholder="lieu">
        </div>
        <div class="space">
          <label for="date">Debut de l'évènement <span style="color:red;">*</span></label>
          <input type="datetime-local" name="date_debut" placeholder="date ">
        </div>
        <div class="space">
          <label for="date">Fin de l'évènement <span style="color:red;">*</span></label>
          <input type="datetime-local" name="date_fin" placeholder="date">
        </div>
        <div class="space">
          <label for="desc">Decription de l'evenement<span style="color:red;">*</span></label>
          <textarea name="description" placeholder="description"></textarea>
        </div>
      </div>
      <div class="actions">
        <a href="index.php">Annuler</a>
        <input class="suivant" type="submit" value="Valider">
      </div>
    </form>
  <?php } ?>
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