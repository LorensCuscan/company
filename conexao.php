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
    if (!$data) return ""; // Caso a data esteja vazia no banco
    
    // O separador correto é o hífen "-" que vem do MySQL
    $d = explode("-", $data); 
    
    // Monta no padrão brasileiro: dia/mes/ano
    $dt = $d[2] . "/" . $d[1] . "/" . $d[0]; 
    
    return $dt;
}

      
?>

