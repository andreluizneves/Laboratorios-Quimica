<?php

    session_start();

    include('../../banco/conexao.php');

    if($conexao){

        $_SESSION['equipamento'] = $_SESSION['ids_equipamento'];

        $dados = array(
            'resultado' => $_SESSION['equipamento']
        );
    } else{

        $dados = array(
            'msg' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );

    }
    
    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);