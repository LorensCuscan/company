<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "company";

    if ($conn = mysqli_connect($server, $user, $pass, $bd)) {
        echo "";
    }
    else {
        echo "Erro";
    }

    function mostra_data($data) {
        $data = explode("", $data);
        }
?>

