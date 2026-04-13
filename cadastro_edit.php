<!DOCTYPE html>
<html lang="pt-br" dir="ltr"> <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Cadastro</title>
  </head>
  <body>

  <?php
    include("conexao.php");
  $id = $_GET["id"] ?? '';
  $sql = "SELECT * FROM pessoas WHERE cod_pessoa = $id";
  $dados = mysqli_query($conn,"$sql") or die(mysqli_error($conn));
  $linha = mysqli_fetch_assoc($dados);
  ?>

    <div class="container mt-5"> <div class="row">
            <div class="col-md-6 offset-md-3"> <h1 class="mb-4">Alteração de cadastro</h1>
               <form action="cadastro.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" value="" class="form-control" name="nome" placeholder="Digite seu nome" required value="<?php echo $linha["nome"]; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Endereço</label>
                        <input type="text" class="form-control" name="endereco" placeholder="Rua, número, bairro" value="<?php echo $linha['endereco']; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control" name="telefone" placeholder="(00) 00000-0000" value="<?php echo $linha["telefone"]; ?>">>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="email@exemplo.com" value="<?php echo $linha["email"]; ?>">>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" name="data_nascimento" value="<?php echo $linha["data_nascimento"]; ?>">>
                    </div>

                    <div class="mt-4 pt-3 border-top"> 
                        <button type="submit" value="Salvar Alterações" class="btn btn-outline-secondary ms-2">Finalizar Cadastro</button>                      
                        <a href="index.php" class="btn btn-outline-secondary ms-2">Voltar para o Início</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>