<?php

    // Recuperar título del examen
    if(isset($_GET['gid_exam'])) {
        $gid_exam = $_GET['gid_exam'];
        
        $consulta = "SELECT title FROM exams WHERE gid_exam = '$gid_exam'";
        $resultado = $conection->query($consulta);
        
        if ($resultado->num_rows > 0) {
            // Si hay resultados, los obtenemos y los mostramos
            $fila = $resultado->fetch_assoc();
            $titulo = $fila["title"];
        }
        
        // Obtener preguntas y opciones
        $preguntas = array();
        $consulta2 = "SELECT sentence, options, multioption FROM questions WHERE gid_exam = '$gid_exam'";
        $resultado2 = $conection->query($consulta2);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado2->fetch_assoc()) {
                $pregunta = array();
                $pregunta['sentence'] = $fila["sentence"];
                $pregunta['multioption'] = $fila["multioption"];
                $pregunta['options'] = json_decode($fila["options"], true);
                $preguntas[] = $pregunta;
            }
        }
    }
?>

<!-- HTML -->
<div class="col-lg-12">
      <div class="card">
            <div class="card-body">
                
                 <!-- Divs dinámicos para mostrar los resultados -->
                <div id="resultadosContainer">
                    <ul>
                        <li>
                            Total de preguntas:
                            <span id="totalRespuestas" style="color:#532970;"></span>
                        </li>
                        <li>
                            Respuestas correctas:
                            <span id="respuestasCorrectas" style="color:#532970;"></span>
                        </li>
                        <li>
                            Porcentaje de respuestas correctas:
                            <span id="resultado" style="color:#532970;"></span>
                            <span style="color:#532970; margin:0px;">%</span>
                        </li>
                        <li>
                            Tiempo transcurrido:
                            <span id="tiempoTranscurrido" style="color:#532970;"></span>
                        </li>
                    </ul>
                    <button class="btn btn-primary" onclick="descargarPDF()">Descargar PDF</button>
                </div>
                
            <!-- Contenido del formulario -->
                <div class="row">
                    <div id="contador-container" style="position: relative;">
                        <div id="cronometro">
                            <div id="contador">00:00:00</div>
                            <div>
                                <button id="botoncontador" class="btn btn-primary" onclick="detenerContador()">Detener</button>
                                <button id="botoncontador" class="btn btn-primary" onclick="reanudarContador()">Reanudar</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <h1 class="card-title" style="font-size:25px;margin-bottom:40px;width: calc(100% - 327px); padding-top:25px;"><?php echo isset($titulo) ? strtoupper($titulo) : ''; ?></h1>

                <form id="examForm" action="exams/do/conf_do_exam.php" method="post">
                   
                <input type="hidden" name="gid_exam" value="<?php echo $gid_exam; ?>">
                    
                <?php foreach ($preguntas as $index => $pregunta): ?>
                    <div class="pregunta">
                        <label for="inputNumber" class="col-sm-2 col-form-label" style="font-size:20px;font-weight:500; color:rgb(1, 41, 112);margin-bottom:15px;">
                            <span class="numero-pregunta"><?php echo ($index + 1) . ".&ensp;"; ?></span>
                            <?php echo $pregunta['sentence']; ?>
                            <?php if ($pregunta['multioption'] == 1): ?>
                                <br><span style="font-style: italic;font-size:15px;color:RGB(0 0 0);">(Multirespuesta)</span>
                            <?php endif; ?>
                        </label>
        
                        <?php 
                        $num_respuestas_correctas = 0;
                        foreach ($pregunta['options'] as $opcion): 
                            if ($opcion['correct']): 
                                $num_respuestas_correctas++; 
                            endif;

                            if ($pregunta['multioption'] == 1): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pregunta_<?php echo $index; ?>[]" value="<?php echo $opcion['answer']; ?>">
                                    <label class="form-check-label"><?php echo $opcion['answer']; ?></label>
                                </div>
                            <?php else: ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pregunta_<?php echo $index; ?>" value="<?php echo $opcion['answer']; ?>">
                                    <label class="form-check-label"><?php echo $opcion['answer']; ?></label>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if ($pregunta['multioption'] == 1): ?>
                            <script>
                                var checkboxes_<?php echo $index; ?> = document.querySelectorAll('[name="pregunta_<?php echo $index; ?>[]"]');
                                var numRespuestasCorrectas_<?php echo $index; ?> = <?php echo $num_respuestas_correctas; ?>;
                                var numRespuestasSeleccionadas_<?php echo $index; ?> = 0;
                                checkboxes_<?php echo $index; ?>.forEach(function(checkbox) {
                                    checkbox.addEventListener('change', function() {
                                        var checkedCheckboxes = document.querySelectorAll('[name="pregunta_<?php echo $index; ?>[]"]:checked');
                                        numRespuestasSeleccionadas_<?php echo $index; ?> = checkedCheckboxes.length;
                                        if (numRespuestasSeleccionadas_<?php echo $index; ?> > numRespuestasCorrectas_<?php echo $index; ?>) {
                                            checkbox.checked = false;
                                            numRespuestasSeleccionadas_<?php echo $index; ?>--;
                                        }
                                    });
                                });
                            </script>
                        <?php endif; ?>
                        <hr style="border-style: dotted;">
                    </div>
                <?php endforeach; ?>

                <input type="button" id="botonTerminar" class="btn btn-primary" value="Terminar" onclick="terminarExamen()">
            </form>

        </div>
    </div>
