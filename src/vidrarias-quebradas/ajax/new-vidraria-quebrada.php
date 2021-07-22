<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/VidrariaQuebrada.php");
    include("../../../App/Controller/VidrariaQuebradaController.php");

    $retorno = new VidrariaQuebradaController;
    echo json_encode($retorno->Catalogar($_POST["vidraria"], $_POST["relatorio"], $_POST["quantidade"]));