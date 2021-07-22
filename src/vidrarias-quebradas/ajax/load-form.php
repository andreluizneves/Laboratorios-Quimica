<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Vidraria.php");
    include("../../../App/Controller/VidrariaController.php");
    include("../../../App/Model/Relatorio.php");
    include("../../../App/Controller/RelatorioController.php");
    include("../../../App/Controller/Page.php");

    $formulario = new Pagina;
    $formulario = $formulario->LoadFormVidrariaQuebrada();
    echo $formulario;