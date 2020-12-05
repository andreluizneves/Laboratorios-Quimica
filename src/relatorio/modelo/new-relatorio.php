<?php

    include('../../banco/conexao.php');

    if($conexao){

        $request = $_POST;

        if($request['data_hora'] == "" || $request['descricao'] == "" ){
            
            $dados = array(
                'msg' => 'Há campos vazios que precisam ser preenchidos',
                'icone' => 'error',
                'sql' => $sql
            );
            echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            exit;
        }else{

            $sql = "INSERT INTO relatorios (data_hora, descricao , id_professor) VALUES ('$request[data_hora]', '$request[descricao]', '1')";

            $resultado = mysqli_query($conexao, $sql);

            if($resultado){
                $dados = array(
                    'icone' => 'success',
                    'msg' => 'Relatado com êxito',
                    'sql' => $sql
                );
            }else{
                $dados = array(
                    'icone' => 'error',
                    'msg' => 'Erro ao criar relatório',
                    'sql' => $sql
                );
            }

            mysqli_close($conexao);
        }
    }else{
        $dados = array(
            'mensagem' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );
        exit;
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);