<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Relatorio.php");
    include("../../../App/Controller/RelatorioController.php");

    $dados = new RelatorioController;
    echo json_encode($dados->Deletar($_POST["id_relatorio"]));