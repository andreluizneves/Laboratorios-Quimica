<?php

    include('../../banco/conexao.php');

    if($conexao){

        session_start();

        $request = $_POST;
        
        $id = isset($request['id_vidraria']) ? $request['id_vidraria'] : '';
                
        array_push($_SESSION['ids_vidraria'], $id);

    } else{

        $dados = array(
            'msg' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );

    }
    
    echo json_encode($_SESSION['ids_vidraria'], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);