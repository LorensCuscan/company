<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pesquisar</title>
</head>
<body>

    <?php
    include "conexao.php";

    $pesquisa = trim($_POST["busca"] ?? "");
    $pesquisa_esc = mysqli_real_escape_string($conn, $pesquisa);

    function pesquisa_formatar_data($data)
    {
        if ($data === null || $data === "") {
            return "—";
        }
        $s = substr(str_replace("T", " ", (string) $data), 0, 10);
        $d = explode("-", $s);
        if (count($d) !== 3) {
            return "—";
        }
        return $d[2] . "/" . $d[1] . "/" . $d[0];
    }

    function h($s)
    {
        return htmlspecialchars((string) $s, ENT_QUOTES, "UTF-8");
    }

    $pk = pessoas_primary_key($conn);

    $sql = "SELECT * FROM `pessoas` WHERE `nome` LIKE '%$pesquisa_esc%' ORDER BY `nome`";
    $dados = mysqli_query($conn, $sql);
    if (!$dados) {
        $erro_query = mysqli_error($conn);
    }
    ?>

    <div class="container mt-5">
        <nav class="navbar bg-body-tertiary p-3 rounded">
            <div class="container-fluid">
                <form class="d-flex w-100" action="pesquisa.php" method="POST" role="search">
                    <input class="form-control me-2" type="search" name="busca" placeholder="Pesquisar"
                           value="<?php echo h($pesquisa); ?>">
                    <button class="btn btn-outline-success" type="submit">Busca</button>
                </form>
            </div>
        </nav>

        <?php if (!empty($erro_query)) : ?>
            <div class="alert alert-danger mt-3" role="alert">
                Erro na consulta: <?php echo h($erro_query); ?>
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Data de Nascimento</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($dados) && $dados) {
                        $count = 0;
                        while ($linha = mysqli_fetch_assoc($dados)) {
                            $count++;
                            $data_br = pesquisa_formatar_data($linha["data_nascimento"] ?? "");
                            ?>
                            <tr>
                                <td><?php echo h($linha["nome"] ?? ""); ?></td>
                                <td><?php echo h($linha["endereco"] ?? ""); ?></td>
                                <td><?php echo h($linha["telefone"] ?? ""); ?></td>
                                <td><?php echo h($linha["email"] ?? ""); ?></td>
                                <td><?php echo h($data_br); ?></td>
                                <td class="d-flex flex-wrap gap-2">
                                    <?php
                                    $rid = pessoas_row_id($linha, $conn);
                                    if ($rid === "") :
                                        ?>
                                        <span class="text-muted small">Sem ID</span>
                                    <?php else : ?>
                                        <a href="cadastro_edit.php?id=<?php echo h(rawurlencode($rid)); ?>"
                                           class="btn btn-success btn-sm">Editar</a>
                                        <a href="excluir_script.php?id=<?php echo h(rawurlencode($rid)); ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm(<?php echo json_encode("Deseja excluir " . ($linha["nome"] ?? "") . "?"); ?>)">Excluir</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php
                        }
                        if ($count === 0) {
                            echo '<tr><td colspan="6" class="text-center text-muted">Nenhum registro encontrado.</td></tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4 pt-3 border-top text-center">
            <a href="index.php" class="btn btn-outline-secondary">Voltar para o Início</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
