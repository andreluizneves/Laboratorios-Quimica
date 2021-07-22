<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Equipamento.php");
    include("../../../App/Controller/EquipamentoController.php");

    $dados = new EquipamentoController;
    echo $dados->Listar();