<?php

    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Relatorio.php");
    include("../../../App/Controller/Page/Pagina.php");
    include("../../../App/Controller/RelatorioController.php");

    $dados = new RelatorioController;
    echo $dados->VerRelatorio($_POST["id"], $_POST["editavel"]);