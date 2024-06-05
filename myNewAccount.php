<?php
    require_once 'auth.php';

    if (checkAuth()) {
        header("Location: home.php");
        exit;
    }   

    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["name"]) && 
        !empty($_POST["surname"]) && !empty($_POST["confirm_password"]) && !empty($_POST["allow2"]))
    {
        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT username FROM user WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }

        if (strlen($_POST["password"]) < 8) {
            $error[] = "Caratteri password insufficienti";
        } 

        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }

        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO user (username, password, name, surname, email) VALUES('$username', '$password', '$name', '$surname', '$email')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["user_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }
        mysqli_close($conn);
    }
    else if (isset($_POST["username"])) {
        $error = array("Riempi tutti i campi");
    }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="stylesheet" href="myNewAccount.css" />
  <script src="myNewAccount.js" defer></script>

  <link rel="icon" type="image/png" sizes="32x32"
    href="https://shop.akinformatica.it/wp-content/themes/ak-informatica/dist/images/favicon/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16"
    href="https://shop.akinformatica.it/wp-content/themes/ak-informatica/dist/images/favicon/favicon-16x16.png" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet"/>
  <title>New Account - Ak Informatica</title>
</head>
<body>
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
    <h2>Registrati</h2>

    <div class="banner">
      <form name='signup' method='post' enctype="multipart/form-data" autocomplete="off">
        <div class="name">
          <label for='name'>Nome&nbsp;<p>*</p></label>
          <!-- Se il submit non va a buon fine, il server reindirizza su questa stessa pagina, quindi va ricaricata con 
          i valori precedentemente inseriti -->
          <input type='text' name='name' <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?> >
          <div class="errorp">
            <div><img src="immagini per homework/close.svg"/><span>Devi inserire il tuo nome</span></div>
          </div>
        </div>      

        <div class="surname">
          <label for='surname'>Cognome&nbsp;<p>*</p></label>
          <input type='text' name='surname' <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?> >
          <div class="errorp">
            <div><img src="immagini per homework/close.svg"/><span>Devi inserire il tuo cognome</span></div>
          </div>
        </div>
        
        <div class="username">
          <label for='username'>Nome utente&nbsp;<p>*</p></label>
          <input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
          <div class="errorp">
            <div><img src="immagini per homework/close.svg"/><span></span></div>
          </div>
        </div>
                
        <div class="email">
          <label for='email'>Email&nbsp;<p>*</p></label>
          <input type='text' name='email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
          <div class="errorp">
            <div><img src="immagini per homework/close.svg"/><span>Indirizzo email non valido</span></div>
          </div>
        </div>

        <div class="password">
          <label for='password'>Password&nbsp;<p>*</p></label>
          <input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
          <div class="errorp">
            <div><img src="immagini per homework/close.svg"/><span>Inserisci almeno 8 caratteri</span></div>
          </div>
        </div>

        <div class="confirm_password">
          <label for='confirm_password'>Conferma Password&nbsp;<p>*</p></label>
          <input type='password' name='confirm_password' <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>>
          <div class="errorp">
            <div><img src="immagini per homework/close.svg"/><span>Le password non coincidono</span></div>
          </div>
        </div>

        <div class="allow"> 
          <input type='checkbox' name='allow1' value="1" <?php if(isset($_POST["allow1"])){echo $_POST["allow1"] ? "checked" : "";} ?>>
          <label for='allow1'>Acconsento all'utilizzo dei miei dati per attivita' di Marketing e profilazione (opzionale)</label>
        </div>

        <div class="allow"> 
          <div class="mess">
            <span></span>
          </div>
          
          <input type='checkbox' name='allow2' value="1" <?php if(isset($_POST["allow2"])){echo $_POST["allow2"] ? "checked" : "";} ?>>
          <label for='allow2'>Autorizzo il trattamento dei dati personali secondo l'informativa sulla privacy resa ai sensi del regolamento UE 2016/679<p>&nbsp;*</p>.</label>
        </div>

        <?php 
          if(isset($error)) {
            foreach($error as $err) {
              echo "<div class='errorj'><img src='immagini per homework/close.svg'/><span>".$err."</span></div>";
            }
          } 
        ?>

        <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo '<h2>Dati del Form:</h2>';
            echo '<pre>';
            print_r($_POST);
            echo '</pre>';
          }
        ?>
                
        <div class="submit">
          <input type='submit' value="Registrati" id="submit">
        </div>
      </form>
    </div>
  </section>

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
</body>
</html>