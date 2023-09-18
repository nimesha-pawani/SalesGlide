<?php
      session_start();
      if (empty($_SESSION['username']) && empty($_SESSION['admin'])) {
            header("Location: ../index.php");
      }

      require "../app/Connect.php";
      $id = $_GET['id'];
      $sql = "DELETE FROM `products` WHERE `product_id`='$id'";
      $result = $con->query($sql);
      if (!empty($result)) {
            header("Location: ../admin/products.php");
      }
?>