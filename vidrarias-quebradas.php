<?php
    include("App/Database/Conexao.php");
    include("App/Controller/Page.php");

    $conteudo = new Pagina;
    echo $conteudo->RenderPage("vidraria-quebrada", 5);