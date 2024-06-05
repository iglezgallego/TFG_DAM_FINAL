<?php
    //incluyo session y config para la conexion
    session_start();
    include "../conection/config.php";
    //Control de SESSION para no poder colarse a app sin pasar por login
    if(!isset($_SESSION['iduser']) || empty($_SESSION['iduser'])) {
        //echo "No tienes permiso para acceder a esta página.";
        // Redireccionar al usuario a la página de inicio de sesión
        header("Location:../index.php");
        exit(); // Terminar la ejecución del script
    }
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $consultaTrans = "SELECT * FROM translations";
    $resultadoTrans = $conection->query($consultaTrans);
    
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ExamUp</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logotipo2.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

    <!-- CDN jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- CDN jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
    <!-- Estilos jQuery UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script>
            ///////////////////////////////FUNCIONES EXAMENES FAVORITOS ////////////////////////////////////////////
        
            // Función para cambiar si un examen es favorito ///////
            function cambiarFavorito() {
                // Manejar el clic en la estrella de favorito
                $('.favorito').click(function() {
                    // Almacenar una referencia al elemento en una variable
                    var $this = $(this);

                    // Obtener el ID del examen asociado a la estrella
                    const examenId = this.getAttribute('data-id');

                    // Obtener el valor actual de favorito
                    let favorito = parseInt(this.getAttribute('data-value'));
                    console.log('Valor original de favorito:', favorito);

                    // Cambiar el valor de favorito
                    favorito = favorito ? 0 : 1;
                    // Actualizar el valor de data-value en la estrella de favorito
                    $(this).attr('data-value', favorito);
                    
                    // Realizar la solicitud AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'exams/update_favorite.php', // Aquí debes especificar la URL del script PHP que manejará la actualización del favorito
                        data: { examenId: examenId },
                        success: function(response) {
                            // Manejar la respuesta del servidor (opcional)
                            console.log(response);

                            // Cambiar el color de la estrella de favorito según el valor actualizado
                            if (favorito) {
                                $this.find('i').removeClass('bi-star').addClass('bi-star-fill');
                            } else {
                                $this.find('i').removeClass('bi-star-fill').addClass('bi-star');
                            }
                        },
                        error: function(xhr, status, error) {
                            // Manejar errores (opcional)
                            console.error(error);
                        }
                    });
                });
            }
        $(document).ready(function() {
            cambiarFavorito();
            $('.onPageFav').on('click', function() {
                $(this).closest('tr').hide();
        })
        });
        
         
        
        ///////////////////////////////FUNCIONES COMPARTIR EXAMENES ////////////////////////////////////////////
        
        // Función para abrir la modal y configurar el botón de enviar con el valor del examen
         function openModal(modalId, gidExamValue) {
            // Obtener el elemento modal por su ID
            var modal = document.getElementById(modalId);
            // Inicializar la modal utilizando la clase Modal de Bootstrap
            var bsModal = new bootstrap.Modal(modal); 
            // Obtener el botón de enviar dentro de la modal
            var enviarBtn = modal.querySelector('#enviarBtn');
            // Establecer el atributo 'data-gid-exam' del botón de enviar con el valor del examen
            enviarBtn.setAttribute('data-gid-exam', gidExamValue);
            // Mostrar la modal
            bsModal.show();
        } 
        
        // Función para compartir el examen
        function compartirExamen(gidExamValue) {
            var email = document.getElementById('shareEmail').value;// Obtener el valor del email introducido en la modal
            
            // Enviar la solicitud AJAX
            $.ajax({
                type: 'POST',
                url: 'exams/share/share_exam.php',
                data: {
                    email: email,
                    gid_exam: gidExamValue
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var messageElement = document.getElementById('message');
                    messageElement.innerText = response.message;
                    messageElement.classList.remove('text-danger', 'text-success'); // Eliminar clases de colores anteriores

                    if (response.success) {
                        messageElement.classList.add('text-success'); // Agregar clase de color verde
                    } else {
                        messageElement.classList.add('text-danger'); // Agregar clase de color rojo
                    }
                }
            });
            // Limpiar el input después de dar a enviar
            document.getElementById('shareEmail').value = '';
            
        }
        
        // Función para limpiar el input y el mensaje de la modal cada vez que la abra de nuevo
        function limpiarInput(){
            document.getElementById('shareEmail').value = '';
            document.getElementById('message').innerText = '';
        }
        </script>
    
    <!------- CSS -------> 
    <style>
        /* Cargar tipos de fuente  */
        @font-face{
            font-family: matisan;
            src: url("../fonts/matisan.otf")
        }
        
        /* Colores  y estilo para el mensaje de la modal compartir  */
        #message {
            text-align: center; /* Alinear el texto horizontalmente en el centro */
            margin: 0 auto; /* Centrar horizontalmente el elemento */
        }
        .text-success {
            color: green; /* Color verde para mensajes de éxito */
        }

        .text-danger {
            color: red; /* Color rojo para mensajes de error */
        }
        /* Estilos opcionales para mejorar la apariencia */
        .question {
          margin-bottom: 20px;
        }
        label {
          display: block;
          margin-bottom: 5px;
        }
        .opciones div {
          display: flex;
          align-items: center;
        }
        .opciones input[type="checkbox"] {
          margin-right: 10px;
        }
        
        /* Estilos para el contador */
        #contador-container {
            position: relative;
        }

        #cronometro {
            position: absolute;
            top: 10;
            right: 0;
            padding: 10px;
            margin-top: 20px;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        #contador {
            font-size: 24px;
            margin-right: 10px;
            
        }

        #botoncontainer {
            display: flex;
            align-items: center;
        }

        #botoncontadorDetener {
            margin-left: 5px;
        } 
        #botoncontadorReanudar {
            margin-left: 5px;
        } 
        
        /* Estilo para los elementos form-check */
        .form-check {
            margin-bottom: 10px; /* Espacio entre los elementos form-check */
        }

        /* Estilo para los checkboxes */
        .form-check-input {
            margin-right: 10px; /* Espacio entre los checkboxes y los textos */
        }

        /* Estilo para los labels de los checkboxes */
        .form-check-label {
            font-size: 16px;
            padding-right: 20px;
        }
        /* Estilo para el index de pregunta */
        .numero-pregunta{
            font-size: 20px;
            font-weight: 600;
            color:  rgb(1, 41, 112);
        }
        
        .pregunta label {
            width:100% !important;
        }
        /* Estilo para los checkboxes */
        .form-check-input[type="checkbox"] {
            border: 1px solid rgb(1, 41, 112) !important; /* Color y grosor del borde */
        }

        /* Estilo para los radiobuttons */
        .form-check-input[type="radio"] {
            border: 1px solid rgb(1, 41, 112) !important; /* Color y grosor del borde */
        }
         /* Estilo animación main */

        .word {
            font-family: matisan;
            perspective: 1000px;
        }

        .word span {
            cursor: pointer;
            display: inline-block;
            font-size: 200px;
            user-select: none;
            line-height: .8;
            color: #3278c8;
        }

        .word span:nth-child(1).active {
            animation: balance 1.5s ease-out;
            transform-origin: bottom left;
        }

        @keyframes balance {
            0%, 100% {
                transform: rotate(0deg);
            }

            30%, 60% {
                transform: rotate(-45deg);
            }
        }

        .word span:nth-child(2).active {
            animation: shrinkjump 1s ease-in-out;
            transform-origin: bottom center;
        }

        @keyframes shrinkjump {
            10%, 35% {
                transform: scale(2, .2) translate(0, 0);
            }

            45%, 50% {
                transform: scale(1) translate(0, -150px);
            }

            80% {
                transform: scale(1) translate(0, 0);
            }
        }

        .word span:nth-child(3).active {
            animation: falling 2s ease-out;
            transform-origin: bottom center;
        }

        @keyframes falling {
            12% {
                transform: rotateX(240deg);
            }

            24% {
                transform: rotateX(150deg);
            }

            36% {
                transform: rotateX(200deg);
            }

            48% {
                transform: rotateX(175deg);
            }

            60%, 85% {
                transform: rotateX(180deg);
            }

            100% {
                transform: rotateX(0deg);
            }
        }

        .word span:nth-child(4).active {
            animation: rotate 1s ease-out;
        }

        @keyframes rotate {
            20%, 80% {
                transform: rotateY(180deg);
            }

            100% {
                transform: rotateY(360deg);
            }
        }

        .word span:nth-child(5).active {
            animation: toplong 1.5s linear;
        }

        @keyframes toplong {
            10%, 40% {
                transform: translateY(-48vh) scaleY(1);
            }

            90% {
                transform: translateY(-48vh) scaleY(4);
            }
        }   
        .animation {
            display: flex;
            justify-content: center; /* Centra horizontalmente */
            align-items: center; /* Centra verticalmente */
            margin-top: calc(100%/4.5);
            height: 100%; /* Opcional: ajusta la altura según sea necesario */
        }
        
        .logopequenio img {
            max-width: 220px; /* ajusta el valor según lo necesites */
            height: auto; /* mantén la proporción de aspecto */
        }
        
        /* Estilo para los resultados de los exámenes */
        #resultadosContainer{
            display:none;
            margin-top:20px;
            padding:20px;
            border-radius:20px;
            background:#FFF6BD; 
        }
        #resultadosContainer li span{
            font-weight: bold;
            margin-left: 9px;
        }
        
    </style>
