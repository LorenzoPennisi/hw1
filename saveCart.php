<?php
  require_once 'auth.php';
  if (!$userid = checkAuth()) exit;

  header('Content-Type: application/json');

  carrello();

  function carrello(){
    global $dbconfig, $userid;

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
          
    $userid = mysqli_real_escape_string($conn, $userid);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    //recupero il prodotto tramite id
    $sql = "SELECT * FROM prodotti WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      echo json_encode(array('ok' => false, 'error' => mysqli_error($conn)));
      exit;
    }

    $prodotto = null;

    if(mysqli_num_rows($result) > 0){
      while ($row = $result->fetch_assoc()) {
        if (!$prodotto) {
            $prodotto = [
            'id' => $row['id'],
            'titolo' => $row['titolo'],
            'descrizione' => $row['descrizione'],
            'categoria' => $row['categoria'],
            'prezzo' => $row['prezzo']
          ];
        }
      }
    }

    //Controllo se il prodotto è già nel carrello
    $query = "SELECT * FROM carrello WHERE user_id = '$userid' AND prod_id = '$id'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (!$res) {
      echo json_encode(array('ok' => false, 'error' => mysqli_error($conn)));
      exit;
    }

    if(mysqli_num_rows($res) > 0){
      echo json_encode(array('esiste' => true));
      exit;
    }

    $query = "INSERT INTO carrello(user_id, prod_id, content) VALUES ('$userid', '$id', JSON_OBJECT('id', '$prodotto[id]', 'titolo', '$prodotto[titolo]', 'descrizione', '$prodotto[descrizione]', 'categoria', '$prodotto[categoria]', 'prezzo', '$prodotto[prezzo]'))";
    error_log($query);
    if(mysqli_query($conn, $query) or die(mysqli_error($conn))){
      echo json_encode(array('caricato' => true));
      exit;
    }

    mysqli_close($conn);
    echo json_encode(array('caricato' => false));
  }
?>