<?php
/**
 * Recebe o POST do formulário de edição (cadastro_edit.php) e atualiza o registro.
 */
include "conexao.php";

$pk = pessoas_primary_key($conn);

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: pesquisa.php");
    exit;
}

if (!$conn instanceof mysqli) {
    echo "Erro: sem conexão com o banco.";
    exit;
}

$id_raw = trim((string) ($_POST["id"] ?? ""));
[$okId, $idSql] = pessoas_sql_pk_value($conn, $pk, $id_raw);
$nome = trim($_POST["nome"] ?? "");
$endereco = trim($_POST["endereco"] ?? "");
$telefone = trim($_POST["telefone"] ?? "");
$email = trim($_POST["email"] ?? "");
$data_nascimento = trim($_POST["data_nascimento"] ?? "");

if (!$okId || $nome === "") {
    echo "Erro: dados inválidos para atualização.";
    exit;
}

$nome_e = mysqli_real_escape_string($conn, $nome);
$endereco_e = mysqli_real_escape_string($conn, $endereco);
$telefone_e = mysqli_real_escape_string($conn, $telefone);
$email_e = mysqli_real_escape_string($conn, $email);

if ($data_nascimento === "") {
    $data_sql = "NULL";
} else {
    $data_sql = "'" . mysqli_real_escape_string($conn, $data_nascimento) . "'";
}

$sql = "UPDATE `pessoas` SET
        `nome` = '$nome_e',
        `endereco` = '$endereco_e',
        `telefone` = '$telefone_e',
        `email` = '$email_e',
        `data_nascimento` = $data_sql
        WHERE `$pk` = $idSql";

if (mysqli_query($conn, $sql)) {
    header("Location: pesquisa.php");
    exit;
}

echo "Erro ao atualizar: " . htmlspecialchars(mysqli_error($conn), ENT_QUOTES, "UTF-8");
