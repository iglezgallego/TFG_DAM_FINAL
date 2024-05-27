<?php
    header('Content-Type: text/html; charset=utf-8');

    session_start();
    include "../../../conection/config.php";

    // Establecer la codificación de caracteres en la conexión a la base de datos
    $conection->query("SET NAMES 'utf8mb4'");

    // Recibe los datos JSON enviados por AJAX
    $json_data = file_get_contents("php://input");

    // Convierte los datos JSON en un array de PHP
    $data = json_decode($json_data, true);

    // Acceso a los datos como array de PHP
    $titulo = empty($data['titulo']) ? 'untitled' : mb_convert_encoding($data['titulo'], 'UTF-8');
    $status = $data['status'];
    $preguntas = $data['preguntas'];
    $typekey = $data['typekey'];

    // Obtengo el gid_exam
    // Combina la ID del usuario, el título del examen y la marca de tiempo actual
    $giduser = $_SESSION['giduser'];
    $combinedvalue = $giduser . $titulo . time();
    // Calcula el hash único utilizando el algoritmo SHA-256
    $gidexam = hash('sha256', $combinedvalue);

    // Por defecto, al crear, favorito va a ser false
    $favorite = 0;
    // La fecha de creado obtiene la fecha de hoy
    $datecreated = date('Y-m-d');

    // Iterar sobre las preguntas
    foreach ($preguntas as $pregunta) {
        // Acceder al enunciado de la pregunta y asegurarnos de que esté codificado en UTF-8
        $enunciado = empty($pregunta['sentence']) ? 'untitled' : mb_convert_encoding($pregunta['sentence'], 'UTF-8');

        // Obtener las respuestas de la pregunta
        $respuestas = $pregunta['respuestas'];

        // Inicializar el contador de respuestas correctas
        $respuestas_correctas = 0;

        // Verificar si hay más de una respuesta correcta
        foreach ($respuestas as $respuesta) {
            // Acceder al texto de la respuesta y asegurarnos de que esté codificado en UTF-8
            $respuesta['answer'] = mb_convert_encoding($respuesta['answer'], 'UTF-8');

            // Verificar si la respuesta es correcta
            if ($respuesta['correct'] == true) {
                // Incrementar el contador de respuestas correctas
                $respuestas_correctas++;
            }
        }
        
        // Determinar el valor de $multioption
        if ($respuestas_correctas > 1) {
            $multioption = 1;
        } else {
            $multioption = 0;
        }

        // Convertir las respuestas a formato JSON
        $respuestasJSON = json_encode($respuestas, JSON_UNESCAPED_UNICODE);

        //Ejecuto la consulta SQL para insertar los datos en la tabla question
        $consulta2 = "INSERT INTO questions (
        gid_exam,
        type_key,
        sentence,
        options,
        multioption
        ) VALUES (
        '$gidexam',
        '$typekey',
        '$enunciado',
        '$respuestasJSON',
        '$multioption'
        )";

        // Ejecutar la consulta SQL
        $resultado2 = $conection->query($consulta2);
    }

    //Ejecuto la consulta SQL para insertar los datos en la tabla exams
    $consulta = "INSERT INTO exams (
    gid_exam,
    gid_user,
    title,
    date_created,
    status
    ) VALUES (
    '$gidexam',
    '$giduser',
    '$titulo',
    '$datecreated',
    '$status'
    )";

    // Ejecutar la consulta SQL
    $resultado = $conection->query($consulta);

    // Si el resultado ha sido correcto
    if ($resultado == TRUE && $resultado2 == TRUE) {
        echo "Registro actualizado correctamente";
    // En caso contrario muestra el error
    } else {
        echo "Error al actualizar el registro: . $conection->error; ";
    }

?>
