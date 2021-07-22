<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Controller/Page.php");
    include("../../../App/Model/Relatorio.php");
    include("../../../App/Controller/RelatorioController.php");
    include("../../../App/Model/Vidraria.php");
    include("../../../App/Controller/VidrariaController.php");
    include("../../../App/Model/VidrariaQuebrada.php");
    include("../../../App/Controller/VidrariaQuebradaController.php");

    $dados = new VidrariaQuebradaController;
    echo $dados->VerVidrariaQuebrada($_POST["id"], $_POST["editavel"]);