<?php 
  require_once 'auth.php';
  if (!$userid = checkAuth()) {
      //header("Location: login.php");
      //exit;
  }
?>

<!DOCTYPE html>
<html>
  <?php
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    if(checkAuth()){
      $userid = mysqli_real_escape_string($conn, $userid);
      $query = "SELECT * FROM user WHERE id = $userid";
      $res_1 = mysqli_query($conn, $query);
      $userinfo = mysqli_fetch_assoc($res_1);
    }
  ?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="stylesheet" href="home.css" />
  <script src="hw1.js" defer></script>
  <script src="API_YT.js" defer></script>

  <link rel="icon" type="image/png" sizes="32x32"
    href="https://shop.akinformatica.it/wp-content/themes/ak-informatica/dist/images/favicon/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16"
    href="https://shop.akinformatica.it/wp-content/themes/ak-informatica/dist/images/favicon/favicon-16x16.png" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet"/>

  <title>Ak Informatica</title>
</head>

<body>
<div class="scroll">
  <nav>
    <img id="menuMobile" src="immagini per homework/menuSfondoNero.png" alt="" />
    <div id="blocco1">
      <a href="home.php">
        <img src="immagini per homework/image.png" />
      </a>
    </div>

    <div id="sfondoR">
      <div class="barraRicerca">
        <input id="barra" placeholder=" Cerca prodotti..."></input>
      </div>
    </div>

    <div id="bloccoNero">
      <span>Scopri</span>

      <div>
        <img height="10px" width="auto"
          src="https://shop.akinformatica.it/wp-content/themes/ak-informatica/dist/images/logo-scopri-ak.png" />
      </div>
      <span>>></span>
    </div>

    <div class="bloccoR">
      <div id="BloccoItemsR">
        <div class="itemsR">
        <div>
            <a <?php if(checkAuth()){echo "href=profilo.php";}else{echo "href=myAccount.php";} ?>>
              <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M12.2266 12.375C11.0938 12.375 10.5859 13 8.75 13C6.875 13 6.36719 12.375 5.23438 12.375C2.34375 12.375 0 14.7578 0 17.6484V18.625C0 19.6797 0.820312 20.5 1.875 20.5H15.625C16.6406 20.5 17.5 19.6797 17.5 18.625V17.6484C17.5 14.7578 15.1172 12.375 12.2266 12.375ZM15.625 18.625H1.875V17.6484C1.875 15.7734 3.35938 14.25 5.23438 14.25C5.82031 14.25 6.71875 14.875 8.75 14.875C10.7422 14.875 11.6406 14.25 12.2266 14.25C14.1016 14.25 15.625 15.7734 15.625 17.6484V18.625ZM8.75 11.75C11.8359 11.75 14.375 9.25 14.375 6.125C14.375 3.03906 11.8359 0.5 8.75 0.5C5.625 0.5 3.125 3.03906 3.125 6.125C3.125 9.25 5.625 11.75 8.75 11.75ZM8.75 2.375C10.7812 2.375 12.5 4.09375 12.5 6.125C12.5 8.19531 10.7812 9.875 8.75 9.875C6.67969 9.875 5 8.19531 5 6.125C5 4.09375 6.67969 2.375 8.75 2.375Z"
                  fill="#FBFBFB"></path>
              </svg>
            </a>
          </div>
        </div>

        <div class="itemsR">
          <?php
            if(!checkAuth()){
              echo('<a class="link-nav" href="myAccount.php">&nbsp;Accedi</a>');
            } else{
              echo('<a class="link-nav" href="profilo.php">&nbsp;My Account</a>');
            }
          ?>
        </div>

        <div class="itemsR">
          <a href="cart.php">
            <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M21.5234 3H5.625L5.27344 1.28125C5.19531 0.851562 4.80469 0.5 4.375 0.5H0.46875C0.195312 0.5 0 0.734375 0 0.96875V1.90625C0 2.17969 0.195312 2.375 0.46875 2.375H3.59375L6.28906 16.2812C5.85938 16.75 5.625 17.3359 5.625 18C5.625 19.4062 6.71875 20.5 8.125 20.5C9.49219 20.5 10.625 19.4062 10.625 18C10.625 17.6484 10.4688 17.1016 10.2734 16.75H15.9375C15.7422 17.1016 15.625 17.6484 15.625 18C15.625 19.4062 16.7188 20.5 18.125 20.5C19.4922 20.5 20.625 19.4062 20.625 18C20.625 17.2969 20.3125 16.6719 19.8438 16.2031L19.8828 16.0469C20 15.4609 19.5703 14.875 18.9453 14.875H7.92969L7.57812 13H19.7656C20.2344 13 20.5859 12.7266 20.7031 12.2969L22.4609 4.17188C22.5781 3.58594 22.1484 3 21.5234 3ZM8.125 18.9375C7.57812 18.9375 7.1875 18.5469 7.1875 18C7.1875 17.4922 7.57812 17.0625 8.125 17.0625C8.63281 17.0625 9.0625 17.4922 9.0625 18C9.0625 18.5469 8.63281 18.9375 8.125 18.9375ZM18.125 18.9375C17.5781 18.9375 17.1875 18.5469 17.1875 18C17.1875 17.4922 17.5781 17.0625 18.125 17.0625C18.6328 17.0625 19.0625 17.4922 19.0625 18C19.0625 18.5469 18.6328 18.9375 18.125 18.9375ZM19.0234 11.125H7.1875L5.97656 4.875H20.3906L19.0234 11.125Z"
                fill="#FBFBFB"></path>
            </svg>
          </a>
          <span id="cart-count">
            
          </span>
        </div>

        <div class="itemsR">
          <a class="link-nav" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </nav>

  <header>
    <div id="bottoni">
      <img id="menu" class="modaleCat" src="immagini per homework/menu.png" alt="" />
      <div id="categModal" class="hidden">
        <img id="close" src="immagini per homework/close.svg" alt="close">
        <h4>Seleziona per categoria:</h4>
        <div class="itemCatMod">
          <a href="prodotti_categoria.php?categoria=Processore">- Processori ></a>
        </div>

        <div class="itemCatMod">
          <a href="prodotti_categoria.php?categoria=Scheda Video">- Schede Video ></a>
        </div>

        <div class="itemCatMod">
          <a href="prodotti_categoria.php?categoria=Scheda Madre">- Schede Madri ></a>
        </div>

        <div class="itemCatMod">
          <a href="prodotti_categoria.php?categoria=Memorie">- Memorie ></a>
        </div>
      </div>
      <span class="modaleCat">Categorie</span>
      <a href="https://shop.akinformatica.it/shop/">Catalogo Prodotti</a>

      <a id="linkRosso" href="https://shop.akinformatica.it/tag/offerte-top/">Offerte TOP
      </a>

      <a href="https://shop.akinformatica.it/ak-rig/">PC AK RIG</a>

      <a href="https://shop.akinformatica.it/tag/usato-fiera-lucca-comics-2023/">Usato LuccaComics</a>

      <img id="spedizione" src="immagini per homework/spedizione_gratuita.png" alt="" />
    </div>

    <div id="barraMobile">
      <span>Cerca prodotti...</span>
    </div>
  </header>

  <section>
    <div id="imm">
      <div id="sliderHome">
        <img
          src="https://shop.akinformatica.it/wp-content/uploads/2024/02/04.-DEEPCOOL-CH780MYSTIQUE-desktop-1920x400.png"
          alt="" />

        <img
          src="https://shop.akinformatica.it/wp-content/uploads/2024/01/OFFERTE-TROPPO-TOP-hero-banner-desktop-1920x400.png"
          alt="">

        <img
          src="https://shop.akinformatica.it/wp-content/uploads/2024/04/18.-DEEPCOOL-COMPO-DAYS-hero-banner-desktop-1920x400.png"
          alt="">

        <img src="https://shop.akinformatica.it/wp-content/uploads/2024/05/17.-AKLUB-hero-banner-desktop-1920x400.png"
          alt="">

        <img
          src="https://shop.akinformatica.it/wp-content/uploads/2024/04/12.-AK-KIT-GAME-READY-hero-banner-desktop-1920x400.png"
          alt="">

        <img
          src="https://shop.akinformatica.it/wp-content/uploads/2024/04/13.-MSI-COMPO-NUOVA-CAMPAGNA-PBM-hero-banner-desktop-1920x400.png"
          alt="">
      </div>
    </div>

    <div class="AkConsiglia">
      <div class="blocchi"></div>
      AK CONSIGLIA
      <div class="blocchi"></div>
    </div>


    <div class="main">
      <div class="Prodotti">
        
      </div>
    </div>

    <div id="imm2">
      <img
        src="https://shop.akinformatica.it/wp-content/uploads/2023/01/akinformatica-webdesign-22-homepage-akrig-section.jpg"
        alt="" />
    </div>

    <div class="AkConsiglia">
      <div class="blocchi"></div>
      PRODOTTI IN VENDITA
      <div class="blocchi"></div>
    </div>

    <div class="main">
      <div class="ProdottiInEvidenza">
            
      </div>
    </div>

    <div class="AkConsiglia">
      <div class="blocchi"></div>
      CATEGORIE IN EVIDENZA
      <div class="blocchi"></div>
    </div>

    <div class="main">
      <div class="Categorie1">
        <div class="categorie2">
          <div class="categorie3">
            <h2>PC Desktop</h2>
            <div class="categorie4">
              <div class="categorie5">
                <span>PC Gaming AK RIG</span>
                <span>PC Compatti e Mini-PC</span>
                <span>PC All in One</span>
              </div>
              <img src="immagini per homework/Categorie/pcdesktop.jpg" alt="">
            </div>

          </div>
        </div>
        <div class="categorie2">
          <div class="categorie3">
            <h2>Notebook</h2>
            <div class="categorie4">
              <div class="categorie5">
                <span>Notebook Gaming</span>
                <span>Notebook Creator</span>
                <span>Notebook Office</span>
              </div>
              <img src="immagini per homework/Categorie/notebook-category-home.jpg" alt="">
            </div>
          </div>
        </div>
        <div class="categorie2">
          <div class="categorie3">
            <h2>Componenti Hardware</h2>
            <div class="categorie4">
              <div class="categorie5">
                <span>Processori</span>
                <span>Schede Video</span>
                <span>Schede Madri</span>
                <span>Memorie</span>
              </div>
              <img src="immagini per homework/Categorie/componenti-category-home.png" alt="">
            </div>
          </div>
        </div>
      </div>

      <div class="Categorie1">
        <div class="categorie2">
          <div class="categorie3">
            <h2>Sim Racing</h2>
            <div class="categorie4">
              <div class="categorie5">
                <span>Simulatori di Guida</span>
                <span>Volanti e Pedaliere</span>
                <span>Accessori Simultaori</span>
              </div>
              <img src="immagini per homework/Categorie/simracing-1.jpg" alt="">
            </div>
          </div>
        </div>
        <div class="categorie2">
          <div class="categorie3">
            <h2>Monitor</h2>
            <div class="categorie4">
              <div class="categorie5">
                <span>Monitor Gaming</span>
                <span>Monitor Creator</span>
                <span>Monitor Office</span>
              </div>
              <img src="immagini per homework/Categorie/monitor1.jpg" alt="">
            </div>
          </div>
        </div>
        <div class="categorie2">
          <div class="categorie3">
            <h2>Storage</h2>
            <div class="categorie4">
              <div class="categorie5">
                <span>SSD</span>
                <span>Hard Disk</span>
                <span>NAS</span>
              </div>
              <img src="immagini per homework/Categorie/storage.jpg" alt="">
            </div>
          </div>
        </div>
      </div>

      <div class="Categorie1">
        <div class="categorie2">
          <div class="categorie3">
            <h2>Altri Componenti</h2>
            <div class="categorie4">
              <div class="categorie5">
                <span>Alimentatori</span>
                <span>Case</span>
                <span>Dissipatori CPU</span>
              </div>
              <img src="immagini per homework/Categorie/altri-componenti.jpg" alt="">
            </div>
          </div>
        </div>
        <div class="categorie2">
          <div class="categorie3">
            <h2>Periferiche Gaming</h2>
            <div class="categorie4">
              <div class="categorie5">
                <span>Tastiere</span>
                <span>Mouse</span>
                <span>Cuffie</span>
              </div>
              <img src="immagini per homework/Categorie/PERIFERICHE-GAMING.jpg" alt="">
            </div>
          </div>
        </div>
        <div class="categorie2">
          <div class="categorie3">
            <h2>Arredo Gaming</h2>
            <div class="categorie4">
              <div class="categorie5">
                <span>Poltrone Gaming</span>
                <span>Scrivanie Gaming</span>
              </div>
              <img src="immagini per homework/Categorie/SEDIE-GAMING-2.jpg" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="_2blocchi">
      <div class="block">
        <img
          src="immagini per homework/Categorie/akinformatica-website-22-schede_video_disonibili-spotlight.jpg"
          alt="">
      </div>
      <div class="block">
        <img
          src="immagini per homework/Categorie/akinformatica-webdesign-23-nvidia-upgrade-riflettore_desktop.jpg"
          alt="">
      </div>
    </div>

    <div class="AkConsiglia">
      <div class="blocchi"></div>
      BRAND STORE
      <div class="blocchi"></div>
    </div>

    <div class="brandStore">
      <div class="blocchiBrandStore">
        <div class="itemsBrandStore">
          <img src="immagini per homework/Brand Store/brandstore-coolermaster.png" alt="">
        </div>
        <div class="itemsBrandStore">
          <img src="immagini per homework/Brand Store/brandstore-deepcool.png" alt="">
        </div>
        <div class="itemsBrandStore">
          <img src="immagini per homework/Brand Store/brandstore-msi-business.png" alt="">
        </div>
        <div class="itemsBrandStore">
          <img src="immagini per homework/Brand Store/brandstore-msi-gaming.png" alt="">
        </div>
        <div class="itemsBrandStore">
          <img src="immagini per homework/Brand Store/brandstore-kingston.png" alt="">
        </div>
        <div class="itemsBrandStore">
          <img src="immagini per homework/Brand Store/brandstore-fractal.png" alt="">
        </div>
      </div>

      <div class="blocchiBrandStore">
        <div class="itemsBrandStore">
          <img src="immagini per homework/Brand Store/brandstore-sharkoon.png" alt="">
        </div>
        <div class="itemsBrandStore">
          <img src="immagini per homework/Brand Store/brandstore-wd.png" alt="">
        </div>
        <div class="itemsBrandStore">
          <img src="immagini per homework/Brand Store/brandstore-intel.png" alt="">
        </div>
        <div class="itemsBrandStore">
          <img src="immagini per homework/Brand Store/brandstore-samsung.png" alt="">
        </div>
        <div class="itemsBrandStore">
          <img src="immagini per homework/Brand Store/brandstore-nvidia.png" alt="">
        </div>
        <div class="itemsBrandStore">
          <img src="immagini per homework/Brand Store/pny.png" alt="">
        </div>
      </div>
    </div>

    <div id="pagamentoAgevolato">
      <div class="testoPA"></div>
      <span>SCOPRI I NOSTRI METODI DI PAGAMENTO AGEVOLATI</span>
      <div class="testoPA"></div>

      <div class="testoPA"></div>
      <span>RICONDIZIONATO</span>
      <div class="testoPA"></div>
    </div>

    <div id="blocchiPA">
      <div class="subBlocchiPA">
        <img src="immagini per homework/Brand Store/banner_homepage-findomestic.jpg" alt="">
      </div>
      <div class="subBlocchiPA">
        <img src="immagini per homework/Brand Store/banner_homepage-klarna.jpg" alt="">
      </div>
      <div class="subBlocchiPA">
        <img src="immagini per homework/Brand Store/akinformatica-webdesign-23-baktothefuture-banner_hp.png"
          alt="">
      </div>
    </div>

    <div class="AkConsiglia">
      <div class="blocchi"></div>
      IMPARA ANCHE TU A BUILDARE UN PC
      <div class="blocchi"></div>
    </div>

    <div id="youtube">
    </div>
  </section>
