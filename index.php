<?php
    include "conection/config.php";
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <!-- Título de la página -->
    <title>eXamUp</title>
    <!-- Enlaces de bootstrap -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/cover/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CDN jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- CDN de la libreria select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--icono de la pestaña-->
    <link rel="icon" href="assets/brand/logotipo2.png">
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
        /* Cargar tipos de fuente  */
        @font-face{
            font-family: matisan;
            src: url("fonts/matisan.otf")
        }
        /* Estilo del fondo  */
        #background-video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
            background-size: cover;
            transition: 1s opacity;
            opacity: 0.4;
        }

        .cover-container {
            position: relative;
        }
        
       /* Estilo del selector de idioma  */
        .dropdown-corner {
          position: fixed;
          top: 20px;
          right: 35px;
          width: 130px;
        }
        /* Estilo los iconos del idioma */
        .img-flag {
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }

    </style>
    <!-- Link a estilo de cover -->
    <link href="cover.css" rel="stylesheet">
      
    <!-- Guardar el idioma seleccionado en el localStorage --> 
    <script>
        $(document).ready(async function(){
          // Capturar el cambio de idioma en el dropdown del home
          $('#floatingLanguage').on('change', function() {
            // Obtener el valor seleccionado
              var selectedValue = $(this).val();
            // Almacenar el valor seleccionado en localStorage
            localStorage.setItem('selectedLanguage', selectedValue);
            //console.log(localStorage.getItem('selectedLanguage'));
              
            // Llamo a la función translate pasandole el idioma seleccionado
            translate(selectedValue);
            });
        })
        
        // TRADUCCIONES //
        
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
            var componentNameArray = ["appDescription", "mainAccess"]; // Array de nombres de componentes

            // Se devuelve una promesa para manejar el resultado de la solicitud AJAX
            return new Promise(function(resolve, reject) {
                // Se realiza la solicitud AJAX utilizando jQuery.ajax()
                $.ajax({
                    url: 'ajaxTranslate.php', // URL del archivo PHP que maneja la traducción
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
                        $('#appDescription').text(translations.appDescription);
                        $('#mainAccess').text(translations.mainAccess);
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
  </head>
    
  <body class="d-flex h-100 text-center text-bg-dark">
      
    <video id="background-video" loop autoplay muted>
        <source src="img/book.mp4" type="video/mp4">
    </video>
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header class="mb-auto">
        <!-- Selector de idioma -->
        <div class="dropdown dropdown-corner">
            <select class="form-select" id="floatingLanguage" name="language" required style="border-radius:5px;">
                <!-- Opciones de lenguajes -->
                <?php
                    
                    // Obtener el idioma seleccionado que esta siendo enviado por AJAX
                    $selectedLanguage = isset($_POST['selectedLanguage']) ? $_POST['selectedLanguage'] : '';

                    // Consulta para obtener los idiomas disponibles
                    $consulta = "SELECT * FROM languages";
                    $resultado = $conection->query($consulta);

                    // Comprobar si la consulta fue exitosa antes de iterar sobre los resultados
                    if ($resultado) {
                        // Iterar sobre los resultados obtenidos de la consulta
                        while ($fila = $resultado->fetch_assoc()) {
                            
                            echo '<option value="' . $fila["code_name"] . '" langkey="' . $fila["lang_key"] . '" ' . $selected . '>';
                            echo $fila["description"] . '</option>';
                        }
                    }
                ?>
            </select>
        </div>
      </header>

      <main class="px-3">
        <h1 style="font-family:matisan; font-size:80px; -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: rgb(37 114 198); text-stroke-width: 1px; text-stroke-color: rgb(37 114 198);">e<img class="mb-4" src="assets/brand/logotipo2.png" alt="" width="60" height="60">amUp</h1>
        <p class="lead" id="appDescription">Descripción de la app<p>
        <p class="lead">
          <a href="signin/signin.php" id="mainAccess" class="btn btn-lg btn-light fw-bold border-white bg-white">Acceder</a>
        </p>
        <!--Enlace a js de bootstrap-->
        <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
      </main>
        <!-- Pie de página -->
      <footer class="mt-auto text-white-50">
         <p class="mt-5 mb-3 text-muted" style="color: rgba(255, 255, 255, 0.6) !important;">&copy; Isabel González-Gallego Rivera 2024</p>
      </footer>
    </div>
      
    <script>
        // Script para el dropdown del idioma con select2
        $(document).ready(function() {
            // Inicializar Select2 en el elemento select
            $('#floatingLanguage').select2({
                templateResult: formatLang,
                templateSelection: formatLang
            });

            // Función para dar formato a cada opción de lenguaje
            function formatLang(lang) {
                if (!lang.id) { return lang.text; }
                var $lang = $(
                    '<span><img src="img/' + lang.element.value.toLowerCase() + '.png" class="img-flag" /> ' + lang.text + '</span>'
                );
                return $lang;
            };
            // Obtener el idioma seleccionado del localStorage
            var selectedLanguage = localStorage.getItem('selectedLanguage');
            // Verificar si el idioma seleccionado está en el dropdown
            if (selectedLanguage) {
                // Seleccionar automáticamente la opción del idioma en el dropdown
                $('#floatingLanguage').val(selectedLanguage).trigger('change');
            }
        });
    </script>
  </body>
</html>
