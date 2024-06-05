//-------------------MODALE-----------------------
function onThumbnailClick(event){
  //const no_scroll = document.querySelector('.scroll');
  //no_scroll.classList.remove('scroll');
  //no_scroll.classList.add('no-scroll');
  document.body.classList.add('no-scroll');
  ricercaModal.style.top = window.pageYOffset + 'px';
  
  ricercaModal.classList.remove('hidden');
}

function hiddenOnClick(event){
  if(event.target.id == 'ricercaModal'){
      document.body.classList.remove('no-scroll');

      ricercaModal.classList.add('hidden');
  }
  
  if(event.target.id == 'closeButtomModal'){
    document.body.classList.remove('no-scroll');
    ricercaModal.classList.add('hidden');
  }
}

const closeModal = document.querySelector('#closeButtomModal');
closeModal.addEventListener('click', hiddenOnClick);

const barra = document.querySelector('#barra');
barra.addEventListener('click', onThumbnailClick);

const modale = document.querySelector('#ricercaModal');
modale.addEventListener('click', hiddenOnClick);

//----------------RICERCA MODALE----------------

function onResponseProd(response){
  console.log(response.status);
  console.log('Risposta Arrivata');
  
  return response.json();
}

function jsonSearch(json){
  const prodotti = Object.values(json); // Converto l'oggetto in un array
  /*if(json.ok){
    console.log("Json Ricerca Arrivato");
  } else{console.error("errore json");}
  //console.log(json);*/

  const cont_prodotti = document.getElementById('Prodotti');
  cont_prodotti.innerHTML = '';
  //const prodotti = Object.values(json);
  console.log(prodotti); 

  //tolgo l'hidden dai bottoni
  const nextButton = document.getElementById('next');
  const prevButton = document.getElementById('prev');
  nextButton.classList.remove('hidden');
  prevButton.classList.remove('hidden');

  prodotti.forEach(prodotto => {
    const itemsMain = document.createElement('div');
    itemsMain.classList.add('itemsMain');

    const itemsMain2 = document.createElement('div');
    itemsMain2.classList.add('itemsMain2');

    // Aggiungo immagine del prodotto
    if (/*prodotto.immagini && prodotto.immagini.length > 0 &&*/ prodotto.immagini[0] != null) {
      let link = document.createElement('a');
      console.log(prodotto.id);
      link.href = "dettagli_prodotto.php?id=" + prodotto.id;

      const contenitor_img = document.createElement('div');
      contenitor_img.classList.add("img_product");
      img = document.createElement('img');
      contenitor_img.appendChild(img);
      
      img.src = prodotto.immagini[0]; // Usa la prima immagine come copertina
      img.alt = prodotto.titolo;

      link.appendChild(contenitor_img);
      itemsMain2.appendChild(link);
    } else {
        itemsMain2.appendChild(document.createTextNode('Immagine non disponibile'));
      }

    // Aggiungo titolo del prodotto
    const titleSpan = document.createElement('span');
    titleSpan.textContent = prodotto.titolo;
    itemsMain2.appendChild(titleSpan);

    const carrello = document.createElement("button");
    carrello.dataset.id = prodotto.id;
    carrello.textContent = "Aggiungi al Carrello";
    itemsMain2.appendChild(carrello);
    carrello.classList.add("bottone_carrello");

    const salvataggio = document.createElement('span');
    salvataggio.textContent = 'Articolo Salvato';
    salvataggio.classList.add('hidden');
    salvataggio.classList.add('salvato');
    itemsMain2.appendChild(salvataggio);

    //-----Carrello-------
    carrello.addEventListener('click', saveCart);
    
    const itemsMain3 = document.createElement('div');
    itemsMain3.classList.add('itemsMain3');

    // Aggiungo prezzo
    const priceSpan = document.createElement('span');
    priceSpan.textContent = '€' + parseFloat(prodotto.prezzo).toFixed(2);
    itemsMain3.appendChild(priceSpan);

    const ivaSpan = document.createElement('span');
    ivaSpan.textContent = '-Iva Inclusa';
    itemsMain3.appendChild(ivaSpan);


    cont_prodotti.appendChild(itemsMain);
    itemsMain.appendChild(itemsMain2);
    itemsMain2.appendChild(itemsMain3);
  })
}

function ricercaProd(event){
  event.preventDefault();

  //invio del titolo del prodotto tramite post
  const form_data = new FormData(document.getElementById("ricerca_prod"));
  const formData = new FormData();

  formData.append('titolo', form_data.get('search'));
  console.log(formData);
  
  /*const modale = document.getElementById('ricercaModal');
  modale.classList.add('no-scroll');*/

  fetch("search_product.php", {method: 'POST', body: formData}).then(onResponseProd).then(jsonSearch);
}

function saveCart(event){
  const evento = event;
  console.log("Salvataggio nel carello");

  fetch("verify.php")
  .then(response => response.json())
  .then(data => {
      if (data.logged_in) {
          addToCart(evento);
      } else {
          // User is not logged in, show a message
          alert("Loggati prima di inserire prodotti nel carrello");
          window.location.href = 'myAccount.php'; // Redirect to login page
      }
  })
}