</div>


  <section id="ricercaModal" class="hidden">
    <div id="vistaModal">

      <div id="headerModal">

        <img src="immagini per homework/porsche-akinformatica.jpg" alt="cerca">
        
        <div id="barraRicercaModal">
          <div id="barraRicercaModal2">
            <form name='ricerca_prod' id='ricerca_prod' autocomplete="off">
              <div id="ricerca_prod_input_text">
                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M15.5 14h-.79l-.28-.27c1.2-1.4 1.82-3.31 1.48-5.34-.47-2.78-2.79-5-5.59-5.34-4.23-.52-7.79 3.04-7.27 7.27.34 2.8 2.56 5.12 5.34 5.59 2.03.34 3.94-.28 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                  </path>
                </svg>

                <label><input type="text" name='search' id='search' placeholder=" Ricerca Prodotto..."></label>
                <label for="submit"><input type="submit" name="submit" id="submit" value="Cerca"></label>
              </div>

              

              <!--
              <select name="categoria" id="categoria">
                <option value="Desktop PC">Desktop PC</option>
                <option value="Schede video e grafiche">Schede video e grafiche</option>
                <option value="Componenti e parti">Componenti e parti</option>
                <option value="Notebook, laptop e portatili">Notebook, laptop e portatili</option>
              </select>
              -->
            </form>

            <img
              src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='36px' height='36px'%3E%3Cpath d='M0 0h24v24H0V0z' fill='none'%3E%3C/path%3E%3Cpath d='M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z'%3E%3C/path%3E%3C/svg%3E"
              alt="close" id="closeButtomModal">
          </div>

          <div id="ultimeRicerche">
            <div class="testoRicerche"><span>Ultime ricerche:</span></div>
            <div class="itemsRicerche">
              <?php 
                if(isset($_POST['search'])){echo $_POST['search'];}
              ?>
              <img
                src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='36px' height='36px'%3E%3Cpath d='M0 0h24v24H0V0z' fill='none'%3E%3C/path%3E%3Cpath d='M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z'%3E%3C/path%3E%3C/svg%3E"
                alt="">
            </div>
            <div class="itemsRicerche">
              4070
              <img
                src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='36px' height='36px'%3E%3Cpath d='M0 0h24v24H0V0z' fill='none'%3E%3C/path%3E%3Cpath d='M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z'%3E%3C/path%3E%3C/svg%3E"
                alt="">
            </div>
            <div class="itemsRicerche">
              4080
              <img
                src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='36px' height='36px'%3E%3Cpath d='M0 0h24v24H0V0z' fill='none'%3E%3C/path%3E%3Cpath d='M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z'%3E%3C/path%3E%3C/svg%3E"
                alt="">
            </div>
            <div class="itemsRicerche">
              Msi Laptop
              <img
                src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='36px' height='36px'%3E%3Cpath d='M0 0h24v24H0V0z' fill='none'%3E%3C/path%3E%3Cpath d='M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z'%3E%3C/path%3E%3C/svg%3E"
                alt="">
            </div>
            <!-- <div id="rosso">Cancella tutto</div> -->
          </div>
        </div>
      </div>

      <div id="sectionModal">
        <div id="ricerchePopModal">
          <h3>Ricerche Popolari</h3>
          <span>pc gaming</span>
          <span>fanatec</span>
          <span>pc</span>
          <span>4070 super</span>
          <span>4070</span>
          <span>4090</span>
          <span>case</span>
          <span>4080 super</span>
          <span>simulatore</span>
          <span>monitor</span>
        </div>

        <div id="prodRisultModal">
          <h3>Risultati Ricerca:</h3>
          <div id="Risultati">
            <button class="hidden" id="prev"><</button>
            <div id="Prodotti">

            </div>
            <button class="hidden" id="next">></button>
          </div>
        </div>
      </div>
    </div>
  </section>

