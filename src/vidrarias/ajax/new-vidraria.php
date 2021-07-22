<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Vidraria.php");
    include("../../../App/Controller/VidrariaController.php");

    $dados = new VidrariaController;
    echo json_encode($dados->Catalogar($_POST["laboratorio"], $_POST["nome"], $_POST["quantidade"], $_POST["descricao"], $_FILES));