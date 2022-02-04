<?php

    declare(strict_types=1);

    // IMPORTA O AUTOLOAD E AS CONSTANTES PARA CONFIGURAÇÕES DO SISTEMA
    require __DIR__ . "/../../vendor/autoload.php";
    require __DIR__ . "/Configs.php";

    use App\Utils\Session;
    use App\Utils\Response;

    // CONFIGURA EXIBIÇÃO DE ERROS, CONFIGURAÇÕES DO SERVIDOR, TIME ZONE, INICIA SESSÃO E CARREGA AS RESPOSTAS
    ini_set("display_errors", (string) DISPLAY_ERRORS);
    setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "pt_BR.utf-8", "portuguese");
    date_default_timezone_set("America/Sao_Paulo");
    Session::StartSession();
    Response::LoadResponses();