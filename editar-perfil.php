<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="recursos/css/bootstrap.min.css">
    <link rel="stylesheet" href="recursos/css/editar-perfil.css">
    <link rel="stylesheet" href="recursos/libs/css/all.css">
</head>

<body>
    <div class="jumbotron jumbotron-fluid bg-primary">
        <h1 class="display-4 text-center text-light font-weight-bold">Editar Perfil</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12">
                <form id="form-edit">
                    <h3>
                        Nome
                    </h3>
                    <input class="form-control nome" type="text" name="nome" disabled>
                    <h3>
                        Email
                    </h3>
                    <input class="form-control email" type="text" name="email" disabled>
                    <h3>
                        RA
                    </h3>
                    <input class="form-control ra" type="text" name="ra" disabled>
                    <input type="submit" class="mt-3 btn btn-outline-success btn-editar-perfil">
                </form>
                <input value="Permitir Edição" type="submit" class="mt-3 btn btn-outline-primary btn-permitir-edicao">
            </div>
        </div>
    </div>

    <script src="recursos/js/jquery-3.5.1.min.js"></script>
    <script src="recursos/js/bootstrap.min.js"></script>
    <script src="../controle/editar-perfil.js"></script>
    <script src="recursos/libs/js/fontawesome.js"></script>
</body>

</html>