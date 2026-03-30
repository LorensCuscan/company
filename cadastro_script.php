

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Processando Cadastro</title>
</head>
<body>
    <div class="container mt-5"> 
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php 
                    include "conexao.php";

                    // Verificamos se o formulário foi enviado via POST
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        
                        // 1. Pegando os dados do formulário
                        $nome = $_POST['nome']; 
                        $endereco = $_POST['endereco'];   
                        $telefone = $_POST['telefone'];  
                        $email = $_POST['email'];   
                        
                        // Use o name que está no seu HTML (se mudou para dt_nascimento, mude aqui)
                        $data_nascimento = $_POST['dt_nascimento']; 

                        // 2. Criando a SQL
                        $sql = "INSERT INTO `pessoas`(`nome`, `endereco`, `telefone`, `email`, `data_nascimento`) 
                                VALUES ('$nome', '$endereco', '$telefone', '$email', '$data_nascimento')";

                        // 3. Executando
                        if (mysqli_query($conn, $sql)) {
                            echo "<div class='alert alert-success' role='alert'>
                                    $nome cadastrado com sucesso!
                                  </div>";
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>
                                    Erro ao cadastrar: " . mysqli_error($conn) . "
                                  </div>";
                        }
                    } else {
                        echo "<div class='alert alert-warning'>Acesso inválido. Use o formulário.</div>";
                    }
                ?>
                <hr>
                <a href="index.php" class="btn btn-primary w-100">Voltar para o Início</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

