<?php

    include('../../banco/conexao.php');

    if($conexao){

        $requestData = $_REQUEST;
        $tipousuario = $requestData['tipo-usuario'];

      // Verificação do tipo de usuario
        if($tipousuario == 'professor(a)'){

        // Verificação de espaço em branco
            if($requestData['nome']  == '' || $requestData['email'] == '' || $requestData['ra'] == '' || $requestData['senha'] == '' ){
                
                $dados = array(
                    'mensagem' => 'Há campos vazios que precisam ser preenchidos',
                    'icone' => 'error'
                );
                echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                exit;

            } else {

            // Senão houver espaço em brancon haverá a Query desse RA no Banco já cadastrado
                $sql ="SELECT * FROM professores WHERE ra = $requestData[ra]";
                $resultado = mysqli_query($conexao, $sql);
                $linha = mysqli_num_rows($resultado);

            // Verificação do número de registros no Banco com esse RA
                if($linha == 1){

                    $dados = array(
                        'mensagem' => 'RA já cadastrado',
                        'icone' => 'error'
                    );
                    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                    exit;

                } else{

                // Senão houver sido cadastrado, cria-se a Query para cadastros do novo RA
                    $sql = "INSERT INTO professores (nome, email, ra, senha) VALUES ('$requestData[nome]', '$requestData[email]', '$requestData[ra]', '$requestData[senha]')";

                }
            }
        } else{

        // Verificação de espaço em branco
            if($requestData['nome']  == '' || $requestData['email'] == '' || $requestData['rm'] == '' || $requestData['senha'] == '' ){

                $dados = array(
                    'mensagem' => 'Há campos vazios que precisam ser preenchidos',
                    'icone' => 'error'
                );
                echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                exit;

            } else{

            // Senão houver espaço em brancon haverá a Query desse RM no Banco já cadastrado
                $sql ="SELECT * FROM alunos WHERE rm = $requestData[rm]";
                $resultado = mysqli_query($conexao, $sql);
                $linha = mysqli_num_rows($resultado);
    
                 // Verificação do número de registros no Banco com esse RM
                if($linha == 1){
                    $dados = array(
                        'mensagem' => 'RM já cadastrado',
                        'icone' => 'error'
                    );
                    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                    exit;
                
                } else{
                    
                // Senão houver sido cadastrado, cria-se a Query para cadastros do novo RM
                    $sql = "INSERT INTO alunos (nome, email, rm, senha) VALUES ('$requestData[nome]', '$requestData[email]', '$requestData[rm]', '$requestData[senha]')";

                }
            }
        }

        // Realização a Query do cadastro
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