<?php

    include('../../banco/conexao.php');

    if($conexao){

        session_start();

        $request = $_POST;

        $id = $request['id_reagente'];

        $quantidade = $request['quantidade'];

        $dado = "{$id}";
        
        $chave = array_search("'" . $dado . "'", $_SESSION['ids_reagente']);

        array_splice( $_SESSION['ids_reagente'], $chave, 1);
        
    } else{

        $dados = array(
            'msg' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );

    }
    
    echo json_encode($_SESSION['ids_reagente'], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);