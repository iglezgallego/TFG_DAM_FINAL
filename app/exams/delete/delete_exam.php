<?php
//ELIMINAR DESDE LA TABLA "MIS EXAMENES"
    session_start();
    include "../../../conection/config.php";

    // Verificar si se ha recibido un parámetro de GID para eliminar
    if(isset($_GET['gid_exam']) && !empty($_GET['gid_exam'])) {
        // Obtener el GID recibido
        $gid_exam = $_GET['gid_exam'];
        
         /* Imprimir el valor de gid_exam para verificar
        echo "El valor de gid_exam es: ";
        var_dump($gid_exam);
        echo "<br>"; */
    }
    
    // Realizar la consulta SQL para eliminar el registro de la tabla exams
    $consulta = "DELETE FROM exams WHERE gid_exam = '$gid_exam'";
    $resultado = $conection->query($consulta);

    // Realizar la consulta SQL para eliminar el registro de la tabla shared exams
    $consulta2 = "DELETE FROM shared_exams WHERE gid_exam = '$gid_exam'";
    $resultado2 = $conection->query($consulta2);

    // // Realizar la consulta SQL para eliminar el registro de la tabla favorites
    $consulta3 = "DELETE FROM favorites WHERE gid_exam = '$gid_exam'";
    $resultado3 = $conection->query($consulta3);
    
    // Realizar la consulta SQL para eliminar las preguntas relacionadas con el examen
    $consulta4 = "DELETE FROM questions WHERE gid_exam = '$gid_exam'";
    $resultado4 = $conection->query($consulta4);

    // Realizar consulta SQL para eliminar los resultados relacionados con el examen
    $consulta5 = "DELETE FROM results WHERE gid_exam = '$gid_exam'";
    $resultado5 = $conection->query($consulta5);



    // Verificar si se ejecutaron correctamente
    if ($resultado && $resultado2 && $resultado3 && $resultado4) {
        echo "Los datos fueron eliminados correctamente de ambas tablas.";
        header("Location: ../../main.php?exams=own");
    } else {
        echo "Error al eliminar los datos: " . $conection->error;
    }