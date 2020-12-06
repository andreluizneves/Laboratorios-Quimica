<?php

    include('../../banco/conexao.php');

    if($conexao){

        $request = $_POST;

        if($request['nome'] == "" || $request['num_patrimonio'] == "" ||  $request['descricao'] == "" || $request['laboratorio'] == "" ){
            
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

            $sql = "INSERT INTO equipamentos (nome, numero_patrimonio, descricao , id_lab) VALUES ('$request[nome]', '$request[num_patrimonio]', '$request[descricao]', '$lab')";

            $resultado = mysqli_query($conexao, $sql);

            if($resultado){
                $dados = array(
                    'icone' => 'success',
                    'msg' => 'Equipamento catalogado com êxito'
                );
            }else{
                $dados = array(
                    'icone' => 'error',
                    'msg' => 'Erro ao catalogar o equipamento',
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