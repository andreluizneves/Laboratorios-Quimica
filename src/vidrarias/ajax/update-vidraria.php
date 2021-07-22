<?php

    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Vidraria.php");
    include("../../../App/Controller/VidrariaController.php");

    $dados = new VidrariaController;
    echo json_encode($dados->Editar($_POST["id_vidraria"], $_POST["laboratorio"], $_POST["nome"], $_POST["quantidade"], $_POST["descricao"], $_FILES));