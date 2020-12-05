<?php

    include('../../banco/conexao.php');

    if($conexao){

        $request = $_POST;

        if($request['nome'] == "" || $request['quantidade'] == "" || $request['laboratorio'] == "" ){
            
            $dados = array(
                'msg' => 'Há campos vazios que precisam ser preenchidos',
                'icone' => 'error'
            );
            echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            exit;
        }else{

            if($request['laboratorio'] == 'externo'){
                $lab = 1;
            } else if ($request['laboratorio'] == 'interno'){
                $lab = 2;
            } else{
                $lab = 3;
            }

            $sql = "INSERT INTO reagentes (nome, quantidade , id_lab) VALUES ('$request[nome]', '$request[quantidade]', '$lab')";

            $resultado = mysqli_query($conexao, $sql);

            if($resultado){
                $dados = array(
                    'icone' => 'success',
                    'msg' => 'Reagente catalogado com êxito',
                    'sql' => $sql
                );
            }else{
                $dados = array(
                    'icone' => 'error',
                    'msg' => 'Erro ao catalogar o reagente'
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