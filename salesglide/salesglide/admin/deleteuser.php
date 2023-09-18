<?php 
session_start();
	if (empty($_SESSION['username'])&& empty($_SESSION['admin'])) {
	header("Location: ../index.php");
   exit();
	}
 ?>
<?php
   require "../app/Connect.php";
   require "../app/Sale.php";
	$username = secureinput($_GET['username']);
      $sql = "DELETE FROM `users` WHERE `username`='$username'";
      $result = $con->query($sql);
      if (!empty($result)) {
      	header("Location: users.php");
      }

?>