<?php

    include('../../banco/conexao.php');

    if($conexao){

        $request = $_POST;
        $id = isset($request['id_reagente']) ? $request['id_reagente'] : '';

        $sql = "SELECT * FROM reagentes WHERE id_reagente = $id";
        $resultado = mysqli_query($conexao, $sql);
           
        $dados = mysqli_fetch_assoc($resultado);
        
        $dados = array(
            'dados' => $dados,
            'sql' => $sql
        );

        mysqli_close($conexao);
        
    }else{
        $dados = array(
            'mensagem' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);