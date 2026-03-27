<?php
    $server = "localhost";
    $user = "root";
    $bd = "company";

    if ($conn = mysqli_connect($server, $user, $pass, $bd)) {
        echo "Conectado";
    }
    else {
        echo "Erro";
    }
?>