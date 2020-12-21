<?php

    include('../../banco/conexao.php');

    if($conexao){

        session_start();
        $array = $_SESSION['ids_vidraria'];
        $request = $_POST;

        $id = isset($request['id_vidraria_remove']) ? $request['id_vidraria_remove'] : '';
        
        $chave = array_search("'" . $id . "'", $_SESSION['ids_vidraria']);
        array_splice( $_SESSION['ids_vidraria'], $chave, 1);
        
    } else{

        $dados = array(
            'msg' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );

    }