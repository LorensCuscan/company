<?php
include "conexao.php";

$sql = "TRUNCATE TABLE pessoas";

if (mysqli_query($conn, $sql)) {
    // Redireciona de volta para a pesquisa com uma mensagem de sucesso
    header("Location: pesquisa.php?msg=sucesso");
} else {
    echo "Erro ao limpar: " . mysqli_error($conn);
}
?>