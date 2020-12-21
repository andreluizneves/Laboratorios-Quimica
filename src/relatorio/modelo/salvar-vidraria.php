<?php

    session_start();

    include('../../banco/conexao.php');

    if($conexao){

        $_SESSION['vidraria'] = $_SESSION['ids_vidraria'];

        $dados = array(
            'resultado' => $_SESSION['vidraria']
        );
    } else{

        $dados = array(
            'msg' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );

    }
    
    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);