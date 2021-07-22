<?php
    session_start();
    if(!empty($_SESSION)){
        header("Location: menu");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="shortcut icon" href="assets/img/icons/icone-cadastro.png" type="image/x-icon">
    <link rel="stylesheet" href="vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/fonts/fonte.css">
</head>

<body>
    <main class="d-flex justify-content-center align-items-center" style="height:100vh">
        <div class="formulario d-flex align-items-center">
            <div class="componentes text-center">
                <h1 style="font-weight: bold;" class="text-center titulo font-weight-bold display-4 mb-4">
                    Cadastro
                </h1>
                <div class="img-user mb-3 text-center">
                    <img height="120px" src="assets/img/professores.svg" class="img">
                </div>
                <form id="form-cadastro">
                    <h4 class="text-left font-weight-bold">
                        Você é um:
                    </h4>
                    <div class="form-group">
                        <select name="tipo" class="form-control seletor">
                            <option value="1">
                                Professor(a)
                            </option>
                            <option value="2">
                                Aluno(a)
                            </option>
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <input class="form-control" maxlength="50" name="nome" type="text" id="nome" placeholder="Nome completo">
                    </div>
                    <div class="form-group mt-4">
                        <input class="form-control" name="login" type="text" placeholder="RA" id="ra">
                        <input class="form-control" name="login" type="text" placeholder="RM" id="rm" style="display: none;" disabled>
                    </div>
                    <div class="form-group mt-4">
                        <input maxlength="60" class="form-control" name="email" type="text" id="email" placeholder="Email">
                    </div>
                    <div class="form-group mt-4">
                        <input class="form-control" name="senha" type="password" id="senha" placeholder="Criar senha">
                    </div>
                    <button type="button" class="btn btn-success btn-block mt-4 font-weight-bold btn-cadastrar">
                        Cadastrar
                    </button>
                </form>
                <hr>
                <a href="/">Já tenho uma conta.</a>
            </div>
        </div>
        <div class="fundo d-flex align-items-center h-100 w-100">
        </div>
    </main>

    <script src="vendors/jQuery/jquery-3.6.0.min"></script>
    <script src="vendors/bootstrap/js/bootstrap.min"></script>
    <script src="vendors/fontawesome/all.min"></script>
    <script src="vendors/sweetalert2/sweetalert2.all.min"></script>
    <script src="vendors/jQuery Mask/jquery.mask"></script>
    <script src="assets/js/access"></script>

</body>

</html>