<php

include("conexao.php");

  $id = $_GET["id"] ?? '';

  if (empty($id)) {
      header("Location: pesquisa.php");
      exit;
  }

  // Agora a query está segura contra o erro de sintaxe
  $sql = "SELECT * FROM pessoas WHERE cod_pessoa = $id";
  $dados = mysqli_query($conn, $sql or die(mysqli_error($conn));
  $linha = mysqli_fetch_assoc($dados);
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Alteração de Cadastro</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <php



            ?> </php>
            <div class="col-md-6 offset-md-3">
                <h1 class="mb-4">Alteração de cadastro</h1>
                
                <form action="edit_script.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" name="nome" required value="<?php echo $linha['nome']; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Endereço</label>
                        <input type="text" class="form-control" name="endereco" value="<?php echo $linha['endereco']; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control" name="telefone" value="<?php echo $linha['telefone']; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $linha['email']; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" name="data_nascimento" value="<?php echo $linha['data_nascimento']; ?>">
                    </div>

                    <input type="hidden" name="id" value="<?php echo $linha['cod_pessoa']; ?>">

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

?></php>