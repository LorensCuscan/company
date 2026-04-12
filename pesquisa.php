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
        // 1. Recebimento do termo de busca
        $pesquisa = $_POST['busca'] ?? "";
      
        include "conexao.php";
      
        $sql = "SELECT * FROM pessoas WHERE nome LIKE '%$pesquisa%'";  
        $dados = mysqli_query($conn, $sql);
    ?>

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
                    </tr>         
                </thead>
                <tbody>
            <?php
                while ($linha = mysqli_fetch_assoc($dados)) {
                  
                    $data_br = mostra_data($linha['data_nascimento']);
                    
                  
                    $nome_url = urlencode($linha['nome']);

                    echo "<tr>
                            <td>{$linha['nome']}</td>
                            <td>{$linha['endereco']}</td>
                            <td>{$linha['telefone']}</td>
                            <td>{$linha['email']}</td>
                            <td>$data_br</td>
                            <td class='d-flex gap-2'>
                                <a href='cadastro_edit.php?nome=$nome_url' class='btn btn-success btn-sm'>Editar</a>
                                
                                <a href='excluir_script.php?nome=$nome_url' class='btn btn-danger btn-sm' onclick=\"return confirm('Deseja excluir {$linha['nome']}?')\">Excluir</a>
                            </td>
                        </tr>";
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