<?php
    //elimino session y redirijo a home.php
    session_start();
    session_destroy();
    //Redirijo al home de la página
    header('Location:../../signin/signin.php');
?>