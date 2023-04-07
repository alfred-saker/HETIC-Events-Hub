<?php
include("config.php");

$errors_image = array();
if ($_POST) {
  if (isset($_FILES['images_events'])) {
    var_dump("Repond");
    die();
    $tmp_image = $_FILES['image']['tmp_name'];

    $files_extensions = strrchr($_FILES['image']['type'], '/');
    $files_extensions = str_replace('/', '.', $files_extensions);

    $files_name = date("YmdHis") . $files_extensions;
    $max_size = 500000;
    $files_size = filesize($tmp_image);

    $extensions_autorisees = array('.jpg', '.png', '.jpeg');
    $dossier = "image/photo_events";

    if (!in_array($files_extensions, $extensions_autorisees)) {
      $errors_image['image'] = 'Ce type de fichier n\'est pas accepté';
    }
  } else {
    $errors_image['image'] = "Veuillez selectionner une image";
  }
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
  <title>HETIC - Events Hub Creation évènements</title>
</head>

<body>
  <div class="heh">
    <a href="index.php"><img src="img/HEH HETIC EVENTS HUB.png" alt=""></a>
  </div>
  <div class="titre">
    <h1>IMAGE ASSOCIE A L'EVENT </h1>
    <p>Ajouter une associée à votre event!</p>
  </div>
  <div class="file-wrapper">
    <input type="file" name="upload-img" accept="image/*" />
    <div class="close-btn">×</div>
  </div>

  <p class="made-by">MADE BY <strong>MJ</strong></p>

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
      <p>Copyright &copy;
        <?= date('Y'); ?> HEH-Site de centralisation de données
      </p>
    </div>
  </footer>
  <script src="Js/scripts.js"></script>
</body>

</html>