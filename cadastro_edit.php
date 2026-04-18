<?php
// Lógica antes de qualquer HTML
include "conexao.php";

if (!$conn instanceof mysqli) {
    echo "Erro: sem conexão com o banco.";
    exit;
}

$pk = pessoas_primary_key($conn);
$id_raw = trim((string) ($_GET["id"] ?? $_GET["cod_pessoa"] ?? ""));
[$okId, $idSql] = pessoas_sql_pk_value($conn, $pk, $id_raw);

if (!$okId) {
    echo "Erro: ID inválido ou não informado na URL. Use o botão Editar na pesquisa ou informe ?id=…";
    exit;
}

$sql = "SELECT * FROM `pessoas` WHERE `$pk` = $idSql LIMIT 1";
$dados = mysqli_query($conn, $sql);

if (!$dados) {
    echo "Erro na consulta: " . htmlspecialchars(mysqli_error($conn), ENT_QUOTES, "UTF-8");
    exit;
}

$linha = mysqli_fetch_assoc($dados);

if (!$linha) {
    echo "Erro: registro não encontrado.";
    exit;
}

/** Para exibir com segurança dentro de atributos HTML */
function h($s)
{
    return htmlspecialchars((string) $s, ENT_QUOTES, "UTF-8");
}

/** Formato YYYY-MM-DD para <input type="date"> */
function data_para_input($data)
{
    if ($data === null || $data === "") {
        return "";
    }
    $s = (string) $data;
    return substr(str_replace("T", " ", $s), 0, 10);
}

$data_input = data_para_input($linha["data_nascimento"] ?? "");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Alteração de Cadastro</title>
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3 bg-white p-4 shadow-sm rounded">
                <h1 class="mb-4 h3 text-primary">Alterar Cadastro</h1>

                <form action="edit_script.php" method="POST">

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Nome Completo</label>
                        <input type="text" class="form-control" name="nome" required
                               value="<?php echo h($linha["nome"] ?? ""); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Endereço</label>
                        <input type="text" class="form-control" name="endereco"
                               value="<?php echo h($linha["endereco"] ?? ""); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control" name="telefone"
                               value="<?php echo h($linha["telefone"] ?? ""); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email"
                               value="<?php echo h($linha["email"] ?? ""); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" name="data_nascimento"
                               value="<?php echo h($data_input); ?>">
                    </div>

                    <input type="hidden" name="id" value="<?php echo h(pessoas_row_id($linha, $conn)); ?>">

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-success">Salvar Alterações</button>
                        <a href="pesquisa.php" class="btn btn-outline-secondary ms-2">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
