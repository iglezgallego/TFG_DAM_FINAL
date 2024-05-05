<?php
    session_start();
    include "../conection/config.php";

    //Obtengo el gid_user
    //Combino user_name y email
    $combinedvalue = $_POST['user'] . $_POST['email'];
    //Convierto el valor combinado a hexadecimal
    $giduser = bin2hex($combinedvalue);
    //echo '<script>console.log("' . htmlspecialchars($giduser) . '")</script>';

    //Realizo la consulta para el signin
    $consulta = "SELECT * FROM users
    WHERE
    user_name = '".$_POST['user']."'
    OR
    email = '".$_POST['email']."'
    ";
    $resultado = $conection->query($consulta);
    //Compruebo que no existan dos usuarios y correo iguales en la base de datos
    if($fila=$resultado->fetch_assoc()){
        header("Location:singup.php?error=si");
        //Si coincide, es decir, hay dos iguales creo la varible "error" dentro del enlace
    }else{
        //Si no coincide hago un INSERT en la tabla usuarios
        $rolkey = 779442001;
        $peticion = " INSERT INTO
        users
        VALUES
        (NULL,
        '".$giduser."',
        '".$_POST['user']."',
        '".$_POST['email']."',
        '".$_POST['password']."',
        '".$rolkey."',
        '".$_POST['lang_key']."'
        )";

        $conection->query($peticion);
        header("Location:../signin/signin.php?registro=si");
        //creo el parámetro "registro" en la url y le paso el valor "si"
    }
?>