<?php
    header('Content-Type: text/html; charset=utf-8');
    
    session_start();
    include "../../../conection/config.php";
    
    // Establecer la codificación de caracteres en la conexión a la base de datos
    $conection->query("SET NAMES 'utf8mb4'");
    
    // Recibe los datos JSON y gidExam enviados por AJAX
    $json_data = isset($_POST['datosJSON']) ? $_POST['datosJSON'] : null;
    $gidExam = isset($_POST['gidExam']) ? $_POST['gidExam'] : null;
    
    // Convierte los datos JSON en un array de PHP
    $data = json_decode($json_data, true);
    
    // Accede a los datos del JSON
    $titulo = isset($data['titulo']) ? $data['titulo'] : null;
    $status = isset($data['status']) ? $data['status'] : null;
    $preguntas = $data['preguntas'];
    $typekey = $data['typekey'];
    
    // La fecha de actualización obtiene la fecha de hoy
    $dateupdated = date('Y-m-d');
    
    // Si el título está vacío, asigna "untitled"
    $titulo = empty($titulo) ? 'untitled' : $titulo;
    
    // Consulta SQL para actualizar el título y el estado del examen
    $consulta = "UPDATE exams SET title = '$titulo', status = '$status', date_updated = '$dateupdated' WHERE gid_exam = '$gidExam'";
    
    // Ejecutar la consulta SQL
    $resultado = $conection->query($consulta);
    
    // Realizar la consulta SQL para eliminar las preguntas relacionadas con el examen
    $consulta2 = "DELETE FROM questions WHERE gid_exam = '$gidExam'";
    $resultado2 = $conection->query($consulta2);
    
    // Iterar sobre las preguntas
    foreach ($preguntas as $pregunta) {
        // Acceder al enunciado de la pregunta, asegurarnos de que esté codificado en UTF-8 y si está vacío poner "untitled"
        $enunciado = !empty($pregunta['sentence']) ? $pregunta['sentence'] : 'untitled';
        $enunciado = mb_convert_encoding($enunciado, 'UTF-8');
        
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
        $multioption = ($respuestas_correctas > 1) ? 1 : 0;
        
        // Convertir las respuestas a formato JSON
        $respuestasJSON = json_encode($respuestas, JSON_UNESCAPED_UNICODE);
        
        //Ejecuto la consulta SQL para insertar los datos en la tabla question
        $consulta3 = "INSERT INTO questions (
        gid_exam,
        type_key,
        sentence,
        options,
        multioption
        ) VALUES (
        '$gidExam',
        '$typekey',
        '$enunciado',
        '$respuestasJSON',
        '$multioption'
        )";
        
        // Ejecutar la consulta SQL
        $resultado3 = $conection->query($consulta3);
    }
    
    
    // Verificar si la actualización fue exitosa
    if ($resultado && $resultado2 && $resultado3) {
        echo "Actualización exitosa";
    } else {
        echo "Error al actualizar: " . $conection->error;
    }
    
?>
