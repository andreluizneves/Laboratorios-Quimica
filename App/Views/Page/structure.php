<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/icons/<?= $data["icon"] ?>.png" type="image/x-icon">
    <title>
        <?= $data["title"] ?>
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/font.css">
    <style>
        body {
            visibility: hidden;
        }
    </style>
</head>

<body entity="<?= $data["entity"] ?>">
    <main>
        <?php require __DIR__ . "/Components/navbar.php"; ?>
        <div class="jumbotron d-flex align-items-center justify-content-center rounded-0">
            <div class="row">
                <div class="col-12 col-md-12 col-sm-12 col-lg-12">
                    <h1 class="display-1 text-center font-weight-bold">
                        <?= $data["jumbotron"] ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center">
            <div class="row controls">
                <div class="<?= App\Utils\Session::IsAdmin() ? "col-12 col-sm-12 col-md-8 col-lg-8" : "col-12 col-sm-12 col-md-12 col-lg-12" ?>">
                    <input class="form-control" maxlength="60" name="search" type="text" placeholder="Pesquisar por <?= $data["search"] ?>" disabled>
                </div>
                <div <?= App\Utils\Session::IsAdmin() ? "class='col-12 col-sm-12 col-md-4 col-lg-4' style='display: none'" : "style='display: none'" ?>>
                    <button class="btn btn-primary btn-block btn-list" disabled>
                        <i class="fas fa-eye"></i> 
                        VISUALIZAR
                    </button>
                </div>
                <div <?= App\Utils\Session::IsAdmin() ? "class='col-12 col-sm-12 col-md-4 col-lg-4'" : "style='display: none'" ?>>
                    <button class="btn btn-success btn-block btn-form" disabled>
                        <i class="fas fa-plus"></i> 
                        CATALOGAR
                    </button>
                </div>
            </div>
            <div class="row content">
                <div class="col-12 col-col-12 col-sm-12 col-lg-12">
                    <h2 class="text-center">
                        Carregando <?= $data["label"] ?>...
                    </h2>
                </div>
            </div>
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lgg" role="document">
                    <div class="modal-content"></div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/jqueryMaskRegex.min.js"></script>
    <script src="assets/js/navbar.js"></script>
    <script src="assets/js/functions.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>