</head>

<body>

  <!------- Header --------->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="main.php" class="logo d-flex align-items-center">
        <span style="font-family:matisan; font-size:25px; color:#3278c8">e<img src="assets/img/logotipo2.png" style="width:20; height:20;margin:0px">amUp</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile2.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo ($_SESSION['username']) ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo ($_SESSION['username']) ?></h6>
                <span>
                  <?php
                    //Obtener el rol de usuario
                    $consulta = 'SELECT rol_name FROM rols WHERE rol_key="'.$_SESSION['rolkey'].'" ';
                    $resultado = $conection->query($consulta);
                    $fila=$resultado->fetch_assoc();
                    $roluser = $fila['rol_name'];
                    echo $roluser 
                  ?>
                </span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="main.php?profile">
                <i class="bi bi-person"></i>
                <span id="menuProfile"><?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'menuProfile') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>
                  </span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span id="menuLogout"><?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'menuLogout') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?></span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="main.php">
          <i class="bi bi-grid"></i>
          <span id="sidebarHome">
              <?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'sidebarHome') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                } ?>
            </span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="main.php?exams=public">
          <i class="bi bi-tv"></i><span id="sidebarBoard"><?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'sidebarBoard') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?></span>
        </a>
        <a class="nav-link collapsed" id="sidebarNew" href="main.php?exams=create">
          <i class="bi bi-plus-square"></i>
            <span>
                <?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'sidebarNew') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>
            </span>
        </a>
        <a class="nav-link collapsed" id="sidebarMyexams" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-book"></i><span>
            <?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'sidebarMyexams') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>
            </span>
            <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a id="sidebarForme" href="main.php?exams=own">
              <i class="bi bi-circle"></i>
                <span>
                    <?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'sidebarForme') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>
                </span>
            </a>
          </li>
          <li>
            <a id="sidebarShared" href="main.php?exams=shared">
              <i class="bi bi-circle"></i>
                <span>
                    <?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'sidebarShared') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>
                </span>
            </a>
          </li>
          <li>
            <a id="sidebarFavorites" href="main.php?exams=favorite">
              <i class="bi bi-circle"></i>
                <span>
                    <?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'sidebarFavorites') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>
                </span>
            </a>
          </li>
        </ul>
      </li><!-- End Mis examenes Nav -->

      <li class="nav-item">
         <a class="nav-link collapsed" href="main.php?charts=table">
          <i class="bi bi-graph-up-arrow"></i>
             <span id="sidebarMyresults">
                 <?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'sidebarMyresults') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>
             </span>
        </a> 
      </li><!-- End Forms Nav -->

      <li class="nav-heading"><hr></li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="main.php?profile">
          <i class="bi bi-person-square"></i>
          <span id="sidebarProfile">
              <?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'sidebarProfile') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>
            </span>
        </a>
      </li><!-- End Perfil Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="logout/logout.php">
          <i class="bi bi-box-arrow-right"></i>
          <span id="sidebarLogout">
              <?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'sidebarLogout') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>
            </span>
        </a>
      </li><!-- End Cerrar sesión Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1></h1>
       <nav>
        <ol class="breadcrumb">
          <!-- <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">main.php?</li> -->
        </ol> 
      </nav> 
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <?php
                        
            if(empty($_GET)) {
                // Ejecutar el código determinado
                echo '<div class="animation">
                        <div class="word">
                            <span>e</span>
                            <span class="logopequenio"><img src="assets/img/logotipo2.png"></span>
                            <span>a</span>
                            <span>m</span>
                            <span>Up</span>
                        </div>
                    </div>
                    ';
                // Aquí puedes colocar cualquier otra lógica que desees ejecutar cuando no haya variables GET
            } 
            
            //Cargar el perfil
            if (isset($_GET['profile'])) {
                $profile = $_GET['profile'];
                include 'profile.php';
            }
                
            // Cargar las opciones de exámenes en la página
            if (isset($_GET['exams'])) {
                $exams = $_GET['exams'];
                // Dependiendo del valor de la opción, incluir diferentes archivos PHP
                switch ($exams) {
                    case 'own':
                        include 'exams/my_exams.php';
                        break;
                        
                    case 'shared':
                        include 'exams/shared_exams.php';
                        break;
                        
                    case 'favorite':
                        include 'exams/favorites_exams.php';
                        break;
                        
                    case 'public':
                        include 'exams/public_exams.php';
                        break;
                        
                    case 'create':
                        include 'exams/create/create_exam.php';
                        break;
                        
                    case 'edit':
                        include 'exams/edit/edit_exam.php';
                        break;
                        
                    case 'do':
                        include 'exams/do/do_exam.php';
                        break;
        
                    default:
                        // Manejar caso en que 'exams' no coincida con ninguna opción conocida
                        include 'main.php';
                        break;
                }
            }
            // Cargar los de resultados en la página
            if (isset($_GET['charts'])) {
                $charts = $_GET['charts'];
                // Dependiendo del valor de la opción, incluir diferentes archivos PHP
                switch ($charts) {
                    case 'table':
                        include 'charts/table_charts.php';
                        break;
                    case 'result':
                        include 'charts/result_charts.php';
                        break;
                    default:
                        // Manejar caso en que 'charts' no coincida con ninguna opción conocida
                        include 'main.php';
                        break;
                }
            }
        ?>
      </div>
    </section>
      
    <!-- Ventana modal para compartir -->
    <div class="modal" id="myModal1" tabindex="-1">
      <div class="modal-dialog modal-lg"> <!-- Agregamos las clases modal-dialog-centered para centrar y modal-lg para hacerla más ancha -->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">
                <?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'modalTitle') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>
              </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="limpiarInput()"></button>
          </div>
          <div class="modal-body">
            <label id="modalLabel">
                <?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'modalLabel') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>
              </label>
            <br><br>
            <input type="email" class="form-control" id="shareEmail" placeholder="<?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'shareEmail') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>" name="email" required style="border-radius:5px">
              <br>
            <p id="message">
                <!-- Cargar texto enviado por ajax dinámicamente indicando si el examen se ha compartido correctamente o no --> 
            </p>
          </div>
          <div class="modal-footer">
            <button id="enviarBtn" type="button" class="btn btn-primary" onclick="compartirExamen(this.getAttribute('data-gid-exam'))" data-gid-exam="">
                <?php foreach ($resultadoTrans as $traduccion) {
                    if ($traduccion['component_name'] === 'enviarBtn') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>
              </button>
          </div>
        </div>
      </div>
    </div>
      
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php
    if(!empty($_GET)) {
      echo '<footer id="footer" class="footer">
        <div class="copyright">
          &copy; <strong><span>ExamUp</span></strong>.
        </div>
      </footer> ';
    }
?>
    <!-- End Footer -->
    <script>
    ///////////////////////////////FUNCIONES CREAR EXAMENES ////////////////////////////////////////////
        
        // Función para obtener el valor de la opción seleccionada
        function obtenerTipoExamen() {
            var opciones = document.getElementsByName('examStatus');
            for (var i = 0; i < opciones.length; i++) {
                if (opciones[i].checked) {
                    return opciones[i].value;
                }
            }
            return null;
        }

        function actualizarTipoExamen() {
            var statusExamen = obtenerTipoExamen();
            console.log("El tipo de examen seleccionado es: " + statusExamen);
        }

        var opcionesStatus = document.getElementsByName('examStatus');
        opcionesStatus.forEach(function(opcion) {
            opcion.addEventListener('click', actualizarTipoExamen);
        });

        // Función para validar las condiciones del examen
        function validarExamen() {
            var hayPreguntas = $(".pregunta").length > 0;
            var todasLasPreguntasValidas = true;

            $(".pregunta").each(function(index, preguntaElement) {
                var hayRespuestasCorrectas = false;
                $(preguntaElement).find(".respuesta .form-check-input").each(function(index, respuestaElement) {
                    if ($(respuestaElement).prop("checked")) {
                        hayRespuestasCorrectas = true;
                        return false; // Salir del bucle si se encuentra una respuesta correcta
                    }
                });

                if (!hayRespuestasCorrectas) {
                    todasLasPreguntasValidas = false;
                    return false; // Salir del bucle si una pregunta no tiene respuestas correctas
                }
            });

            $("#guardarExamen").prop("disabled", !(hayPreguntas && todasLasPreguntasValidas));
        }

        // Función para agregar una nueva pregunta con efectos de jQuery UI
        function agregarPregunta() {
            var nuevaPregunta = `
                <div class="pregunta" style="">
                    <div class="enunciado ui-widget-content ui-corner-all" style="display: flex; align-items: center; margin-top:20px; margin-bottom:10px;">
                        <input id="inputQuestion" type="text" class="form-control" placeholder="<?php foreach ($resultadoTrans as $traduccion) {
                        if ($traduccion['component_name'] === 'inputQuestion') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                        } ?>">
                        <button class="removeQuestion btn btn-secondary" style="margin: 5px;"><i class="bi bi-x-square"></i> </button>
                    </div>
                    <div class="respuestas">
                        <!-- Aquí se añadirán dinámicamente las respuestas -->
                    </div>
                    <!-- Botón para añadir respuesta -->
                    <button id="addAnswer" class="btn btn-outline-primary" style="margin-bottom:10px;">
                        <i class="bi bi-plus-circle-fill"></i> <?php foreach ($resultadoTrans as $traduccion) {
                        if ($traduccion['component_name'] === 'addAnswer') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                        } ?>
                    </button>
                </div>
            `;
            $(".preguntas").append(nuevaPregunta);
            $(".pregunta").hide().fadeIn(); // Efecto al agregar una pregunta
            validarExamen(); // Validar examen después de agregar una pregunta
        }

        // Función para agregar una nueva respuesta a una pregunta con efectos de jQuery UI
        function agregarRespuesta(event) {
            var pregunta = $(event.target).closest('.pregunta');
            var nuevasRespuestas = `
                <div class="respuesta ui-widget-content ui-corner-all" style="display: flex; align-items: center; margin-top: 10px; margin-bottom:10px; margin-left:20px; margin-right:20px;">
                    <input class="form-check-input" type="checkbox" style="width: 25px !important; height: 25px !important; margin-right: 10px; margin-left: 10px;">
                    <input id="inputAnswer" type="text" class="form-control" placeholder="<?php foreach ($resultadoTrans as $traduccion) {
                        if ($traduccion['component_name'] === 'inputAnswer') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                    } ?>">
                    <button class="removeAnswer btn btn-danger" style="margin:5px;"><i class="bi bi-x-square"></i></button>
                </div>
            `;
            pregunta.find(".respuestas").append(nuevasRespuestas);
            $(".respuesta").hide().fadeIn(); // Efecto al agregar una respuesta
            validarExamen(); // Validar examen después de agregar una respuesta
        }

        // Función para eliminar una respuesta con efectos de jQuery UI
        function eliminarRespuesta(event) {
            $(event.target).closest('.respuesta').slideUp("fast", function() {
                $(this).remove();
                validarExamen(); // Validar examen después de eliminar una respuesta
            });
        }

        // Función para eliminar una pregunta con efectos de jQuery UI
        function eliminarPregunta(event) {
            $(event.target).closest('.pregunta').slideUp("fast", function() {
                $(this).remove();
                validarExamen(); // Validar examen después de eliminar una pregunta
            });
        }

        // Evento de clic para añadir una nueva pregunta
        $("#addQuestion").click(function() {
            agregarPregunta();
            validarExamen(); // Validar examen después de agregar una pregunta
        });

        // Evento de clic para añadir una nueva respuesta
        $(document).on('click', '#addAnswer', function(event) {
            agregarRespuesta(event);
            validarExamen(); // Validar examen después de agregar una respuesta
        });

        // Evento de clic para eliminar una respuesta
        $(document).on('click', '.removeAnswer', function(event) {
            eliminarRespuesta(event);
            validarExamen(); // Validar examen después de eliminar una respuesta
        });

        // Evento de clic para eliminar una pregunta
        $(document).on('click', '.removeQuestion', function(event) {
            eliminarPregunta(event);
            validarExamen(); // Validar examen después de eliminar una pregunta
        });

        // Evento de cambio para marcar/desmarcar una respuesta como correcta
        $(document).on('change', '.respuesta .form-check-input', validarExamen);

        // Función para obtener los datos del formulario y convertirlos a JSON
        function obtenerDatosJSON() {
            var datos_examen = {
                titulo: $("#inputTitle").val(),
                status: obtenerTipoExamen(),
                preguntas: [],
                typekey: $("#examType").val()
            };

            $(".pregunta").each(function(index, preguntaElement) {
                var pregunta = {
                    type: $(preguntaElement).find(".form-select").val(),
                    sentence: $(preguntaElement).find(".form-control").val(),
                    respuestas: []
                };

                $(preguntaElement).find(".respuesta").each(function(index, respuestaElement) {
                    var respuesta = {
                        answer: $(respuestaElement).find(".form-control").val(),
                        correct: $(respuestaElement).find(".form-check-input").prop("checked")
                    };
                    pregunta.respuestas.push(respuesta);
                });

                datos_examen.preguntas.push(pregunta);
            });

            var datosJSON = JSON.stringify(datos_examen);
            console.log("Datos del JSON:", datosJSON);
            return datosJSON;
        }

        // Función para enviar los datos JSON a PHP y guardar el examen en la base de datos
        function guardarExamen() {
            var datosJSON = obtenerDatosJSON();
            $.ajax({
                type: "POST",
                url: "exams/create/conf_create_exam.php",
                data: datosJSON,
                success: function(response) {
                    console.log(response);
                    if(localStorage.getItem("selectedLanguage") === "en_EN") {
                        alert("Exam successfully saved.");
                    } else {
                        alert("Examen guardado correctamente.");
                    }
                    window.location.href = 'main.php?exams=own';
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert("Error al guardar el examen");
                }
            });
        }

        // Validar examen al cargar la página
        validarExamen();


        ///////////// FUNCIONES EDITAR EXAMENES /////////////////
        
        function editarExamen(gidExam) {
            var datosJSON = obtenerDatosJSON();
            $.ajax({
                type: "POST",
                url: "exams/edit/conf_edit_exam.php", // Archivo PHP que maneja la inserción en la base de datos
                data: {
                datosJSON: datosJSON,
                gidExam: gidExam
                },                
                success: function(response) {
                    console.log(response); // Muestra la respuesta del servidor en la consola
                    alert("Examen editado correctamente");
                    // Redirige a la página
                    window.location.href = 'main.php?exams=own';
                },
                error: function(xhr, status, error) {
                    console.error(error); // Muestra errores en la consola en caso de que ocurran
                    alert("Error al editar el examen");
                }
            });
        }
        
    ///////////////// FUNCIONES ANIMACIÓN MAIN ///////////////////////
        
       const spans = document.querySelectorAll('.word span');

        function activateAnimation() {
            spans.forEach((span, idx) => {
                setTimeout(() => {
                    span.classList.add('active');
                }, 750 * (idx + 1));
            });
        }

        function deactivateAnimation() {
            spans.forEach(span => {
                span.classList.remove('active');
            });
        }

        function startAnimationSequence() {
            activateAnimation(); // Activar la animación por primera vez
            let totalAnimationTime = 750 * spans.length + 1500; // Tiempo total de animación más el tiempo de espera
            setTimeout(() => {
                deactivateAnimation(); // Desactivar la animación después de que haya terminado
                setTimeout(startAnimationSequence, 2000); // Comenzar la secuencia nuevamente después de 2 segundos
            }, totalAnimationTime);
        }

        startAnimationSequence(); // Comenzar la secuencia de animación


    </script>
    
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    
    
  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
    
</body>

</html>