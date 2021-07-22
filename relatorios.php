<?php
    include("App/Database/Conexao.php");
    include("App/Controller/Page.php");

    $conteudo = new Pagina;
    $conteudo = $conteudo->RenderPage("relatório", 3);
    echo $conteudo;