function addToCart(event){
  const button = event.target;
    //const productId = button.dataset.id;
  const salvataggio = button.closest('.itemsMain');
  const salvataggio_span = salvataggio.querySelector('.salvato');
    
  salvataggio_span.classList.remove('hidden');
  
  //invio dell'id prodotto
  const card = event.currentTarget;
  const formData = new FormData();
  
  formData.append('id', button.dataset.id);
  console.log(formData);
    
  
  fetch("saveCart.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
  event.stopPropagation();
}

const searchForm = document.getElementById('ricerca_prod');

searchForm.addEventListener("submit", ricercaProd);

//-------------BOTTONE PRECEDENTE DOPO---------------

  const scrollContainer = document.getElementById('Prodotti');
  const nextButton = document.getElementById('next');
  const prevButton = document.getElementById('prev');

    nextButton.addEventListener('click', () => {
        scrollContainer.scrollBy({
            left: 300, // Distanza in pixel da scorrere
            behavior: 'smooth'
        });
    });

    prevButton.addEventListener('click', () => {
        scrollContainer.scrollBy({
            left: -300, // Distanza in pixel da scorrere all'indietro
            behavior: 'smooth'
        });
    });

//------------Fetch Prodotti Cart--------

function onResponseCart(response){
  console.log(response.status);
  console.log('Risposta Arrivata');

  if(!response.ok){
      console.log('Risposta non Valida');
      return null;
  } else return response.json();
}

function onJsonCart(json){
  console.log("Json Prod Cons Arrivato");
  console.log(json);

  const cont_prodotti = document.querySelector('.ProdottiCart');
  cont_prodotti.innerHTML = '';
  const prodotti = Object.values(json); // Converto l'oggetto in un array

  prodotti.forEach(prodotto => {
    const itemsMain = document.createElement('div');
    itemsMain.classList.add('itemsMain');

    const itemsMain2 = document.createElement('div');
    itemsMain2.classList.add('itemsMain2');

    // Aggiungo immagine del prodotto
    if (prodotto.immagini && prodotto.immagini.length > 0) {
      let link = document.createElement('a');
      console.log(prodotto.id);
      link.href = "dettagli_prodotto.php?id=" + prodotto.id;

      const contenitor_img = document.createElement('div');
      contenitor_img.classList.add("img_product");
      img = document.createElement('img');
      contenitor_img.appendChild(img);
      
      img.src = prodotto.immagini[0]; // Usa la prima immagine come copertina
      img.alt = prodotto.titolo;

      link.appendChild(contenitor_img);
      itemsMain2.appendChild(link);
    } else {
        itemsMain2.appendChild(document.createTextNode('Immagine non disponibile'));
      }

    // Aggiungo titolo del prodotto
    const titleSpan = document.createElement('span');
    titleSpan.textContent = prodotto.titolo;
    itemsMain2.appendChild(titleSpan);

    const carrello = document.createElement("button");
    carrello.dataset.id = prodotto.id;
    carrello.textContent = "Rimuovi dal Carrello";
    itemsMain2.appendChild(carrello);
    carrello.classList.add("bottone_carrello");

    //-----Carrello-------
    carrello.addEventListener('click', removeCart);
    
    const itemsMain3 = document.createElement('div');
    itemsMain3.classList.add('itemsMain3');

    // Aggiungo prezzo
    const priceSpan = document.createElement('span');
    priceSpan.textContent = '€' + parseFloat(prodotto.prezzo).toFixed(2);
    itemsMain3.appendChild(priceSpan);

    const ivaSpan = document.createElement('span');
    ivaSpan.textContent = 'Iva Inclusa';
    itemsMain3.appendChild(ivaSpan);


    cont_prodotti.appendChild(itemsMain);
    itemsMain.appendChild(itemsMain2);
    itemsMain2.appendChild(itemsMain3);
  })
}

fetch("get_products_cart.php").then(onResponseCart).then(onJsonCart);


//------------Remove Cart-----------------
function dispatchResponse(response){
  console.log(response);
  return response.json().then(databaseJResponse);
}

function dispatchError(error){
  console.log("Errore: ");
}

function databaseJResponse(json){
  updateCartCount();

  if(!json.ok){
    console.log("errore json");
    dispatchError();
    return null;
  }
}

function removeCart(event){
  console.log("Rimuovo dal carello");
  const button = event.target;
  const productId = button.dataset.id;
  const productDiv = button.closest('.itemsMain');
  productDiv.remove();
  const card = event.currentTarget;
  const formData = new FormData();

  formData.append('id', card.dataset.id);
  console.log(formData);
  

  fetch("removeCart.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
  event.stopPropagation();
}

//----------Count Cart--------------------
function updateCartCount(){
  fetch('get_cart_count.php')
    .then(response => response.json())
    .then(data => {
        // Aggiorna lo span con il nuovo conteggio ottenuto dal server
        const cartCountSpan = document.getElementById('cart-count');
        cartCountSpan.textContent = data.cartCount;
    })
    .catch(error => {
        console.error('Si è verificato un errore:', error);
  });
}

const count_card = document.getElementById('cart-count');
count_card.addEventListener('DOMContentLoaded', updateCartCount());

//--------MODALE CATEGORIE----------

function apriModale(event){
  const modale_categorie = document.getElementById('categModal');
  modale_categorie.classList.remove('hidden');
}

function chiudiModale(event){
  const modale_categorie = document.getElementById('categModal');
  modale_categorie.classList.add('hidden');
}

//quando clicco sull'img menu o su categorie
const modale_categorie = document.querySelector('.modaleCat');
modale_categorie.addEventListener('click', apriModale);

//chiudi quando clicco su img close
const close = document.getElementById('close');
close.addEventListener('click', chiudiModale);