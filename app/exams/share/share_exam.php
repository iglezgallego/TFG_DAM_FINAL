<?php
    session_start();
    include "../../../conection/config.php";
    
    // La fecha de compartir obtiene la fecha de hoy y favorito al insertar será 0
    $dateshared = date('Y-m-d');
    $favorite = 0;

    // Verificar si se ha recibido un parámetro de GID y el email del usuario
    if(isset($_POST['gid_exam'], $_POST['email']) && !empty($_POST['gid_exam']) && !empty($_POST['email'])) {
    // Obtener el GID y el email recibidos
        $gidexam = $_POST['gid_exam'];
        $email = $_POST['email'];
        
        // Obtener el gid_user correspondiente al email en la tabla users
        $consulta = "SELECT gid_user FROM users WHERE email = '$email'";
        $resultado = $conection->query($consulta);
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $giduser = $fila['gid_user'];
        
            // Verificar si el examen ya está compartido con el usuario
            $consulta_existencia = "SELECT * FROM shared_exams WHERE gid_exam = '$gidexam' AND gid_user = '$giduser'";
            $resultado_existencia = $conection->query($consulta_existencia);

            if ($resultado_existencia->num_rows > 0) {
                // Si el examen ya está compartido con el usuario, enviar un mensaje de error
                if (isset($_SESSION['language']) && $_SESSION['language'] === 'en_EN') {
                            // Enviar una respuesta JSON al cliente en inglés
                            $response = array('success' => false, 'message' => 'This test has already been shared with the user');
                        } else {
                            // Enviar una respuesta JSON al cliente en español
                            $response = array('success' => false, 'message' => 'Este examen ya ha sido compartido con el usuario');
                        }
                echo json_encode($response);
                
            } else {
                
                // Consulta SQL para insertar los datos en la tabla exams
                $consulta2 = "INSERT INTO shared_exams (
                gid_exam,
                gid_user,
                date_shared
                ) VALUES (
                '$gidexam',
                '$giduser',
                '$dateshared'
                )";

                // Ejecutar la consulta SQL
                $resultado2 = $conection->query($consulta2);

                // Si la inserción ha sido exitosa
                    if ($resultado2 === TRUE) {
                        // Enviar una respuesta JSON al cliente
                        if (isset($_SESSION['language']) && $_SESSION['language'] === 'en_EN') {
                            // Enviar una respuesta JSON al cliente en inglés
                            $response = array('success' => true, 'message' => 'Exam shared successfully');
                        } else {
                            // Enviar una respuesta JSON al cliente en español
                            $response = array('success' => true, 'message' => 'Examen compartido correctamente');
                        }
                        echo json_encode($response);
                    } else {
                        // Si hubo un error en la inserción, enviar una respuesta JSON con el mensaje de error
                        if (isset($_SESSION['language']) && $_SESSION['language'] === 'en_EN') {
                            // Enviar una respuesta JSON al cliente en inglés
                            $response = array('success' => false, 'message' => 'Error sharing the exam');
                        } else {
                            // Enviar una respuesta JSON al cliente en español
                            $response = array('success' => false, 'message' => 'Error al compartir el examen');
                        }
                        echo json_encode($response);
                    } 
                }
            } else {
                // Si el email introducido no corresponde a ningún usuario, enviar una respuesta JSON con un mensaje de error
                if (isset($_SESSION['language']) && $_SESSION['language'] === 'en_EN') {
                            // Enviar una respuesta JSON al cliente en inglés
                            $response = array('success' => false, 'message' => 'The email entered does not correspond to any user');
                        } else {
                            // Enviar una respuesta JSON al cliente en español
                            $response = array('success' => false, 'message' => 'El email introducido no corresponde con ningún usuario');
                        }
                echo json_encode($response);
            }
}
