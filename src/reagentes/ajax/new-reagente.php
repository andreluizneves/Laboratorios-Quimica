<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Reagente.php");
    include("../../../App/Controller/ReagenteController.php");

    $retorno = new ReagenteController;
    echo json_encode($retorno->Catalogar($_POST["laboratorio"], $_POST["nome"], $_POST["medida"], $_POST["quantidade"], $_FILES));