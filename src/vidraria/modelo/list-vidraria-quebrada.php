<?php

    include('../../banco/conexao.php');

    if($conexao){

        $sql = "SELECT id_vidraria_quebrada, nome, quantidade, titulo, data_hora FROM vidrarias_quebradas v LEFT JOIN relatorios r ON v.id_relatorio = r.id_relatorio";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_num_rows($resultado);

        if($linha == 0){

            $dados = array(
                'msg' => "Nenhuma vidraria quebrada encontrada",
                'status' => 'nenhum',
                'sql' => $sql
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
            'icone' => 'error',
            'causa' => $conexao
        );
    }
    
    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);