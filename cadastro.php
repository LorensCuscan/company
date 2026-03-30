<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro</title>
  </head>
  <body>
    <div class="container mt-5"> 
        <div class="row">
        <?php 
            include "conexao.php";

            // 1. Pegando os dados do formulário
            $nome = $_POST['nome']; 
            $endereco = $_POST['endereco'];   
            $telefone = $_POST['telefone'];  
            $email = $_POST['email'];   
            
            // CORREÇÃO 1: Ajustei o nome da chave para 'dt_nascimento' (como estava no seu HTML anterior)
            $data_nascimento = $_POST['data_nascimento']; 

            // 2. Criando a SQL
            $sql = "INSERT INTO `pessoas`(`nome`, `endereco`, `telefone`, `email`, `data_nascimento`) 
                    VALUES ('$nome', '$endereco', '$telefone', '$email', '$data_nascimento')";

            // CORREÇÃO 2: Mudamos mysql_query para mysqli_query (com o 'i' de improved)
            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success' role='alert'>
                        $nome cadastrado com sucesso!
                      </div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>
                        Erro ao cadastrar: " . mysqli_error($conn) . "
                      </div>";
            }
        ?>
        <hr>
        <a href="index.php" class="btn btn-primary">Voltar</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>