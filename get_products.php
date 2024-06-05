<?php
  require_once 'dbconfig.php';
  $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

  $sql = "SELECT p.id, p.titolo, p.categoria, p.prezzo, i.immagine_path
      FROM prodotti p
      LEFT JOIN immagini i ON p.id = i.prodotto_id
      GROUP BY p.id
      LIMIT 10 OFFSET 5";
  $result = mysqli_query($conn, $sql);

  $prodotti = [];
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $prodotti[$row['id']]['id'] = $row['id'];
      $prodotti[$row['id']]['titolo'] = $row['titolo'];
      //$prodotti[$row['id']]['descrizione'] = $row['descrizione'];
      $prodotti[$row['id']]['categoria'] = $row['categoria'];
      $prodotti[$row['id']]['prezzo'] = $row['prezzo'];
      $prodotti[$row['id']]['immagini'][] = $row['immagine_path'];
    }
  }

  mysqli_close($conn);
  header('Content-Type: application/json');

  echo json_encode($prodotti);
?>