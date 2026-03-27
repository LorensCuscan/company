<!DOCTYPE html>
<html lang="pt-br" dir="ltr"> <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Cadastro</title>
  </head>
  <body>
    <div class="container mt-5"> <div class="row">
            <div class="col-md-6 offset-md-3"> <h1 class="mb-4">Cadastro</h1>
                <form action="cadastro_script.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome completo</label>
                        <input type="text" class="form-control" name="nome" id="nome">
                    </div>
                    
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" class="form-control" name="endereco" id="endereco">
                    </div>

                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" name="telefone" id="telefone">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>

                    <div class="mb-3">
                        <label for="dt_nascimento" class="form-label">Data de nascimento</label>
                        <input type="date" class="form-control" name="dt_nascimento" id="dt_nascimento">
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-success w-100" value="Cadastrar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>