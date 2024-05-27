<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <div class="row">
                <div class="col-md-6" style="margin-bottom:20px;">
                    <input type="title" class="form-control" id="inputTitle" placeholder="<?php foreach ($resultadoTrans as $traduccion) {
                        if ($traduccion['component_name'] === 'inputTitle') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                        } ?>">
                </div>
                <div class="col-md-6">
                    <!-- Grupo de botones para seleccionar es status del examen -->
                    <div class="btn-group" role="group" aria-label="Tipo de examen">
                        <input type="radio" class="btn-check" id="publicCheckbox" autocomplete="off" name="examStatus" value="bi bi-people-fill">
                        <label id="buttonPublic" class="btn btn-outline-primary" for="publicCheckbox"><?php foreach ($resultadoTrans as $traduccion) {
                        if ($traduccion['component_name'] === 'buttonPublic') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                        } ?></label>
                        <input type="radio" class="btn-check" id="privateCheckbox" autocomplete="off" name="examStatus" value="bi bi-person-fill-lock" checked>
                        <label id="buttonPrivate" class="btn btn-outline-primary" for="privateCheckbox"><?php foreach ($resultadoTrans as $traduccion) {
                        if ($traduccion['component_name'] === 'buttonPrivate') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                        } ?></label>
                    </div>
                </div>
            </div>
           <div class="preguntas">
                <!-- div dinámico que se incluirá al crear una nueva pregunta
                    <div class="pregunta" style="margin-bottom: 10px;">
                        <div class="enunciado">
                            <input type="text" class="form-control" placeholder="Enunciado de la pregunta">
                        </div>
                    </div> 
                -->

                <!--div dinámico que se incluirá al crear una nueva opcion de respuesta
                <div class="respuestas">
                    <div class="respuestas" style="display: flex; align-items: center;">
                        <button class="btn btn-danger" id="eliminaRespuesta"><i class="bi bi-x-square"></i></button>
                        <input type="text" class="form-control" placeholder="Enunciado de la respuesta">
                        <input class="form-check-input" type="checkbox" style="width: 25px !important; height: 25px !important; margin-left: 10px;">
                    </div>

                </div>
                -->
           </div>

            <!-- boton dinámico <br>
            <button id="addAnswer" class="btn btn-outline-primary">
                <i class="bi bi-plus-circle-fill"></i> Añadir respuesta
            </button> -->             
           <div class="card" style="width:200px !important;">
                <div class="dropdown">
                    <select class="form-select" id="examType" name="examType" required style="border-radius:5px 5px 0px 0px;">
                        <!-- Opciones de tipos de examen -->
                        <?php
                            $consulta = "SELECT * FROM question_type";
                            $resultado = $conection->query($consulta);
                            // Comprobar si la consulta fue exitosa antes de iterar sobre los resultados
                            if ($resultado) {
                                // Iterar sobre los resultados obtenidos de la consulta
                                while ($fila = $resultado->fetch_assoc()) {
                                    $type_key = $fila["type_key"];
                                    // Imprimir cada opción del dropdown con los datos de la consulta
                                    echo '<option value="' . $type_key . '" componentName="' . $fila["component_name"] . '">';
                                    echo $fila["type_name"] . '</option>';
                                }
                            } else {
                                echo "Error al ejecutar la consulta: " . $conexion->error;
                            }
                        ?> 
                    </select>
                </div>
                <button id="addQuestion" type="button" class="btn btn-primary" style="border-radius:0px 0px 5px 5px;">
                    <i class="bi bi-plus-circle"></i> <?php foreach ($resultadoTrans as $traduccion) {
                        if ($traduccion['component_name'] === 'addQuestion') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                        } ?>
                </button>
            </div> 
        </div>
    </div>


    <div id="botonguardar" style="text-align:center;">
        <button id="guardarExamen" class="btn btn-primary" onclick="guardarExamen()" disabled>
            <i class="bi bi-check-circle"> <?php foreach ($resultadoTrans as $traduccion) {
                        if ($traduccion['component_name'] === 'guardarExamen') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                        } ?></i>
        </button>
    </div>
</div>
        
<!------------------ Scripts JavaScript ---------------------------------------------->

