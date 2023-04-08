<?php
include('config.php');


if($_POST){
  $msg_send = "";
  $id_user_dest = $_POST['id_user_destinataire'];
  $id_user_emet = $_POST['id_user_emetteur'];
  $req_sql = $pdo->prepare("INSERT INTO invitation (id_user_emetteur,id_user_destinataire,statut_invitation) VALUES (:id_user_emetteur,:id_user_destinataire,:statut)");
  $req_sql->execute(array(
    ':id_user_emetteur'=>$id_user_emet,
    ':id_user_destinataire'=>$id_user_dest,
    ':statut'=>'En attente'
  ));
  $msg_send .="Votre invitation à bien été envoyé!"; 
  header("Location: " . $_SERVER['PHP_SELF']);

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
  <title>HETIC - EVent Hub Chat messagerie</title>
</head>

<body>
  <div class="container-chat">
    <div class="row">
      <nav class="menu-chat">
        <ul class="items-chat">
          <li class="item">
            <a href="espace_perso.php"><i class="fa fa-home" style="color: black;" aria-hidden="true"></i></a>
          </li>
          <li class="item">
            <i class="fa fa-user" style="color: black;" aria-hidden="true" id="list-etudiant"></i>
          </li>
          </li>
          <li class="item item-active">
            <i class="fa fa-commenting" aria-hidden="true" id="list-msg"></i>
          </li>
          </li>
        </ul>
      </nav>

      <section class="discussions" id="section-discussion">
        <div class="discussion search">
          <div class="searchbar">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" placeholder="Search..."></input>
          </div>
        </div>
        <div class="discussion message-active">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
            <div class="online"></div>
          </div>
          <div class="desc-contact">
            <p class="name">Megan Leib</p>
            <p class="message">9 pm at the bar if possible 😳</p>
          </div>
          <div class="timer">12 sec</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://i.pinimg.com/originals/a9/26/52/a926525d966c9479c18d3b4f8e64b434.jpg);">
            <div class="online"></div>
          </div>
          <div class="desc-contact">
            <p class="name">Dave Corlew</p>
            <p class="message">Let's meet for a coffee or something today ?</p>
          </div>
          <div class="timer">3 min</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1497551060073-4c5ab6435f12?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=667&q=80);">
          </div>
          <div class="desc-contact">
            <p class="name">Jerome Seiber</p>
            <p class="message">I've sent you the annual report</p>
          </div>
          <div class="timer">42 min</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://card.thomasdaubenton.com/img/photo.jpg);">
            <div class="online"></div>
          </div>
          <div class="desc-contact">
            <p class="name">Thomas Dbtn</p>
            <p class="message">See you tomorrow ! 🙂</p>
          </div>
          <div class="timer">2 hour</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1553514029-1318c9127859?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80);">
          </div>
          <div class="desc-contact">
            <p class="name">Elsie Amador</p>
            <p class="message">What the f**k is going on ?</p>
          </div>
          <div class="timer">1 day</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1541747157478-3222166cf342?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=967&q=80);">
          </div>
          <div class="desc-contact">
            <p class="name">Billy Southard</p>
            <p class="message">Ahahah 😂</p>
          </div>
          <div class="timer">4 days</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1553514029-1318c9127859?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80);">
          </div>
          <div class="desc-contact">
            <p class="name">Elsie Amador</p>
            <p class="message">What the f**k is going on ?</p>
          </div>
          <div class="timer">1 day</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1553514029-1318c9127859?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80);">
          </div>
          <div class="desc-contact">
            <p class="name">Elsie Amador</p>
            <p class="message">What the f**k is going on ?</p>
          </div>
          <div class="timer">1 day</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1553514029-1318c9127859?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80);">
          </div>
          <div class="desc-contact">
            <p class="name">Elsie Amador</p>
            <p class="message">What the f**k is going on ?</p>
          </div>
          <div class="timer">1 day</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1553514029-1318c9127859?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80);">
          </div>
          <div class="desc-contact">
            <p class="name">Elsie Amador</p>
            <p class="message">What the f**k is going on ?</p>
          </div>
          <div class="timer">1 day</div>
        </div>
        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1435348773030-a1d74f568bc2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80);">
            <div class="online"></div>
          </div>
          <div class="desc-contact">
            <p class="name">Paul Walker</p>
            <p class="message">You can't see me</p>
          </div>
          <div class="timer">1 week</div>
        </div>
      </section>
      <section class="friend-list" id="section-friend-list" style="display:none;">
        <h1>Liste des etudiants par promotions</h1>
        <?php if(isset($msg_send)):?>
          <p><?php echo $msg_send;?></p>
        <?php endif;?>
        <div class="groupe">

          <div class="pmd">
            <div class="title_item" id="btn-title1">
              <h2 style="text-transform:uppercase;"><?php echo $_SESSION['user']['promotion']; ?></h2>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="champ" style="display:none" id="section_PMD">
              <?php
              $req = $pdo->prepare("SELECT * FROM users WHERE promotion = :promotion_user_connect AND id_users!=:id_user_connect");
              $req->execute(array(
                ':promotion_user_connect' => $_SESSION['user']['promotion'],
                'id_user_connect' => $_SESSION['user']['id_users']
              ));
              if ($req->rowCount() > 0) {
                $results = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $row) {
              ?>
                  <div class="invitation">
                    <p>
                      <?php echo $row['prenom']; ?>
                    </p>
                    <a href="">Ajouter comme ami(e)</a>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="invitation">
                  <p>
                    Aucune personne pour le moment!
                  </p>
                </div>
              <?php } ?>
            </div>
          </div>

          <div class="pmd">
            <div class="title_item" id="btn-title2">
              <h2>CTO</h2>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="champ" style="display:none" id="section_CTO">
              <?php
              $req = $pdo->prepare("SELECT * FROM users WHERE promotion = 'CTO'");
              $req->execute();
              if ($req->rowCount() > 0) {
                $results = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $rows_CTO) {
              ?>
                  <div class="invitation">
                    <p><?php echo $rows_CTO['prenom']; ?></p>
                    <a href="">Envoyer une invitation</a>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="invitation">
                  <p>
                    Aucune personne pour le moment!
                  </p>
                </div>
              <?php } ?>
            </div>
          </div>

          <div class="pmd">
            <div class="title_item" id="btn-title3">
              <h2>MASTERE DATA</h2>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="champ" style="display:none" id="section_MD">
              <?php
              $req = $pdo->prepare("SELECT * FROM users WHERE promotion ='DATA'");
              $req->execute();
              if ($req->rowCount() > 0) {
                $results = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $row_data_master) {
              ?>
                  <div class="invitation">
                    <p><?php echo $row_data_master['prenom']; ?><?php echo $row_data_master['id_users'];?>.</p>
                    <form action="" method="post">
                      <input type="hidden" name="id_user_destinataire" value="<?php echo $row_data_master['id_users'];?>">
                      <input type="hidden" name="id_user_emetteur" value="<?php echo $_SESSION['user']['id_users'];?>">
                      <button type="submit">Envoyer une invitation</button>
                    </form>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="invitation">
                  <p>
                    Aucune personne pour le moment!
                  </p>
                </div>
              <?php } ?>
            </div>
          </div>

          <div class="pmd">
            <div class="title_item" id="btn-title4">
              <h2>PRODUCT MANAGER</h2>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="champ" style="display:none" id="section_PM">
              <?php
              $req = $pdo->prepare("SELECT * FROM users WHERE promotion = 'PRODUCT MANAGER'");
              $req->execute();
              if ($req->rowCount() > 0) {
                $results = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $rows_pm) {
              ?>
                  <div class="invitation">
                    <p><?php echo $rows_pm['prenom']; ?></p>
                    <a href="">Envoyer une invitation</a>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="invitation">
                  <p>
                    Aucune personne pour le moment!
                  </p>
                </div>
              <?php } ?>
            </div>
          </div>

          <div class="pmd">
            <div class="title_item" id="btn-title5">
              <h2>CYBERSECURITE</h2>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="champ" style="display:none" id="section_CYBER">
              <?php
              $req = $pdo->prepare("SELECT * FROM users WHERE promotion = 'cybersecurite'");
              $req->execute();
              if ($req->rowCount() > 0) {
                $results = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $rows_cyber) {
              ?>
                  <div class="invitation">
                    <p><?php echo $rows_cyber['prenom']; ?></p>
                    <a href="">Envoyer une invitation</a>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="invitation">
                  <p>
                    Aucune personne pour le moment!
                  </p>
                </div>
              <?php } ?>
            </div>
          </div>

          <div class="pmd">
            <div class="title_item" id="btn-title6">
              <h2>BACHELOR DEV</h2>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="champ" style="display:none" id="section_BD">
              <?php
                $req = $pdo->prepare("SELECT * FROM users WHERE promotion = 'Bachelor Dev'");
                $req->execute();
                if ($req->rowCount() > 0) {
                $results = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $rows_dev) {
              ?>
                  <div class="invitation">
                    <p><?php echo $rows_dev['prenom']; ?></p>
                    <a href="">Envoyer une invitation</a>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="invitation">
                  <p>
                    Aucune personne pour le moment!
                  </p>
                </div>
              <?php } ?>
            </div>
          </div>

          <div class="pmd">
            <div class="title_item" id="btn-title7">
              <h2>BACHELOR 3D</h2>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="champ" style="display:none" id="section_B3D">
            <?php
                $req = $pdo->prepare("SELECT * FROM users WHERE promotion = 'Bachelor 3D'");
                $req->execute();
                if ($req->rowCount() > 0) {
                $results = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $rows_3d) {
              ?>
                  <div class="invitation">
                    <p><?php echo $rows_3d['prenom']; ?></p>
                    <a href="">Envoyer une invitation</a>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="invitation">
                  <p>
                    Aucune personne pour le moment!
                  </p>
                </div>
              <?php } ?>
            </div>
          </div>

          <div class="pmd">
            <div class="title_item" id="btn-title8">
              <h2>BACHELOR DATA</h2>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="champ" style="display:none" id="section_DATA">
            <?php
                $req = $pdo->prepare("SELECT * FROM users WHERE promotion = 'Bachelor Data&IA'");
                $req->execute();
                if ($req->rowCount() > 0) {
                $results = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $rows_data_ia) {
              ?>
                  <div class="invitation">
                    <p><?php echo $rows_data_ia['prenom']; ?></p>
                    <a href="">Envoyer une invitation</a>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="invitation">
                  <p>
                    Aucune personne pour le moment!
                  </p>
                </div>
              <?php } ?>
            </div>
          </div>

          <div class="pmd">
            <div class="title_item" id="btn-title9">
              <h2>BACHELOR UX</h2>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="champ" style="display:none" id="section_UX">
            <?php
                $req = $pdo->prepare("SELECT * FROM users WHERE promotion = 'Bachelor webmarketing&Ux'");
                $req->execute();
                if ($req->rowCount() > 0) {
                $results = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $rows_web_ux) {
              ?>
                  <div class="invitation">
                    <p><?php echo $rows_web_ux['prenom']; ?></p>
                    <a href="">Envoyer une invitation</a>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="invitation">
                  <p>
                    Aucune personne pour le moment!
                  </p>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>


      </section>
      <section class="chat" id="section-chat">
        <div class="header-chat">
          <i class="icon fa fa-user-o" aria-hidden="true"></i>
          <p class="name">Megan Leib</p>
          <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>
        </div>
        <div class="messages-chat">
          <div class="message">
            <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
              <div class="online"></div>
            </div>
            <p class="text"> Hi, how are you ? </p>
          </div>
          <div class="message text-only">
            <p class="text"> What are you doing tonight ? Want to go take a drink ?</p>
          </div>
          <p class="time"> 14h58</p>
          <div class="message text-only">
            <div class="response">
              <p class="text"> Hey Megan ! It's been a while 😃</p>
            </div>
          </div>
          <div class="message text-only">
            <div class="response">
              <p class="text"> When can we meet ?</p>
            </div>
          </div>
          <p class="response-time time"> 15h04</p>
          <div class="message">
            <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
              <div class="online"></div>
            </div>
            <p class="text"> 9 pm at the bar if possible 😳</p>
          </div>
          <p class="time"> 15h09</p>
        </div>
        <div class="footer-chat">
          <!-- <i class="icon fa fa-smile-o clickable" style="font-size:25pt;" aria-hidden="true"></i> -->
          <input type="text" class="write-message" placeholder="Enter your message here"></input>
          <!-- <i class="icon send fa fa-paper-plane-o clickable" aria-hidden="true"></i>  -->
          <!-- <i class="fa-sharp fa-light fa-paper-plane fa-beat"></i> -->
          <!-- <i class="fa-sharp fa-light fa-paper-plane fa-beat" style="color: #6688c6;"></i> -->
        </div>
      </section>
    </div>
  </div>
  <script src="Js/chat.js"></script>
</body>

</html>