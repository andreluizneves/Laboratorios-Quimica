<?php

    include('../../banco/conexao.php');

    if($conexao){

        $request = $_POST;

        if($request['nome'] == "" || $request['quantidade'] == ""){
            
            $dados = array(
                'msg' => 'Há campos vazios que precisam ser preenchidos',
                'icone' => 'error'
            );

        }else{

            if($request['relatorio'] == ""){
                $sql = "INSERT INTO vidrarias_quebradas (nome, quantidade) VALUES ('$request[nome]', '$request[quantidade]')";
            } else{
                $sql = "INSERT INTO vidrarias_quebradas (nome, quantidade, id_relatorio) VALUES ('$request[nome]', '$request[quantidade]', $request[relatorio])";
            }

            $resultado = mysqli_query($conexao, $sql);

            if($resultado){
                $dados = array(
                    'icone' => 'success',
                    'msg' => 'Vidraria quebrada catalogado com êxito'
                );
            }else{
                $dados = array(
                    'icone' => 'error',
                    'msg' => 'Erro ao catalogar o vidraria quebrada',
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