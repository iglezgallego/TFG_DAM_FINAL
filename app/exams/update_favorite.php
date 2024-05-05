<?php
    session_start();
    include "../../conection/config.php";
    // Parámetros enviados
    $examenId = $_POST['examenId'];
    
    $consulta = "SELECT * FROM favorites WHERE gid_user = '".$_SESSION['giduser']."' AND gid_exam = '".$examenId."'";
    $resultado = $conection->query($consulta);

    if ($resultado ->num_rows > 0){
        $consulta2 = "DELETE FROM favorites WHERE gid_user = '".$_SESSION['giduser']."' AND gid_exam = '".$examenId."'";
        $resultado2 = $conection->query($consulta2);
    } else {
        $consulta3 = "INSERT INTO favorites (
        gid_exam,
        gid_user
        ) VALUES (
        '$examenId',
        '".$_SESSION['giduser']."'
        )";
        $resultado3 = $conection->query($consulta3);
    }
?>