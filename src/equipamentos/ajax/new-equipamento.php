<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Equipamento.php");
    include("../../../App/Controller/EquipamentoController.php");

    $retorno = new EquipamentoController;
    echo json_encode($retorno->Catalogar($_POST["laboratorio"], $_POST["nome"], $_POST["patrimonio"], $_POST["descricao"], $_FILES));