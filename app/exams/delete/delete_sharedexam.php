<?php
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
    
    
    // Realizar la consulta SQL para eliminar el registro solo de la tabla shared_exams
    $consulta = "DELETE FROM shared_exams WHERE gid_exam = '$gid_exam' AND gid_user = '".$_SESSION['giduser']."'";
    $resultado = $conection->query($consulta);

    // Verificar si se ejecutaron correctamente
    if ($resultado) {
        echo "Los datos fueron eliminados correctamente de ambas tablas.";
        header("Location: ../../main.php?exams=shared");
    } else {
        echo "Error al eliminar los datos: " . $conection->error;
    }