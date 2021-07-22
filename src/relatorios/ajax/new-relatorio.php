<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Relatorio.php");
    include("../../../App/Controller/RelatorioController.php");

    $retorno = new RelatorioController;
    echo json_encode($retorno->Catalogar($_POST["laboratorio"], $_POST["titulo"], $_POST["data"], $_POST["hora"], $_POST["aulas"], $_POST["descricao"], $_POST["equipamentos"], $_POST["reagentes"], $_POST["vidrarias"]));