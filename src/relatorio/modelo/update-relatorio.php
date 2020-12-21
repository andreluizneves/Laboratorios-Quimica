<?php

    include('../../banco/conexao.php');

    if($conexao){

        $request = $_POST;
        $data = $request['data'];
        $hora = $request['hora'];
        $datahora = $data . ' ' . $hora;
        $id = $request['laboratorio'];

        $sql = "UPDATE relatorios SET titulo = '{$request['titulo']}', descricao = '{$request['descricao']}', data_hora = '$datahora', tempo = '{$request['tempo']}', id_lab = $id WHERE id_relatorio = {$request['id_relatorio']}";

        $resultado = mysqli_query($conexao, $sql);

        if($resultado){
            $dados = array(
                'icone' => 'success',
                'msg' => 'Relatório Atualizado com êxito'
            );
        } else{
            $dados = array(
                'icone' => 'error',
                'msg' => 'Não foi possível Atualizar o relatório',
                $sql,
                $data_hora,
                $datahora
            );
        }

    } else{
        $dados = array(
            'mensagem' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);