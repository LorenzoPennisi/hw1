function onThumbnailClick(event){
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

const esci = document.querySelector('#ricercaModal');
esci.addEventListener('click', hiddenOnClick);

//-----------------------MODALE IMG PRODOTTO--------------------------


function apriModale(event){
  document.body.classList.add('no-scroll');

  const img_modal_view = document.getElementById('img_modale');
  img_modal_view.innerHTML = '';
  img_modal_view.style.top = window.pageYOffset + 'px';

  const gif = document.createElement("img");
  gif.src = "immagini per homework/gif_caricamento.gif";
  gif.classList.add('gif');
  img_modal_view.appendChild(gif);

  const img_prodotto = document.createElement("img");
  img_prodotto.src = event.target.src;
  gif.classList.add('hidden');
  img_modal_view.appendChild(img_prodotto);
  img_modal_view.classList.remove('hidden');
}

function hiddenModal(event){
  if(event.target.id == 'img_modale'){
    document.body.classList.remove('no-scroll');

    img_modal_view.classList.add('hidden');
  }
}

const img_prod = document.querySelector('.immagini_prod');
img_prod.addEventListener('click', apriModale);

const img_modal_view = document.querySelector('#img_modale');
img_modal_view.addEventListener('click', hiddenModal);
