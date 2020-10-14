<?php

    include('../../banco/conexao.php');

    if($conexao){

        $requestData = $_REQUEST;
        $tipousuario = $requestData['tipo-usuario'];
        
        if($tipousuario == 'professor(a)'){
            $sql = "INSERT INTO professor (nome, email, ra, senha) VALUES ('$requestData[nome]', '$requestData[email]', '$requestData[ra]', '$requestData[senha]')";
            if($requestData['nome']  == '' || $requestData['email'] == '' || $requestData['ra'] == '' || $requestData['senha'] == '' ){
                $dados = array(
                    'mensagem' => 'Há campos em vazios que precisam ser preenchidos',
                    'icone' => 'error'
                );
                echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                exit;
            }
        } else{
            $sql = "INSERT INTO aluno (nome, email, rm, senha) VALUES ('$requestData[nome]', '$requestData[email]', '$requestData[rm]', '$requestData[senha]')";
            if($requestData['nome']  == '' || $requestData['email'] == '' || $requestData['rm'] == '' || $requestData['senha'] == '' ){
                $dados = array(
                    'mensagem' => 'Há campos em vazios que precisam ser preenchidos',
                    'icone' => 'error'
                );
                echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                exit;
            }
        }


        $resultado = mysqli_query($conexao, $sql);

        if($resultado){
            $dados = array(
                'mensagem' => "Cadastrado com êxito.",
                'icone' => 'success'
            );
        } else {
            $dados = array(
                'mensagem' => "Não foi possível realizar o cadastro.",
                'icone' => 'error'
            );
        }       
        
        mysqli_close($conexao);
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
