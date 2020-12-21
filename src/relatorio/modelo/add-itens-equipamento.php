<?php

    include('../../banco/conexao.php');

    if($conexao){

        session_start();

        $request = $_POST;
        $id = isset($request['id_equipamento']) ? $request['id_equipamento'] : '';
                
        array_push($_SESSION['ids_equipamento'], $id);

    } else{

        $dados = array(
            'msg' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );

    }
    
    echo json_encode($_SESSION['ids_equipamento'], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);