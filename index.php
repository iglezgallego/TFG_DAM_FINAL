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
    <title>examUp</title>
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
            });
        })
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
                    $consulta = "SELECT * FROM languages";
                    $resultado = $conection->query($consulta);
                    // Comprobar si la consulta fue exitosa antes de iterar sobre los resultados
                    if ($resultado) {
                        // Iterar sobre los resultados obtenidos de la consulta
                        while ($fila = $resultado->fetch_assoc()) {
                            // Imprimir cada opción del dropdown con los datos de la consulta
                            echo '<option value="' . $fila["code_name"] . '" langkey="' . $fila["lang_key"] . '">';
                            echo $fila["description"] . '</option>';
                        }
                    } else {
                        echo "Error al ejecutar la consulta: " . $conexion->error;
                    }
                ?> 
            </select>
        </div>
      </header>

      <main class="px-3">
        <h1 style="font-family:matisan; font-size:80px; -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: rgb(37 114 198); text-stroke-width: 1px; text-stroke-color: rgb(37 114 198);">e<img class="mb-4" src="assets/brand/logotipo2.png" alt="" width="60" height="60">amUp</h1>
        <p class="lead">Descripción de la app</p>
        <p class="lead">
          <a href="signin/signin.php" class="btn btn-lg btn-light fw-bold border-white bg-white">Acceder</a>
        </p>
        <!--Enlace a js de bootstrap-->
        <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
      </main>
        <!-- Pie de página -->
      <footer class="mt-auto text-white-50">
         <p class="mt-5 mb-3 text-muted">&copy; Isabel González-Gallego Rivera 2024</p>
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
        });
    </script>
  </body>
</html>
