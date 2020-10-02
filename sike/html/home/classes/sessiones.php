<?php 
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
      header("location: ../index.php");
  exit;
      }
      if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1
      AND $_SESSION['roles_id'] == '1') {
        header("location: ./administrador/menuadmin.php");
    exit;
        }

      
?>