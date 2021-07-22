<?php

    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Reagente.php");
    include("../../../App/Controller/ReagenteController.php");

    $dados = new ReagenteController;
    echo json_encode($dados->Editar($_POST["id_reagente"], $_POST["laboratorio"], $_POST["nome"], $_POST["medida"], $_POST["quantidade"], $_FILES));