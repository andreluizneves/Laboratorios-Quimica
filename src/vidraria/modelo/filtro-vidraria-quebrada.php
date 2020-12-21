<?php

    include('../../banco/conexao.php');

    if($conexao){

        $filtro = $request['search']['value'];
        if(!empty($filtro)){
            $sql .= " WHERE nome LIKE '%".$filtro."%' ORDER BY nome";
        }

        mysqli_close($conexao);

    } else{
        $dados = array(
            'mensagem' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error',
            'sql' => $sql
        );
        exit;
    }
    
    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);