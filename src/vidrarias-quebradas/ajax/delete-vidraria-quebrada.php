<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/VidrariaQuebrada.php");
    include("../../../App/Controller/VidrariaQuebradaController.php");

    $dados = new VidrariaQuebradaController;
    echo json_encode($dados->Deletar($_POST["id_vidraria_quebrada"]));