<div class="scroll">

  <div id="sopraFooter">
    <div class="sopraF">
      <img src="immagini per homework/akinformatica-webdesign-22-casehistory-banner_home-3.jpg" alt="" />
    </div>

    <div class="sopraFmobile">
      <a href="https://shop.akinformatica.it/about-ak/">
        <img loading="lazy" decoding="async"
          src="https://shop.akinformatica.it/wp-content/uploads/2022/07/akinformatica-webdesign-22-casehistory-banner_home-mobile-2.jpg"
          alt=""
          srcset="https://shop.akinformatica.it/wp-content/uploads/2022/07/akinformatica-webdesign-22-casehistory-banner_home-mobile-2.jpg 490w, https://shop.akinformatica.it/wp-content/uploads/2022/07/akinformatica-webdesign-22-casehistory-banner_home-mobile-2-300x245.jpg 300w, https://shop.akinformatica.it/wp-content/uploads/2022/07/akinformatica-webdesign-22-casehistory-banner_home-mobile-2-245x200.jpg 245w, https://shop.akinformatica.it/wp-content/uploads/2022/07/akinformatica-webdesign-22-casehistory-banner_home-mobile-2-64x52.jpg 64w">
      </a>
    </div>
  </div>

  <footer>
    <div class="footer2">
      <a href="https://shop.akinformatica.it/serve-aiuto/" title="Serve aiuto?">
        <div id="footer-icon-1">
          <figure><img src="https://shop.akinformatica.it/wp-content/uploads/2022/01/ak-serve-aiuto.png" alt=""
              decoding="async" loading="lazy"></figure>
          <span>Serve aiuto?</span>
        </div>
      </a>
      <a href="https://shop.akinformatica.it/negozi-e-contatti/" title="Negozi &amp; Contatti">
        <div id="footer-icon">
          <figure><img src="https://shop.akinformatica.it/wp-content/uploads/2022/01/ak-negozi.png" alt=""
              decoding="async" loading="lazy"></figure>
          <span>Negozi &amp; Contatti</span>
        </div>
      </a>
      <a href="https://shop.akinformatica.it/spedizioni-e-resi/" title="Spedizione &amp; Resi">
        <div id="footer-icon">
          <figure><img src="https://shop.akinformatica.it/wp-content/uploads/2022/01/ak-spedizione.png" alt=""
              decoding="async" loading="lazy"></figure>
          <span>Spedizione &amp; Resi</span>
        </div>
      </a>
      <a href="https://shop.akinformatica.it/pagamenti/" title="Pagamento &amp; Rimborsi">
        <div id="footer-icon">
          <figure><img src="https://shop.akinformatica.it/wp-content/uploads/2022/01/ak-pagamenti.png" alt=""
              decoding="async" loading="lazy"></figure>
          <span>Pagamento &amp; Rimborsi</span>
        </div>
      </a>
      <a href="https://shop.akinformatica.it/ak-big-warranty/" title="AK big Warranty">
        <div id="footer-icon-5">
          <figure class="float-left"><img
              src="https://shop.akinformatica.it/wp-content/uploads/2022/01/ak-big-warranty.png" alt="" decoding="async"
              loading="lazy"></figure>
          <span>AK big Warranty</span>
        </div>
      </a>
    </div>

    <div id="footer2">
      <img src="immagini per homework/ak-logo-footer.png" alt="">
      <div id="info">
        Ak Informatica
        Tech S.r.l.<br>
        Via Cremasca 1 Azzano San Paolo (BG) | P.IVA 03172330163 <br>

        <a href="https://shop.akinformatica.it/privacy-policy/" title="Privacy Policy">
          Privacy Policy |
        </a>
        <a href="https://shop.akinformatica.it/cookies-e-trattamento-dati/" title="Cookies e Trattamento Dati">
          Cookies e Trattamento Dati |
        </a>
        <a href="https://shop.akinformatica.it/termini-di-utilizzo-del-sito/" title="Termini di Utilizzo del Sito">
          Termini di Utilizzo del Sito |
      </div>

      <div id="social">
        <span>Seguici su:</span>
        <a href="https://www.facebook.com/AKinformaticaSNC" title="Facebook">
          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
            class="w-5 h-5">
            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z">
            </path>
          </svg>
        </a> 
        
        <a href="https://www.linkedin.com/company/ak-informatica" target="_blank" rel="noreferrer" title="Twitter">
          <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
            stroke-linejoin="round" stroke-width="0" viewBox="0 0 24 24" class="w-5 h-5">
            <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
            </path>
            <circle cx="4" cy="4" r="2" stroke="none"></circle>
          </svg>
        </a> 

        <a href="https://twitter.com/AkInformatica" target="_blank" rel="noreferrer" title="Instagram">
          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5">
            <path
              d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
            </path>
          </svg>
        </a> 
        <a href="https://www.instagram.com/akinformaticagaming"
          title="Linkedin">
          <svg fill="none" stroke="currentColor" stroke-linecap="round"
            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
          </svg>
        </a>
      </div>
    </div>
  </footer>
</div>
</body>

</html>