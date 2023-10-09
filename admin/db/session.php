<?php
include_once('db/conn.php');
session_start();

if(!isset($_SESSION['login_user'])|| $_SESSION['login_user']==''||$_SESSION['role'] != '2'){         
   header('Location: index.php');
}

?>