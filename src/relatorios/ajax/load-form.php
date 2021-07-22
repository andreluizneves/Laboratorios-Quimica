<?php
    include("../../../App/Database/Conexao.php");
    include("../../../App/Controller/Page.php");
    include("../../../App/Model/Relatorio.php");
    include("../../../App/Controller/RelatorioController.php");
    include("../../../App/Model/Equipamento.php");
    include("../../../App/Controller/EquipamentoController.php");
    include("../../../App/Model/Reagente.php");
    include("../../../App/Controller/ReagenteController.php");
    include("../../../App/Model/Vidraria.php");
    include("../../../App/Controller/VidrariaController.php");

    $dados = new Pagina;
    echo $dados->LoadFormRelatorio($_SESSION["nome"]);