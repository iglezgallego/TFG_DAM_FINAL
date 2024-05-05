<?php
    if(isset($_GET['gid_exam'])) {
        $gid_exam = $_GET['gid_exam'];

        $consulta = "SELECT title, status FROM exams WHERE gid_exam = '$gid_exam'";
        $resultado = $conection->query($consulta);
        
        if ($resultado->num_rows > 0) {
            // Si hay resultados, los obtenemos y los mostramos
            $fila = $resultado->fetch_assoc();
            $titulo = $fila["title"];
            $estado = $fila["status"];
    }
}

?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>
            
            <div class="row">
                <div class="col-md-6" style="margin-bottom:20px;">
                    <input type="text" class="form-control" id="inputTitle" placeholder="Título del examen" value="<?php echo isset($titulo) ? $titulo : ''; ?>">
                </div>
                <div class="col-md-6">
                    <!-- Grupo de botones para seleccionar el estado del examen -->
                    <div class="btn-group" role="group" aria-label="Tipo de examen">
                        <input type="radio" class="btn-check" id="publicCheckbox" autocomplete="off" name="examStatus" value="public" <?php echo (isset($estado) && $estado == 'public') ? 'checked' : ''; ?>>
                        <label class="btn btn-outline-primary" for="publicCheckbox">Público</label>

                        <input type="radio" class="btn-check" id="privateCheckbox" autocomplete="off" name="examStatus" value="private" <?php echo (isset($estado) && $estado == 'private') ? 'checked' : ''; ?>>
                        <label class="btn btn-outline-primary" for="privateCheckbox">Privado</label>
                    </div>
                </div>
            </div>
            
           <div class="preguntas">
            <?php
                $consulta = "SELECT sentence, options FROM questions WHERE gid_exam = '$gid_exam'";
                $resultado = $conection->query($consulta);
               
               if ($resultado->num_rows > 0) {
                    // Itera sobre los resultados y muestra cada pregunta con sus respuestas
                    while ($fila = $resultado->fetch_assoc()) {
                        $sentence = $fila["sentence"];
                        $options_json = $fila["options"];
                        $options = json_decode($options_json, true); // Decodifica el JSON a un array asociativo
                        
                        // Muestra la pregunta
                        echo '<div class="pregunta">
                        <div class="enunciado ui-widget-content ui-corner-all" style="display: flex; align-items: center; margin-top:20px; margin-bottom:10px;">
                        <input type="text" class="form-control" placeholder="Enunciado de la pregunta" value="' . $sentence . '">
                        <button class="removeQuestion btn btn-secondary" style="margin: 5px;"><i class="bi bi-x-square"></i></button>
                        </div>';
                        
                        // Muestra las respuestas
                        echo '<div class="respuestas">';
                        foreach ($options as $option) {
                            $answer = $option["answer"];
                            $correct = $option["correct"];
                            $checked = $correct ? 'checked' : ''; // Verifica si la respuesta es correcta y establece el atributo "checked"
                            echo '<div class="respuesta ui-widget-content ui-corner-all" style="display: flex; align-items: center; margin-top: 10px; margin-bottom:10px; margin-left:20px; margin-right:20px;">
                            <input class="form-check-input" type="checkbox" style="width: 25px !important; height: 25px !important; margin-right: 10px; margin-left: 10px;" ' . $checked . '>
                            <input type="text" class="form-control" placeholder="Enunciado de la respuesta" value="' . $answer . '">
                            <button class="removeAnswer btn btn-danger" style="margin:5px;"><i class="bi bi-x-square"></i></button>
                            </div>';
                        }
                        echo '</div>'; // Cierre de las respuestas
                        
                        // Botón para añadir respuesta
                        echo '<button id="addAnswer" class="btn btn-outline-primary" style="margin-bottom:10px;">
                        <i class="bi bi-plus-circle-fill"></i> Añadir respuesta
                        </button>

                        </div>'; // Cierre de la pregunta
                    }
               }
            ?>
           </div>
     
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
                    <i class="bi bi-plus-circle"></i> Añadir pregunta
                </button>
            </div> 
        </div>
    </div>

<?php
    echo '
    <div id="botonguardar" style="text-align:center;">
        <button id="guardarExamen" class="btn btn-primary" data-gid-exam="'.$gid_exam.'" onclick="editarExamen(this.getAttribute(\'data-gid-exam\'))">
            <i class="bi bi-check-circle"> Editar examen</i>
        </button>
    </div>';
?>
</div>
