<?php
include "conexao.php";

// Pega o ID que veio via URL (apagar.php?id=...)
$id = $_GET['id'] ?? '';

if ($id !== '') {
    // Escapa o ID para evitar SQL Injection
    $id_esc = mysqli_real_escape_string($conn, $id);
    
    // ATENÇÃO: Troque 'cod_pessoa' pelo nome real da sua coluna de ID no banco
    $sql = "DELETE FROM `pessoas` WHERE `cod_pessoa` = '$id_esc'";

    if (mysqli_query($conn, $sql)) {
        header("Location: pesquisa.php?msg=excluido");
        exit; // Sempre use exit após um header de redirecionamento
    } else {
        echo "Erro ao excluir: " . mysqli_error($conn);
    }
} else {
    echo "ID não fornecido.";
}
?>