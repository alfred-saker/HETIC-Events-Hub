<?php
include('config.php');
if(!isset($_SESSION['user'])){
  header('location:index.php');
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
   <title>HETIC - Events Hub Mon Espace personnel - messagerie</title>
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
   <div class="container-repertoire">
     <div class="container-contact">
       <div class="search-contact">
         <form action="/search">
           <input type="search" placeholder="Rechercher..." name="search">
         </form>
       </div>
       <div class="liste-contact">
         <div class="image-contact">
           <img src="img/user_avatar.png" alt="Profil invitation">
         </div>
         <div class="info-contact">
           <h3> Alfred KUATE KUATE </h3>
         </div>
       </div>
       <div class="liste-contact">
         <div class="image-contact">
           <img src="img/user_avatar.png" alt="Profil invitation">
         </div>
         <div class="info-contact">
           <h3> Alfred KUATE KUATE </h3>
         </div>
       </div>
       <div class="liste-contact">
         <div class="image-contact">
           <img src="img/user_avatar.png" alt="Profil invitation">
         </div>
         <div class="info-contact">
           <h3> Alfred KUATE KUATE </h3>
         </div>
       </div>
       <div class="liste-contact">
         <div class="image-contact">
           <img src="img/user_avatar.png" alt="Profil invitation">
         </div>
         <div class="info-contact">
           <h3> Alfred KUATE KUATE </h3>
         </div>
       </div>
       <div class="liste-contact">
         <div class="image-contact">
           <img src="img/user_avatar.png" alt="Profil invitation">
         </div>
         <div class="info-contact">
           <h3> Alfred KUATE KUATE </h3>
         </div>
       </div>
       <div class="liste-contact">
         <div class="image-contact">
           <img src="img/user_avatar.png" alt="Profil invitation">
         </div>
         <div class="info-contact">
           <h3> Alfred KUATE KUATE </h3>
         </div>
       </div>
     </div>
     <div class="container-message">
       <div class="container-name">
         <p>Raissa KAMENI</p>
       </div>
       <ul class="message">
         <li class="message-received">Bonjour</li>
         <li class="message-sent">Salut</li>
         <li class="message-received">Comment vas-tu ?</li>
         <li class="message-sent">Je vais bien, merci. Et toi ?</li>
         <li class="message-received">Bonjour</li>
         <li class="message-sent">Salut</li>
         <li class="message-received">Comment vas-tu ?</li>
         <li class="message-sent">Je vais bien, merci. Et toi ?</li>
         <li class="message-received">Bonjour</li>
         <li class="message-sent">Salut</li>
         <li class="message-received">Comment vas-tu ?</li>
         <li class="message-sent">Je vais bien, merci. Et toi ?</li>
         <li class="message-received">Bonjour</li>
         <li class="message-sent">Salut</li>
         <li class="message-received">Comment vas-tu ?</li>
         <li class="message-sent">Je vais bien, merci. Et toi ?</li>
         <li class="message-received">Bonjour</li>
         <li class="message-sent">Salut</li>
         <li class="message-received">Comment vas-tu ?</li>
         <li class="message-sent">Je vais bien, merci. Et toi ?</li>
         <li class="message-received">Bonjour</li>
         <li class="message-sent">Salut</li>
         <li class="message-received">Comment vas-tu ?</li>
         <li class="message-sent">Je vais bien, merci. Et toi ?</li>
         <li class="message-received">Bonjour</li>
         <li class="message-sent">Salut</li>
         <li class="message-received">Comment vas-tu ?</li>
         <li class="message-sent">Je vais bien, merci. Et toi ?</li>
       </ul>
     </div>
   </div>
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