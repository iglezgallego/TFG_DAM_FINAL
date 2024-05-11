<?php 
    session_start();
    include "../conection/config.php";
    

    // Obtengo los datos del formulario POST
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $langkey = $_POST['lang_key'];
                        
    // Realizo la consulta para actualizar los datos
    $consulta = "UPDATE users SET password='$password', email='$email', lang_key='$langkey', user_name='$username' WHERE gid_user='{$_SESSION['giduser']}'";
    $resultado = $conection->query($consulta);
    
    // Si el resultado ha sido correcto
    if ($resultado == TRUE) {
        //echo "Registro actualizado correctamente";
        // Guarda los nuevos valores en las variables de sesión
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['langkey'] = $_POST['lang_key'];
        // Realizo la consulta para actualizar los datos
        $consulta2 = "SELECT code_name FROM languages WHERE lang_key = '".$_SESSION['langkey']."' ";
        $resultado2 = $conection->query($consulta2);
            if($fila = $resultado2->fetch_assoc()){
                $_SESSION['language'] = $fila['code_name'];
            }
    // En caso contrario muestra el error
    }else{
        echo "Error al actualizar el registro: . $conection->error; ";
    }
    // Redirige a al perfil del usuario
    echo "<script>window.location.href = 'main.php?profile';</script>";

    
?>