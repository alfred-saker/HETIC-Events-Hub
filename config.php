<?php
$pdo = new PDO(
  'mysql:host=localhost;dbname=hetic-eh', 
  'root', 
  '', 
  array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
  );

  session_start();

  if (isset($_GET['action']) && ($_GET['action'] == 'logout')) {
    session_destroy();
    header('location:index.php');
  }
 

?>