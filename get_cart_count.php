<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        echo json_encode(array('error' => 'Utente non autenticato'));
        exit;
    }

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    // Verifica della connessione
    if (!$conn) {
        echo json_encode(array('error' => 'Errore di connessione al database'));
        exit;
    }

    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT COUNT(*) AS cartCount FROM carrello WHERE user_id = '$userid'";
    $result = mysqli_query($conn, $query);

    // Verifica se la query è stata eseguita correttamente
    if (!$result) {
        echo json_encode(array('error' => 'Errore nella query del database'));
        exit;
    }

    $row = mysqli_fetch_assoc($result);
    $cartCount = $row['cartCount'];

    // Chiudi la connessione al database
    mysqli_close($conn);

    // Restituisci il conteggio degli elementi nel carrello come JSON
    echo json_encode(array('cartCount' => $cartCount));
?>
