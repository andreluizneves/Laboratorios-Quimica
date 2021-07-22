<?php
    include("App/Database/Conexao.php");
    include("App/Controller/Page.php");

    $conteudo = new Pagina;
    $conteudo = $conteudo->RenderPage("equipamento", 1);
    echo $conteudo;