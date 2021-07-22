<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Vidraria.php");
    include("../../../App/Controller/VidrariaController.php");

    $dados = new VidrariaController;
    echo json_encode($dados->Deletar($_POST["id_vidraria"]));