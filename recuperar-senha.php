<?php

    session_start();

    if(isset($_SESSION['login'])){
        header('Location: menu.php');
    }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar sua senha</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="shortcut icon" href="recursos/img/cadeado.svg" type="image/x-icon">
    <link rel="stylesheet" href="recursos/css/bootstrap.min.css">
    <link rel="stylesheet" href="recursos/css/recuperar-senha.css">
    <link rel="stylesheet" href="recursos/libs/css/all.css">
</head>

<body class="grad">
    <div class="container">
        <div class="row">
            <div class="caixa">
                <h1 class="text-center mb-4">Recuperar Senha</h1>
                <div class="form-group">
                    <label for="my-select">Insira seu email que você utilizou para cadastrar sua conta</label>
                    <div class="campo mt-2" id="email">
                        <input type='text' placeholder="Email" max="5">
                    </div>
                </div>
                <button class="btn btn-primary btn-recuperar-senha btn-block mt-3 font-weight-bold">
                    Encontrar
                </button>
                <button class=" btn btn-success btn-block mt-3 font-weight-bold btn-voltar">
                    Voltar
                </button>
            </div>
            </form>
        </div>
    </div>

    <script src="recursos/js/jquery-3.5.1.min.js"></script>
    <script src="recursos/js/bootstrap.min.js"></script>
    <script src="src/usuario/controle/recuperar-senha.js"></script>
    <script src="recursos/libs/js/fontawesome.js"></script>
</body>

</html>