<?php

    include "conexao.php";

    $pesquisa = $_POST['busca'] ?? "";

    $sql = "SELECT * FROM pessoas WHERE nome LIKE '%$pesquisa%'";  
    $dados = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pesquisar</title>
</head>
<body>
    <div class="container mt-5"> 
        <nav class="navbar bg-body-tertiary p-3 rounded">
            <div class="container-fluid">
                <form class="d-flex w-100" action="pesquisa.php" method="POST" role="search">
                    <input class="form-control me-2" type="search" name="busca" placeholder="Pesquisar" value="<?php echo $pesquisa; ?>"/>        
                    <button class="btn btn-outline-success" type="submit">Busca</button>
                </form>
            </div>
        </nav>

        <div class="mt-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Data de Nascimento</th>
                        <th scope="col">Funções</th>
                    </tr>         
                </thead>
                <tbody>
                    <?php
                        if ($dados) {
                            while ($linha = mysqli_fetch_assoc($dados)) {
                                echo "<tr>
                                        <td>{$linha['nome']}</td>
                                        <td>{$linha['endereco']}</td>
                                        <td>{$linha['telefone']}</td>
                                        <td>{$linha['email']}</td>
                                        <td>{$linha['data_nascimento']}</td>
                                        <td>
                                            <a href='' class='btn btn-warning btn-sm me-2'>Editar</a>
                                            <a href='' class='btn btn-danger btn-sm'>Excluir</a>
                                        </td>
                                      </tr>";
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