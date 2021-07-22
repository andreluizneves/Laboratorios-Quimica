<?php

    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Equipamento.php");
    include("../../../App/Controller/EquipamentoController.php");

    $dados = new EquipamentoController;
    echo json_encode($dados->Editar($_POST["id_equipamento"], $_POST["laboratorio"], $_POST["nome"], $_POST["patrimonio"], $_POST["descricao"], $_FILES));