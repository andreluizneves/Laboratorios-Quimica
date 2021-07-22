<?php

    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Reagente.php");
    include("../../../App/Controller/ReagenteController.php");

    $dados = new ReagenteController;
    echo $dados->VerReagente($_POST["id"], $_POST["editavel"]);