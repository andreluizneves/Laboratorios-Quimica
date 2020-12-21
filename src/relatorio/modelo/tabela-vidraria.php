<?php

    include('../../banco/conexao.php');

    if($conexao){

        session_start();

        $request = $_POST;

        $id_relatorio = $_SESSION['id-list'];

        $sql = "SELECT r.id_relatorio, v.nome FROM relatorios r INNER JOIN relatorios_vidrarias rv ON r.id_relatorio = rv.id_relatorio INNER JOIN vidrarias v ON rv.id_vidraria = v.id_vidraria WHERE r.id_relatorio = $id_relatorio";

        $resultado = mysqli_query($conexao, $sql);
        
        $linha = mysqli_num_rows($resultado);

        if($linha == 0){

            $dados = array(
                'msg' => "Nada catalogado nos registros",
                'icone' => 'error',
                'status' => 'nenhum',
                $sql
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
            'mensagem' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);