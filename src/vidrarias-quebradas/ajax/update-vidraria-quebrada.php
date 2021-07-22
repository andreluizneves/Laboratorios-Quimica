<?php

    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/VidrariaQuebrada.php");
    include("../../../App/Controller/VidrariaQuebradaController.php");

    $dados = new VidrariaQuebradaController;
    echo json_encode($dados->Editar($_POST["id_vidraria_quebrada"], $_POST["id_vidraria"], $_POST["aula-quebrada"], $_POST["quantidade-quebrada"]));