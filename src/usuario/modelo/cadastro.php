<?php

    include('../../banco/conexao.php');

    if($conexao){

        $requestData = $_REQUEST;
        $tipousuario = $requestData['tipo-usuario'];
        
        if($tipousuario == 'professor(a)'){

            $sql = "INSERT INTO professor (nome, email, ra, senha) VALUES ('$requestData[nome]', '$requestData[email]', '$requestData[ra]', '$requestData[senha]')";

        } else{

            $sql = "INSERT INTO aluno (nome, email, rm, senha) VALUES ('$requestData[nome]', '$requestData[email]', '$requestData[rm]', '$requestData[senha]')";

        }

        $resultado = mysqli_query($conexao, $sql);

        if($resultado){
            $dados = array(
                'mensagem' => "Cadastrado com êxito.",
            );
        } else {
            $dados = array(
                'mensagem' => "Não foi possível realizar o cadastro."
            );
        }       
        
        mysqli_close($conexao);

    } else {
        $dados = array(
            'mensagem' => 'Falha na conexão'
        );
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
