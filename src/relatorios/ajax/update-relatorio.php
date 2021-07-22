<?php

    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Relatorio.php");
    include("../../../App/Controller/RelatorioController.php");

    $dados = new RelatorioController;
    echo json_encode($dados->Editar($_POST["titulo"], $_POST["aulas"], $_POST["laboratorio"], $_POST["data"], $_POST["hora"], $_POST["descricao"], $_POST["id_relatorio"]));