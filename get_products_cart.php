<?php
  require_once 'auth.php';
  if (!$userid = checkAuth()) {
      header("Location: login.php");
      exit;
  }

  require_once 'dbconfig.php';
  $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

  $sql = "SELECT c.user_id, c.id, c.prod_id, c.content, i.immagine_path
          FROM carrello c
          LEFT JOIN immagini i ON c.prod_id = i.prodotto_id
          WHERE user_id = '$userid'
          GROUP BY c.id";
  $result = mysqli_query($conn, $sql);

  $prodotti = [];
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

      // Decodifica i dati JSON
      $content = json_decode($row['content'], true);
        
      // Aggiungi il prodotto all'array dei prodotti
      $content['immagini'][] = $row['immagine_path'];

      $prodotti[] = $content;
    }
  }

  mysqli_close($conn);
  header('Content-Type: application/json');

  echo json_encode($prodotti);
?>