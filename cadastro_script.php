<!DOCTYPE html>
<html lang="pt-br" dir="ltr"> <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Cadastro</title>
  </head>
  <body>
    <div class="container mt-5"> <div class="row">
        <?php 
            include "conexao.php";

                

            $nome = $_POST['nome']; 
            $endereco = $_POST['endereco'];   
            $telefone = $_POST['telefone'];  
            $email = $_POST['email'];   
            $data_nascimento = $_POST['data_nascimento']; 

            $sql = "INSERT INTO `pessoas`(`nome`, `endereco`, `telefone`, `email`, `data_nascimento`) VALUES ('$nome','$endereco','$telefone','$email','$data_nascimento')";
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>