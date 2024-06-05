<?php
    //Traemos el valor del parámetro error. Si existe "error" y es igual a "si"
    if(isset($_GET['error']) && $_GET['error']==1){
        //Saca una pestaña emergente con el mensaje
        echo '<script>
            if(localStorage.getItem("selectedLanguage") === "en_EN") {
                alert("The user does not exist or the password is incorrect.");
            } else {
                alert("El usuario no existe o la contraseña es incorrecta.");
            }
        </script>';
    }
    //Si existe "registro" y es igual a "si", saca una pestaña emergente con el mensaje
    if(isset($_GET['registro']) && $_GET['registro']=="si"){
        echo '<script>
            if(localStorage.getItem("selectedLanguage") === "en_EN") {
                alert("Log up completed, you can now sign in.");
            } else {
                alert("Registro completado, ya puedes iniciar sesión.");
            }
        </script>';
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <!-- Título de la app -->
    <title id="titlePagSignin">eXamUp - Iniciar sesión</title>
      
    <!-- Links a estilos de bootstrap -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Icono en la pestaña -->
    <link rel="icon" href="../assets/brand/logotipo2.png">
      <!-- CDN Fontawesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
      <!-- CDN jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Archivo de scripts donde se encuentran las funciones -->
    <script src="../js/scripts.js"></script>
    <!-- Link al css de sing-in -->
    <link href="sign-in.css" rel="stylesheet">
      
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
        /* Color del fondo */
        body {
            /* background: #F3E992;
            background: linear-gradient(90deg, #F3E992 45%, #F78A62 100%); */
        }
        /* Cargar tipos de fuente  */
        @font-face{
            font-family: matisan;
            src: url("../fonts/matisan.otf")
        }
        /* Estilos del logo */
        #logo-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 20px;
        }
       
    </style>
  </head>
  <body class="text-center">
    <main class="form-signin w-100 m-auto">
        <!--Formulario de inicio de sesión-->
        <form action="conf_signin.php" method="post">
            <div id="logo-container">
                <h1 style="font-family:matisan; font-size:75px; color:#3278c8;">e<img class="mb-4" src="../assets/brand/logotipo2.png" alt="" width="60" height="60">amUp</h1>
            </div>
            <h2 class="h3 mb-3 fw-normal" id="headlineSignin" style="font-size:22px; margin-top:30px;">Iniciar sesión</h2>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputSignin" placeholder="Username" name="username" required>
                <label for="floatingInputSignin">Usuario</label>
            </div>
            <div class="form-floating" style="margin-bottom:30px;">
                <input type="password" class="form-control" id="floatingPasswordSignin" placeholder="Password" name="password" required>
                <label for="floatingPasswordSignin">Contraseña</label>
            </div>
            <!-- Botón de signin --> 
            <button class="w-100 btn btn-lg btn-primary" id="buttonaccessSignin" type="submit" style="background:#0d6efd; border:none; margin-bottom:10px;">Acceder</button>
            <!-- Botón para ir a registrarse --> 
        </form>
        <form action="../signup/signup.php">
            <button class="w-100 btn btn-lg btn-primary" id="signupbutton" style="background:#596060; border:none;">Registrarse</button>
        </form>
        <!-- PIE DE PAGINA -->
        <p class="mt-5 mb-3 text-muted">&copy; ExamUp</p>
        <!--Enlace a js de bootstrap-->
        <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    </main>
  </body>
</html>