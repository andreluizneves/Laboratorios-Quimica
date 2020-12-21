<?php

    include('../../banco/conexao.php');

    session_start();
    
    if($conexao){

        $array = $_SESSION['ids_equipamento'];
        $request = $_POST;

        $id = isset($request['id_equipamento_remove']) ? $request['id_equipamento_remove'] : '';
        
        $chave = array_search("'" . $id . "'", $_SESSION['ids_equipamento']);
        array_splice( $_SESSION['ids_equipamento'], $chave, 1);
        
    } else{

        $dados = array(
            'msg' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );

    }
    
    echo json_encode($_SESSION['ids_equipamento'], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);