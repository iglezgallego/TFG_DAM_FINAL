<?php
    session_start();
    include "../../../conection/config.php";

    // Recibir los datos JSON enviados desde JavaScript
    $json_data = file_get_contents('php://input');

    // Decodificar los datos JSON a un array asociativo de PHP
    $data = json_decode($json_data, true);

    // Extraer los datos individuales en variables
    $total_answers = $data['totalPreguntas'];
    $correct_answers = $data['respuestasCorrectas'];
    $result = $data['porcentajeCorrectas'];
    $time = $data['tiempoTranscurrido'];
    $gid_exam = $data['gid_exam'];
    $gid_user = $_SESSION['giduser'];


    // Guardar resultados en la base de datos
    //Ejecuto la consulta SQL para insertar los datos en la tabla results
        $consulta = "INSERT INTO results (
        gid_exam,
        gid_user,
        total_answers,
        correct_answers,
        result,
        time
        ) VALUES (
        '$gid_exam',
        '$gid_user',
        '$total_answers',
        '$correct_answers',
        '$result',
        '$time'
        )";

        // Ejecutar la consulta SQL
        $resultado = $conection->query($consulta);


    // Verificar si la actualización fue exitosa
    if ($resultado) {
        echo "Resultado guardados exitosamente";
    } else {
        echo "Error al guardar: " . $conection->error;
    }

?>