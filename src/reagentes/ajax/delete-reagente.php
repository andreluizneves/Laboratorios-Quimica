<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Reagente.php");
    include("../../../App/Controller/ReagenteController.php");

    $dados = new ReagenteController;
    echo json_encode($dados->Deletar($_POST["id_reagente"]));