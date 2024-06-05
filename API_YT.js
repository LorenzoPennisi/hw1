//-------------------mhw3------------------------

function onResponeYT(response){
  //console.log(response.text());
  console.log(response.status);
  console.log('Risposta Arrivata');

  if(!response.ok){
      console.log('Risposta non Valida');
      return null;
  } else return response.json();
}

function onError(error){
  console.log('CODICE ERRORE ' + error);
}

function onJsonYT(json){
  console.log(json);
  const contenitoreYT = document.querySelector('#youtube');

  json.items.forEach(element => {
      console.log('creo html elemento');
      const titolo = document.createElement('h5');
      const link = document.createElement('a');

      link.href = "https://www.youtube.com/watch?v=" + element.snippet.resourceId.videoId.toString();
      const copertina = document.createElement('img');
      copertina.src = element.snippet.thumbnails.standard.url;
      link.append(titolo);
      link.append(copertina);
      titolo.textContent += element.snippet.title;
      link.classList.add('blocchiVideo');

      contenitoreYT.append(link);
  });
}

//fetch("https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=3&playlistId=PL2dQ89LGNZVyUL87x797dBBsWVqMHzBSY&key=AIzaSyC5NBWBd2Q9jPgLo2xJPyeJdquk45MUAx8").then(onResponeYT, onError).then(onJsonYT);
fetch("api_yt.php").then(onResponeYT, onError).then(onJsonYT);
