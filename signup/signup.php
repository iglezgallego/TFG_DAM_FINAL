<?php
    include "../conection/config.php";
    // Comprueba si el usuario existe y muestra un mensaje en caso de que se cumpla
    if (isset($_GET['error']) && $_GET['error'] == "si") {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                showErrorUserExists();
            });
        </script>';
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      
    <!-- Título de la página -->
    <title id="titlePagSignup">eXamUp - Registrarse</title>
      
    <!-- Enlaces de bootstrap -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--icono de la pestaña-->
    <link rel="icon" href="../assets/brand/logotipo2.png">
    <!-- CDN jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Archivo de scripts donde se encuentran las funciones -->
    <script src="../js/scripts.js"></script>
    <!-- Link a estilo de singin -->
    <link href="signin.css" rel="stylesheet">
      
    <!-- ESTILO CSS -->
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
            /*
            background: #F3E992;
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
        #floatingLanguage {
            margin-top: 0 !important;
        }
    </style>
  </head>
  <!-- BODY -->    
  <body class="text-center">
    <main class="form-signin w-100 m-auto">
        <!-- Formulario para el singup con el metodo post y conectado a conf_singup.php -->
        <form action="conf_signup.php" method="post">
            <div id="logo-container">
                <h1 style="font-family:matisan; font-size:75px; color:#3278c8;">e<img class="mb-4" src="../assets/brand/logotipo2.png" alt="" width="60" height="60">amUp</h1>
            </div>
            <h2 class="h3 mb-3 fw-normal" id="headline" style="font-size:20px;">Registrarse</h2>
            <div class="form-floating mb-0">
              <input type="text" class="form-control" id="floatingInput" placeholder="Tu nombre de usuario" name="user" required style="border-radius:5px">
              <label for="floatingInput">Introduce tu nombre de usuario</label>
            </div>
            <div class="form-floating mb-0">
              <input type="email" class="form-control" id="floatingEmail" placeholder="Tu email" name="email" required style="border-radius:5px">
              <label for="floatingEmail">Introduce tu email</label>
            </div>
            <div class="form-floating mb-0">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Tu contraseña" name="password" required style="border-radius:5px;">
                <label for="floatingPassword">Introduce tu contraseña</label>
            </div>
            <div class="form-floating">
                <select class="form-select" id="floatingLanguage" name="language" required style="border-radius:5px;">
                    <option value="" selected disabled>Selecciona tu idioma</option>
                    <!-- Opciones de lenguajes -->
                    <?php
                        $consulta = "SELECT * FROM languages";
                        $resultado = $conection->query($consulta);
                        // Comprobar si la consulta fue exitosa antes de iterar sobre los resultados
                        if ($resultado) {
                            // Iterar sobre los resultados obtenidos de la consulta
                            while ($fila = $resultado->fetch_assoc()) {
                                // Imprimir cada opción del dropdown con los datos de la consulta
                                echo '<option value="' . $fila["code_name"] . '" langkey="' . $fila["lang_key"] . '">' . $fila["description"] . '</option>';
                            }
                        } else {
                            echo "Error al ejecutar la consulta: " . $conexion->error;
                        }
                    ?> 
                </select>
            </div>
            <!-- Campo oculto para pasar el langkey -->
            <input type="hidden" id="floatingLangkey" name="lang_key" value="">
            <br>
            <button class="w-100 btn btn-lg btn-primary" id="signupbutton" type="submit" style="background:#0d6efd; border:none;">Registrarse</button>
        </form>
        <!-- Pie de pagina -->
        <p class="mt-5 mb-3 text-muted">&copy; ExamUp</p>
        </main>
    </body>
</html>
