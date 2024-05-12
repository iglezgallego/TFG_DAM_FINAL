<?php
    include "../conection/config.php";
//Comprueba si el usuario existe y muestra un mensaje en caso de que se cumpla
    if(isset($_GET['error']) && $_GET['error']=="si"){
        echo '<script>
            if(localStorage.getItem("selectedLanguage") === "en_EN") {
                alert("The user or email already exists");
            } else {
                alert("El usuario o email ya existe");
            }
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
      
    <!-- Traducciones -->
    <script> 
        // Cuando el documento HTML ha sido completamente cargado y analizado, se ejecuta la función asíncrona
        $(document).ready(async function() {
            // Obtener el idioma seleccionado del localStorage
            var selectedLanguage = localStorage.getItem('selectedLanguage');
            // Definir el idioma predeterminado
            const defaultLanguage = "es_ES";
            // Si hay un idioma seleccionado en el localStorage, úsalo; de lo contrario, utiliza el idioma predeterminado
            var languageToUse = selectedLanguage ? selectedLanguage : defaultLanguage;
            // Llamada a la función translate() con el idioma seleccionado
            var traducciones = await translate(languageToUse);
            console.log(traducciones);
        });

        // Definición de la función translate(), la cual realiza una solicitud AJAX para obtener traducciones
        function translate(language) {
            var componentNameArray = ["titlePagSignup", "floatingInput", "floatingPassword", "floatingEmail", "headline", "signupbutton", "floatingLanguage"]; // Array de nombres de componentes

            // Se devuelve una promesa para manejar el resultado de la solicitud AJAX
            return new Promise(function(resolve, reject) {
                // Se realiza la solicitud AJAX utilizando jQuery.ajax()
                $.ajax({
                    url: '../ajaxTranslate.php', // URL del archivo PHP que maneja la traducción
                    type: 'GET', // Método de solicitud HTTP
                    data: {
                        language: language, // Parámetro: idioma
                        componentNameArray: JSON.stringify(componentNameArray) // Parámetro: array de nombres de componentes convertido a cadena JSON
                    },
                    // Función que se ejecuta cuando la solicitud AJAX se completa con éxito
                    success: function(response) {
                        // Parsear la respuesta JSON
                        var translations = JSON.parse(response);

                        // Actualizar los elementos HTML con las traducciones
                        $('#titlePagSignup').text(translations.titlePagSignup);
                        $('#floatingInput').next('label').text(translations.floatingInput);
                        $('#floatingEmail').next('label').text(translations.floatingEmail);
                        $('#floatingPassword').next('label').text(translations.floatingPassword);
                        $('#headline').text(translations.headline);
                        $('#floatingLanguage option[value=""]').text(translations.floatingLanguage);
                        $('#signupbutton').text(translations.signupbutton);
                        // Continuar actualizando otros elementos

                        // Resolve la promesa con las traducciones
                        resolve(translations);
                    },
                    // Función que se ejecuta si la solicitud AJAX falla
                    error: function(xhr, status, error) {
                        // Se imprime el error en la consola del navegador
                        console.error(xhr);
                        // Se rechaza la promesa con el mensaje de error
                        reject(error);
                    }
                });
            });
        }
    </script>
    
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
      
    <!-- Link a estilo de singin -->
    <link href="signin.css" rel="stylesheet">
    
    <script>
        // Script para actualizar el campo oculto con el langkey seleccionado usando jQuery
        $(document).ready(function() {
            $('#floatingLanguage').change(function() {
                var selectedLangKey = $(this).find('option:selected').attr('langkey');
                $('#floatingLangkey').val(selectedLangKey);
            });
        });
    </script>
  </head>
    
  <body class="text-center">
    <main class="form-signin w-100 m-auto">
        <!-- Botón de retroceso 
        <a href="#" onclick="window.history.back();" class="btn btn-light border-white bg-white" style="position:absolute; top:20px; right:40px; width:60px">
            <span style="font-size:25px;font-weight:500;position:center">⇦</span>
        </a>-->
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
