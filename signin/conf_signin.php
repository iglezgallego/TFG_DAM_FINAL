<?php
    //Comienzo a trabajar con sesiones
    session_start();
    //Incluyo el archivo con los datos de conexión
    include "../conection/config.php";
    //Realizo la consulta
    $consulta = "SELECT * FROM users WHERE user_name = '".$_POST['username']."' AND password = '".$_POST['password']."'";
    $resultado = $conection->query($consulta);
    //creo la variable de sesión pasas
    $_SESSION['enter'] = false;
    //Si existe coincidencia en la bbdd
    if($fila = $resultado->fetch_assoc()){
        //creo las variables de sesión necesarias
        $_SESSION['username'] = $fila['user_name'];
        $_SESSION['giduser']= $fila['gid_user'];
        $_SESSION['iduser']= $fila['id_user'];
        $_SESSION['rolkey'] = $fila['rol_key'];
        $_SESSION['langkey'] = $fila['lang_key'];
        $_SESSION['enter'] = true;
        //Redirijo a la app
        header("Location: ../app/main.php");
        exit();
    }else{
        $_SESSION['enter'] = false;
        header("Location: signin.php?error=1");
        exit();

    }
?>