<?php
include("config.php");

if ($_POST) {
  $errors_events = array();


  if (isset($_POST['titre_events']) && empty($_POST['titre_events'])) {
    $errors_events['titre_events'] = 'Veuillez renseigner un titre ';
  }

  if (isset($_POST['date_debut']) && empty($_POST['date_debut'])) {
    $errors_events['date_debut'] = 'Veuillez renseigner une date de début  .';
  }

  if (isset($_POST['date_fin']) && empty($_POST['date_fin'])) {
    $errors_events['date_fin'] = 'Veuillez renseigner la date de fin ';
  }

  if (isset($_POST['lieu']) && empty($_POST['lieu'])) {
    $errors_events['lieu'] = 'Veuillez renseigner le lieu ';
  }

  if (isset($_POST['description']) && empty($_POST['description'])) {
    $errors_events['description'] = 'Veuillez entrer une description';
  }
  if ($_POST['date_debut'] > $_POST['date_fin']) {
    $errors_events['date'] = "La date de debut ne peut pas être supérieur à la date de fin.";
  }
  $req = $pdo->prepare("SELECT * FROM events WHERE titre_event = :titre_events AND date_debut = :date_debut");
  $req->execute(array(
    ':titre_events' => $_POST['titre_events'],
    ':date_debut' => $_POST['date_debut']
  ));

  if ($req->rowCount() > 0) {
    $errors_events['check_events'] = "Cet evenement existe deja!";
  }

  if (empty($errors_events)) {
    $requete = $pdo->prepare(" INSERT INTO events(id_users, titre_event, lieu, description , date_debut, date_fin) VALUES (:id_users, :titre_events, :lieu,:description, :date_debut, :date_fin)");
    $timestamp1 = strtotime($_POST['date_debut']);
    $timestamp2 = strtotime($_POST['date_fin']);
    $date_format = 'Y-m-d H:i:s';
    $formatted_date1 =  date($date_format, $timestamp1);
    $formatted_date2 =  date($date_format, $timestamp2);

    $requete->execute(array(
      ':id_users' => $_SESSION['user']['id_users'],
      ':titre_events' => $_POST['titre_events'],
      ':lieu' => $_POST['lieu'],
      ':description' => $_POST['description'],
      ':date_debut' => $formatted_date1,
      ':date_fin' => $formatted_date2
    ));
    header('Location:recap_event.php');
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
    <h1>CREATION D'EVENEMENT</h1>
    <p>Créer un evènement en un clic !</p>
  </div>
  <section>
    <?php
    if (isset($errors_events)) {
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
      <?php if (isset($errors_events['check_events'])) : ?>
        <p style="color:red;margin:0 auto 1em 19.5em;">
          <?php echo $errors_events['check_events']; ?>
        </p>
      <?php endif; ?>
      <?php if (isset($errors_events['check_events'])) : ?>
        <p style="color:red;margin:0 auto 1em 19.5em;">
          <?php echo $errors_events['check_events']; ?>
        </p>
      <?php endif; ?>
      <div class="content">
        <div class="space">
          <label for="titre_events">Titre Evenement <span style="color:red;">*</span></label>
          <input type="text" name="titre_events" placeholder="Titre Event" value="<?php echo htmlspecialchars($_POST['titre_events']); ?>" autocomplete="off">
          <?php if (isset($errors_events['titre_events'])) : ?>
            <p style="color: red; margin:0px">
              <?php echo $errors_events['titre_events']; ?>
            </p>
          <?php endif; ?>
        </div>
        <div class="space">
          <label for="lieu">Lieu</label>
          <input type="text" name="lieu" placeholder="lieu" value="<?php echo htmlspecialchars($_POST['lieu']); ?>" autocomplete="off">
          <?php if (isset($errors_events['lieu'])) : ?>
          <p style="color:red; margin:0px">
            <?php echo $errors_events['lieu']; ?>
          </p>
          <?php endif;?>
        </div>
        <div class="space">
          <label for="date">Debut de l'évènement <span style="color:red;">*</span></label>
          <input type="datetime-local" name="date_debut" placeholder="date" autocomplete="off">
          <?php if (isset($errors_events['date_debut'])) : ?>
          <p style="color: red; margin:0px">
            <?php echo $errors_events['date_debut']; ?>
          </p>
          <?php endif; ?>
          <?php if (isset($errors_events['date'])) : ?>
          <p style="color: red; margin:0px">
            <?php echo $errors_events['date']; ?>
          </p>
          <?php endif; ?>
        </div>
        <div class="space">
          <label for="date">Fin de l'évènement <span style="color:red;">*</span></label>
          <input type="datetime-local" name="date_fin" placeholder="date" autocomplete="off">
          <?php if (isset($errors_events['date_fin'])) : ?>
          <p style="color: red; margin:0px;">
            <?php echo $errors_events['date_fin']; ?>
          </p>
          <?php endif; ?>
        </div>
        <div class="space-description">
          <label for="desc">Decription de l'evenement<span style="color:red;">*</span></label>
          <textarea name="description" placeholder="description"
            ><?php echo htmlspecialchars($_POST['description']); ?></textarea>
          <?php if (isset($errors_events['description'])) : ?>
          <p style="color: red; margin:0px">
            <?php echo $errors_events['description']; ?>
          </p>
          <?php endif; ?>
        </div>
        <div class="actions">
          <a href="index.php">Annuler</a>
          <input class="suivant" type="submit" value="Suivant">
        </div>
    </form>
    <?php } else { ?>
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="content">
        <div class="space">
          <label for="titre_events">Titre Evenement <span style="color:red;">*</span></label>
          <input type="text" name="titre_events" placeholder="Titre Event" autocomplete="off">
        </div>
        <div class="space">
          <label for="lieu">Lieu</label>
          <input type="text" name="lieu" placeholder="lieu" autocomplete="off">
        </div>
        <div class="space">
          <label for="date">Debut de l'évènement <span style="color:red;">*</span></label>
          <input type="datetime-local" name="date_debut" placeholder="date " autocomplete="off">
        </div>
        <div class="space">
          <label for="date">Fin de l'évènement <span style="color:red;">*</span></label>
          <input type="datetime-local" name="date_fin" placeholder="date" autocomplete="off">
        </div>
        <div class="space-description">
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