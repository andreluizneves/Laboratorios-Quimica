<?php
    include("../../../App/Controller/Page.php");

    $formulario = new Pagina;
    echo $formulario->LoadForm($_POST["entidade"]);