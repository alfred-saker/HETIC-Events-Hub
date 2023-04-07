<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <title>Validation</title>
</head>

<body>

    <div class="heh">
        <a href="index.php"><img src="image/logo3.svg" alt=""></a>
    </div>
    <div class="titre_validation">
        <h1>RECAPITULATIF ET VALIDATION</h1>
        <p>Voici le Récacapitulatif de votre event !</p>
    </div>

    <div class="content_validation">

        <div class="validation_right">
            <h2>Fichier(s) associée(s) à l'event</h2>
            <div class="image_event">
                <img src="image/Rectangle 6.svg" alt="">
            </div>
            <div class="upload">
                <label for="file-upload" class="custom-file-upload">
                    Modifier le(s) fichier(s)
                </label>
                <input id="file-upload" type="file" />
            </div>



        </div>
        <div class="validation_left">
            <h2>Détails concernant l'event</h2>
            <div class="details_event">
                <div class="detail">
                    <p>Titre</p>
                    <div class="tag"> JPO </div>
                </div>
                <div class="detail">
                    <p>Date debut</p>
                    <div class="tag"> 03/03/23 </div>
                </div>
                <div class="detail">
                    <p>Date fin</p>
                    <div class="tag"> 04/03/23 </div>
                </div>
                <div class="detail">
                    <p>Heure debut</p>
                    <div class="tag"> 15:00 </div>
                </div>
                <div class="detail">
                    <p>Heure fin</p>
                    <div class="tag"> 18:00 </div>
                </div>
            </div>
            <h3>Description</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum magnam eius asperiores dignissimos deserunt
                quibusdam aliquid harum, delectus nam,</p>

        </div>
    </div>
    <div class="actions_validation">
        <a href="creat_events.php">Precedent</a>
        <a href="validation.php">Valider</a>
    </div>
</body>


<footer>
    <div class="containerFooter">
        <div class="classLogoFooter">
            <img src="image/loho2.svg" alt="Logo Footer">
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

</html>