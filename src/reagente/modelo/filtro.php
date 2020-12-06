<?php

    include('../../banco/conexao.php');

    if($conexao){

        $request = $_POST;
        $filtro = trim($request['filtro']);
        $sql = "SELECT nome, quantidade, medida FROM reagentes WHERE nome LIKE '%".$filtro."%' ORDER BY nome";
        $resultado = mysqli_query($conexao, $sql);
        
        while($linha = mysqli_fetch_assoc($resultado)){
            $dadosTipo[] = $linha;
        }
        
        $dados = array(
            'dados' => $dadosTipo,
            'status' => 'ok'
        );

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