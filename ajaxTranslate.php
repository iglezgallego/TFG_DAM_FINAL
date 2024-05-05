<?php
    include "conection/config.php";
    // Parámetros enviados
    $language = $_GET['language'];
    $componentNameArray = json_decode($_GET['componentNameArray']);
    // Ahora $componentNameArray contiene el array original
    $resultTranslation = array();

    foreach ($componentNameArray as $componentName) {
        $consulta = "SELECT $language FROM translations WHERE component_name = '$componentName'";
        $resultado = $conection->query($consulta);
        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            // Obtener los datos de la fila
            $fila = $resultado->fetch_assoc();
            $translation = $fila[$language];
            // Almacenar el resultado en el array
            $resultTranslation[$componentName] = $translation;
        } else {
            // Si no se encontraron resultados
            $resultTranslation[$componentName] = "No se encontró ninguna traducción";
        }
    }
    // Devolver los resultados como respuesta JSON
    echo json_encode($resultTranslation);
?>