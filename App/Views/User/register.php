<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Cadastro
    </title>
    <link rel="shortcut icon" href="assets/img/icons/register.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="assets/css/access.css">
    <link rel="stylesheet" href="assets/css/font.css">
</head>

<body>
    <main class="container">
        <div class="row">
            <div class="col-11 col-sm-11 col-md-6 col-lg-6 text-light">
                <h1 class="text-center title font-weight-bold display-4 mb-4">
                    Cadastro
                </h1>
                <div class="mb-3 text-center">
                    <img height="120px" src="assets/img/teachers.svg">
                </div>
                <form>
                <h4 class="text-left font-weight-bold">
                        Você é um:
                    </h4>
                    <div class="form-group">
                        <select name="type" class="form-control seletor">
                            <option value="2">
                                Professor(a)
                            </option>
                            <option value="1">
                                Aluno(a)
                            </option>
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <input class="form-control" maxlength="60" name="name" type="text" placeholder="Nome completo">
                    </div>
                    <div class="form-group mt-4">
                        <input class="form-control" id="ra" name="login" type="text" placeholder="RA" >
                        <input class="form-control" id="rm" name="login" type="text" placeholder="RM" style="display: none;" disabled>
                    </div>
                    <div class="form-group mt-4">
                        <input class="form-control" maxlength="60" name="email" type="text" placeholder="Email">
                    </div>
                    <div class="form-group mt-4">
                        <input class="form-control" name="password" type="password" placeholder="Criar senha">
                    </div>
                    <button type="button" class="btn btn-success btn-block mt-4 font-weight-bold btn-register">
                        Cadastrar
                    </button>
                </form>
                <hr>
                <div class="text-center">
                    <a href="/">
                        Já tenho uma conta!
                    </a>
                </div>
                <div class="text-center mt-2">
                    <h4>
                        &copy; <?= date("Y") ?>
                    </h4>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/functions.js"></script>
    <script src="assets/js/access.js"></script>

</body>

</html>