<script> 
    /*
    // Función para obtener el valor de la opción seleccionada
    function obtenerTipoExamen() {
        // Obtener todos los botones de opción
        var opciones = document.getElementsByName('examStatus');

        // Iterar sobre los botones de opción para encontrar el marcado
        for (var i = 0; i < opciones.length; i++) {
            if (opciones[i].checked) {
                // Si se encuentra una opción marcada, devolver su valor
                return opciones[i].value;
            }
        }
        // Si no se encuentra ninguna opción marcada, devolver null
        return null;
    }

    // Función para actualizar el valor de tipoExamen cuando se hace clic en un botón de opción
    function actualizarTipoExamen() {
        var statusExamen = obtenerTipoExamen();
        console.log("El tipo de examen seleccionado es: " + statusExamen);
    }

    // Agregar un listener de eventos 'click' a cada botón de opción
    var opcionesStatus = document.getElementsByName('examStatus');
    opcionesStatus.forEach(function(opcion) {
        opcion.addEventListener('click', actualizarTipoExamen);
    });

    // Función para agregar una nueva pregunta con efectos de jQuery UI
    function agregarPregunta() {
        var nuevaPregunta = `
            <div class="pregunta" style="">
                <div class="enunciado ui-widget-content ui-corner-all" style="display: flex; align-items: center; margin-top:20px; margin-bottom:10px;">
                    <input type="text" class="form-control" placeholder="Enunciado de la pregunta">
                    <button class="removeQuestion btn btn-secondary" style="margin: 5px;"><i class="bi bi-x-square"></i> </button>
                </div>
                <div class="respuestas">
                    <!-- Aquí se añadirán dinámicamente las respuestas -->
                </div>
                <!-- Botón para añadir respuesta -->
                <button id="addAnswer" class="btn btn-outline-primary" style="margin-bottom:10px;">
                    <i class="bi bi-plus-circle-fill"></i> Añadir respuesta
                </button>
            </div>
        `;
        $(".preguntas").append(nuevaPregunta);
        $(".pregunta").hide().fadeIn(); // Efecto al agregar una pregunta
    }

    // Función para agregar una nueva respuesta a una pregunta con efectos de jQuery UI
    function agregarRespuesta(event) {
        var pregunta = $(event.target).closest('.pregunta');
        var nuevasRespuestas = `
            <div class="respuesta ui-widget-content ui-corner-all" style="display: flex; align-items: center; margin-top: 10px; margin-bottom:10px; margin-left:20px; margin-right:20px;">
                <input class="form-check-input" type="checkbox" style="width: 25px !important; height: 25px !important; margin-right: 10px; margin-left: 10px;">
                <input type="text" class="form-control" placeholder="Enunciado de la respuesta">
                <button class="removeAnswer btn btn-danger" style="margin:5px;"><i class="bi bi-x-square"></i></button>
            </div>
        `;
        pregunta.find(".respuestas").append(nuevasRespuestas);
        $(".respuesta").hide().fadeIn(); // Efecto al agregar una respuesta
    }

    // Función para eliminar una respuesta con efectos de jQuery UI
    function eliminarRespuesta(event) {
        $(event.target).closest('.respuesta').slideUp("fast", function() {
            $(this).remove();
        });
    }

    // Función para eliminar una pregunta con efectos de jQuery UI
    function eliminarPregunta(event) {
        $(event.target).closest('.pregunta').slideUp("fast", function() {
            $(this).remove();
        });
    }

    // Evento de clic para añadir una nueva pregunta
    $("#addQuestion").click(agregarPregunta);

    // Evento de clic para añadir una nueva respuesta
    $(document).on('click', '#addAnswer', agregarRespuesta);

    // Evento de clic para eliminar una respuesta
    $(document).on('click', '.removeAnswer', eliminarRespuesta);

    // Evento de clic para eliminar una pregunta
    $(document).on('click', '.removeQuestion', eliminarPregunta);


    // Función para obtener los datos del formulario y convertirlos a JSON
    function obtenerDatosJSON() {
        // Objeto para almacenar los datos del examen
        var datos_examen = {
            titulo: $("#inputTitle").val(), // Obtener el título del examen del campo de entrada
            status: obtenerTipoExamen(), // Obtener el estatus del examen mediante otra función
            preguntas: [], // Inicializar un array para almacenar las preguntas del examen
            typekey: $("#examType").val()
        };

        // Iterar sobre todas las preguntas presentes en el formulario
        $(".pregunta").each(function(index, preguntaElement) {
            // Objeto para almacenar los datos de una pregunta individual
            var pregunta = {
                type: $(preguntaElement).find(".form-select").val(), // Obtener el tipo de la pregunta
                sentence: $(preguntaElement).find(".form-control").val(), // Obtener el enunciado de la pregunta
                respuestas: [] // Inicializar un array para almacenar las respuestas de la pregunta
            };

            // Iterar sobre todas las respuestas presentes en la pregunta actual
            $(preguntaElement).find(".respuesta").each(function(index, respuestaElement) {
                // Objeto para almacenar los datos de una respuesta individual
                var respuesta = {
                    answer: $(respuestaElement).find(".form-control").val(), // Obtener el texto de la respuesta
                    correct: $(respuestaElement).find(".form-check-input").prop("checked") // Verificar si la respuesta es correcta
                };
                pregunta.respuestas.push(respuesta); // Agregar la respuesta al array de respuestas de la pregunta
            });

            datos_examen.preguntas.push(pregunta); // Agregar la pregunta al array de preguntas del examen
        });

        var datosJSON = JSON.stringify(datos_examen); // Convertir el objeto a JSON
        console.log("Datos del JSON:", datosJSON); // Imprimir datos en la consola para verificar
        return datosJSON; // Devolver el JSON generado
    }

    // Función para enviar los datos JSON a PHP y guardar el examen en la base de datos
    function guardarExamen() {
        var datosJSON = obtenerDatosJSON();
        $.ajax({
            type: "POST",
            url: "exams/create/conf_create_exam.php", // Archivo PHP que maneja la inserción en la base de datos
            data: datosJSON,
            success: function(response) {
                console.log(response); // Muestra la respuesta del servidor en la consola
                alert("Examen guardado correctamente");
                // Redirige a la página de "mis exámenes"
                window.location.href = 'main.php?exams=own';
            },
            error: function(xhr, status, error) {
                console.error(error); // Muestra errores en la consola en caso de que ocurran
                alert("Error al guardar el examen");
            }
        });
    }
    */
</script>
