<?php 

  include('config.php');
?>

<!DOCTYPE html>
<html lang="en">

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
  <title>HETIC - Events Hub Mon Espace personnel - Mon profil</title>
</head>
<body>
  <section class="classContainerDisplayProfil">
    <h2>Dernière modification: aeezefzze</h2>
    <div class="classBlockInfosProfil">
      <div class="classAvatarProfil">
        <img src="img/user_avatar.png" alt="Image Association">
      </div>
      <div>
        <p>
          Nom: <strong><?php echo $_SESSION['user']['nom']?></strong>
        </p>
        <p>
          <?php if(isset($_SESSION['user']['prenom'])){?>
            Prenom: <?php echo $_SESSION['user']['prenom'];?>
          <?php }else{?>
            Prenom: Cette valeur est vide.
          <?php }?>
        </p>
        <p>
          Email: <?php echo $_SESSION['user']['email'];?>
        </p>
        <p>
          Date Inscription: <?php echo $_SESSION['user']['date_creation']?>
        </p>
        <p>
          Type de compte: <?php echo $_SESSION['user']['type_account'];?>
        </p>
      </div>
      <button class="classBtnUpdateInfosProfil" id="btn_display">Mettre à jour</button>
    </div>
  </section>
  <section class="classContainerUpdateProfil" id="UpdateProfil">
    <form action="#" method="post">
      <div class="BlockLamda">
        <fieldset class="fielset1">
          <legend>Mes Informations Personnelles</legend>
          <div class="itemUpdateform">
            <div>
              <img id="preview" src="" alt="Aperçu de l'image">
            </div>
            <div>
              <input type="file" id="image" accept="image/*">
            </div>
          </div>
          <div class="itemUpdateform">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom"  autocomplete=off >
          </div>
          <div class="itemUpdateform">
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" id="prenom"autocomplete=off>
          </div>
          <div class="itemUpdateform">
            <label for="prenom">Description</label>
            <textarea name="desc" id="description" cols="30" rows="10"></textarea>
          </div>
        </fieldset>
        <fieldset class="fielset2">
          <legend>Mes Identifiants</legend>
          <div class="itemUpdateform">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom"  autocomplete=off >
          </div>
          <div class="itemUpdateform">
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" id="prenom"autocomplete=off>
          </div>
        </fieldset>
      </div>
      <div class="itembtnsubmitUpdateform">
        <button type="submit">Mettre à jour</button>
        <button type="submit" id="btn_hidden">Annuler</button>
      </div>
    </form>
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
      <p>Copyright &copy;<?= date('Y');?> HEH-Site de centralisation de données</p>
    </div>
  </footer>
  <script src="Js/scripts.js"></script>
</body>
</html>