<?php

    include('../../banco/conexao.php');

    if($conexao){

        $request = $_POST;
        $id = isset($request['id_vidraria_quebrada']) ? $request['id_vidraria_quebrada'] : '';

        $sql = "SELECT * FROM vidrarias_quebradas v LEFT JOIN relatorios r ON v.id_relatorio = r.id_relatorio WHERE id_vidraria_quebrada = $request[id_vidraria_quebrada]";
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