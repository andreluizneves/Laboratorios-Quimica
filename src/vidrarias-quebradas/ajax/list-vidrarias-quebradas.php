<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/VidrariaQuebrada.php");
    include("../../../App/Controller/VidrariaQuebradaController.php");

    $dados = new VidrariaQuebradaController;
    echo $dados->Listar();