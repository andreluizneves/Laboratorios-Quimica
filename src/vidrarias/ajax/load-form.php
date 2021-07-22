<?php
    include("../../../App/Controller/Page.php");

    $formulario = new Pagina;
    $formulario = $formulario->LoadForm("vidraria");
    echo $formulario;