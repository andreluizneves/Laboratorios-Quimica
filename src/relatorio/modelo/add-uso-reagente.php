<?php

    include('../../banco/conexao.php');

    if($conexao){

        session_start();

        $request = $_POST;

        $id = $request['id_reagente'];

        $quantidade = $request['quantidade'];

        if($quantidade == "" || $id == ''){
            exit;
        } else{

            $dado = "{$id}:{$quantidade}";
        
            array_push($_SESSION['ids_reagente'], $dado);

        }
    } else{

        $dados = array(
            'msg' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );

    }
    
    echo json_encode($_SESSION['ids_reagente'], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);