<?php
//inizializza una nuova sessione cURL e restituisce un handle che viene memorizzato nella variabile $curl.
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=3&playlistId=PL2dQ89LGNZVyUL87x797dBBsWVqMHzBSY&key=AIzaSyC5NBWBd2Q9jPgLo2xJPyeJdquk45MUAx8");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// Esegui la richiesta cURL e ottieni la risposta
$result = curl_exec($curl);

$data = json_decode($result, true);

curl_close($curl);

// Controlla se la risposta è valida
if ($result === false) {
  // In caso di errore, restituisci un messaggio di errore
  $response = [
    "error" => "Errore nella richiesta cURL"
  ];
} else {
  // Decodifica la risposta JSON
  $data = json_decode($result, true);

  // Verifica se la decodifica è riuscita
  if (json_last_error() !== JSON_ERROR_NONE) {
    // In caso di errore nella decodifica, restituisci un messaggio di errore
    $response = [
      "error" => "Errore nella decodifica JSON"
    ];
  } else {
    // Restituisci i dati ottenuti dall'API di YouTube
    $response = $data;
  }
}

header('Content-Type: application/json');
echo json_encode($response);