</div>

<!-- jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<!-- html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Variables globales para almacenar la información necesaria
    var preguntas = <?php echo json_encode($preguntas); ?>;
    var numRespuestasCorrectas = <?php echo json_encode($num_respuestas_correctas); ?>;
    
    ///////////////// FUNCIONES PARA CORREGIR EL EXAMEN ///////////////// 
    
        // Función para calcular resultados y mostrarlos
        function terminarExamen() {
            // Detener el cronómetro
            //detenerContador();

            // Capturar el tiempo transcurrido
            var tiempoTranscurridoFormato = document.getElementById("contador").textContent;

            // Mostrar los resultados
            document.getElementById('tiempoTranscurrido').innerText = tiempoTranscurridoFormato;

            // Obtener el número total de preguntas
            var totalPreguntas = preguntas.length;

            // Inicializar el contador de respuestas correctas
            var respuestasCorrectas = 0;

            // Iterar sobre todas las preguntas para calcular las respuestas correctas
            preguntas.forEach(function(pregunta, index) {
                if (pregunta.multioption == 1) {
                    // Obtener las respuestas seleccionadas por el usuario para esta pregunta
                    var respuestasSeleccionadas = Array.from(document.querySelectorAll('[name="pregunta_' + index + '[]"]:checked')).map(function(respuesta) {
                        return respuesta.value;
                    });

                    // Verificar si todas las respuestas seleccionadas son correctas
                    var respuestasCorrectasEsperadas = pregunta.options.filter(function(opcion) {
                        return opcion.correct;
                    }).map(function(opcion) {
                        return opcion.answer;
                    });

                    if (respuestasSeleccionadas.length === respuestasCorrectasEsperadas.length && respuestasSeleccionadas.every(function(respuesta) {
                        return respuestasCorrectasEsperadas.includes(respuesta);
                    })) {
                        respuestasCorrectas++; // Incrementar el contador de respuestas correctas
                    }
                } else {
                    // Obtener la respuesta seleccionada por el usuario para esta pregunta
                    var respuestaSeleccionada = document.querySelector('[name="pregunta_' + index + '"]:checked');
                    // Obtener la respuesta correcta para esta pregunta
                    var respuestaCorrecta;
                    pregunta.options.forEach(function(opcion) {
                        if (opcion.correct) {
                            respuestaCorrecta = opcion.answer;
                        }
                    });

                    // Verificar si la respuesta seleccionada coincide con la respuesta correcta
                    if (respuestaSeleccionada && respuestaSeleccionada.value === respuestaCorrecta) {
                        respuestasCorrectas++; // Incrementar el contador de respuestas correctas
                    }
                }
            });

            // Calcular el porcentaje de respuestas correctas
            var porcentajeCorrectas = (respuestasCorrectas / totalPreguntas) * 100;

            // Mostrar los resultados
            document.getElementById('totalRespuestas').innerText = totalPreguntas;
            document.getElementById('respuestasCorrectas').innerText = respuestasCorrectas;
            document.getElementById('resultado').innerText = porcentajeCorrectas.toFixed(2);
            document.getElementById('resultadosContainer').style.display = 'block'; // Cambiar el estilo a block

            // Estilizar las respuestas
            estilizarRespuestas();

            // Ocultar el cronómetro
            document.getElementById('cronometro').style.display = 'none';

            // Ocultar el botón de terminar
            document.getElementById('botonTerminar').style.display = 'none';
            
            // Obtener el valor de gid_exam del input hidden
            var gid_exam_value = document.querySelector('input[name="gid_exam"]').value;

            // Llamar a la función enviarDatos() con gid_exam_value como parámetro
            enviarDatos(totalPreguntas, respuestasCorrectas, porcentajeCorrectas, tiempoTranscurridoFormato, gid_exam_value);
            
             // Realizar scroll automático hacia arriba de la página
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }



        function estilizarRespuestas() {
        preguntas.forEach(function(pregunta, index) {
            var opciones;
            if (pregunta.multioption == 1) {
                opciones = document.querySelectorAll('[name="pregunta_' + index + '[]"]');
            } else {
                opciones = document.querySelectorAll('[name="pregunta_' + index + '"]');
            }

            opciones.forEach(function(opcion) {
                // Restablecer los estilos a su estado inicial
                opcion.parentNode.style.backgroundColor = ''; 

                // Verificar si la opción está marcada
                if (opcion.checked && opcion.parentNode) {
                    var valorRespuesta = opcion.value;
                    pregunta.options.forEach(function(respuesta) { // Cambio de nombre de variable
                        // Verificar si la opción es la respuesta seleccionada por el usuario
                        if (respuesta.answer === valorRespuesta) {
                            // Verificar si la respuesta es correcta o incorrecta y aplicar los estilos correspondientes
                            if (respuesta.correct) {
                                opcion.parentNode.style.backgroundColor = '#C0F4C0'; // Estilo para respuestas correctas
                                opcion.nextElementSibling.innerHTML += '&emsp;<span style="color:green;">✓</span>'; // Agregar tick verde
                            } else {
                                opcion.parentNode.style.backgroundColor = '#F4B5B5'; // Estilo para respuestas incorrectas
                                opcion.nextElementSibling.innerHTML += '&emsp;<span style="color:red;">✗</span>'; // Agregar tick verde
                            }
                        }
                    });
                } else { // Si la opción no está marcada pero es correcta, marcarla en verde y agregar el tick
                    pregunta.options.forEach(function(respuesta) {
                        if (respuesta.correct && respuesta.answer === opcion.value) {
                            opcion.parentNode.style.backgroundColor = '#C0F4C0'; // Estilo para respuestas correctas no seleccionadas
                        }
                    });
                }
            });
        });
    }


        // Función para enviar datos con AJAX
        function enviarDatos(totalPreguntas, respuestasCorrectas, porcentajeCorrectas, tiempoTranscurridoFormato, gid_exam) {
            // Crear un objeto con los datos a enviar
            var datos = {
                totalPreguntas: totalPreguntas,
                respuestasCorrectas: respuestasCorrectas,
                porcentajeCorrectas: porcentajeCorrectas,
                tiempoTranscurrido: tiempoTranscurridoFormato,
                gid_exam: gid_exam 
            };

            // Realizar la solicitud AJAX usando jQuery
            $.ajax({
                type: "POST",
                url: "exams/do/conf_do_exam.php",
                data: JSON.stringify(datos),
                contentType: "application/json",
                success: function(response) {
                    console.log('Datos enviados correctamente'); // Mensaje de éxito en la consola
                },
                error: function(xhr, status, error) {
                    console.error('Error al enviar los datos:', error); // Mensaje de error en la consola si la petición no fue exitosa
                }
            });
        }

    
    // Función para descargar el pdf usando la librería
    function descargarPDF() {
        const divParaExportar = document.querySelector('.card-body'); // Selecciona el div con la clase "card-body"

        // Obtener la fecha y hora actual en el formato deseado
        const ahora = new Date();
        const fechaHora = `${agregarCeros(ahora.getDate())}.${agregarCeros(ahora.getMonth() + 1)}.${ahora.getFullYear()}_${agregarCeros(ahora.getHours())}.${agregarCeros(ahora.getMinutes())}.${agregarCeros(ahora.getSeconds())}`;

        html2canvas(divParaExportar).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new window.jspdf.jsPDF(); // Modificamos esta línea para acceder a jsPDF
            const ancho = pdf.internal.pageSize.getWidth();
            const altura = pdf.internal.pageSize.getHeight();
            pdf.addImage(imgData, 'PNG', 0, 0, ancho, altura);

            // Nombrar el archivo PDF con la fecha y hora actual
            pdf.save(`examup_${fechaHora}.pdf`);
        });
    }
</script>
