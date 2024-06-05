<?php
  require_once 'dbconfig.php';
  header('Content-Type: application/json');

  ricerca();

  function ricerca(){
    global $dbconfig;

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
          
    //$userid = mysqli_real_escape_string($conn, $userid);
    if (!isset($_POST['titolo'])) {
      echo json_encode(array('error' => 'Titolo non fornito'));
      exit;
    }
    
    $titolo = mysqli_real_escape_string($conn, $_POST['titolo']);

    $sql = "SELECT p.id, p.titolo, p.prezzo, i.immagine_path
            FROM prodotti p
            LEFT JOIN immagini i ON p.id = i.prodotto_id
            WHERE p.titolo LIKE '%$titolo%'
            GROUP BY p.id";

    $ris = mysqli_query($conn, $sql);

    $prodotti = [];

    if(mysqli_num_rows($ris) > 0){
      while ($row = $ris->fetch_assoc()) {
        $prodotti[$row['id']]['id'] = $row['id'];
        $prodotti[$row['id']]['titolo'] = $row['titolo'];
        //$prodotti[$row['id']]['categoria'] = $row['categoria'];
        $prodotti[$row['id']]['prezzo'] = $row['prezzo'];
        $prodotti[$row['id']]['immagini'][] = $row['immagine_path'];
      }
    }

    mysqli_close($conn);
    echo json_encode($prodotti);
  }

?>