<?php

    include('../../banco/conexao.php');

    if($conexao){

        $sql = "SELECT nome, quantidade, medida FROM reagentes WHERE 1=1";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_num_rows($resultado);

        if($linha == 0){

            $dados = array(
                'msg' => "Nada catalogado nos registros",
                'icone' => 'error',
                'status' => 'nenhum'
            );

        }else{

            while($linha = mysqli_fetch_assoc($resultado)){
                $dadosTipo[] = $linha;
            }

            $dados = array(
                'dados' => $dadosTipo,
                'status' => 'ok'
            );
        }

        mysqli_close($conexao);

    } else{

        $dados = array(
            'msg' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );
        echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        exit;

    }
    
    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);