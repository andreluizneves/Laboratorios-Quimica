<?php

    include('../../banco/conexao.php');

    session_start();

    if($_SESSION['login'] != Null){
        $dados= array(
            'logado' => 'sim'
        );
    } else{
        $dados= array(
            'logado' => 'não'
        );   
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);