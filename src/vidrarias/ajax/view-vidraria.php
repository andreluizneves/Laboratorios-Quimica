<?php

    include("../../../App/Database/Conexao.php");
    include("../../../App/Model/Vidraria.php");
    include("../../../App/Controller/VidrariaController.php");

    $dados = new VidrariaController;
    echo $dados->VerVidraria($_POST["id"], $_POST["editavel"]);