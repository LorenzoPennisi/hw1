<?php
 require_once 'auth.php';
 if (!$userid = checkAuth()) exit;

 header('Content-Type: application/json');

  removeCart();

  function removeCart(){
    global $dbconfig, $userid;

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
    $userid = mysqli_real_escape_string($conn, $userid);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "DELETE FROM carrello WHERE user_id = '$userid' AND prod_id = '$id'";
    error_log($query);
    if(mysqli_query($conn, $query) or die(mysqli_error($conn))){
      echo json_encode(array('caricato' => true));
      exit;
    }

    mysqli_close(($conn));
    echo json_encode(array('caricato' => false));
  }
?>