<?php

    include('../../banco/conexao.php');

    if($conexao){

        session_start();

        $request = $_POST;

        $id = isset($request['id_relatorio']) ? $request['id_relatorio'] : '';

        $sql = "SELECT * FROM relatorios WHERE id_relatorio = $id";
        $resultado = mysqli_query($conexao, $sql);
           
        $_SESSION['id-list'] = $id;

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