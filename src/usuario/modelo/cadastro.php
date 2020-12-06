<?php

    include('../../banco/conexao.php');

    if($conexao){

        $request = $_POST;
        $tipousuario = $request['tipo-usuario'];

      // Verificação do tipo de usuario
        if($tipousuario == 'professor(a)'){

        // Verificação de espaço em branco
            if($request['nome']  == '' || $request['email'] == '' || $request['ra'] == '' || $request['senha'] == '' ){
                
                $dados = array(
                    'mensagem' => 'Há campos vazios que precisam ser preenchidos',
                    'icone' => 'error'
                );
                echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                exit;

            } else {

            // Senão houver espaço em brancon haverá a Query desse RA no Banco já cadastrado
                $sql ="SELECT * FROM professores WHERE ra = $request[ra]";
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
                $senha = base64_encode($request[senha]);
                // Senão houver sido cadastrado, cria-se a Query para cadastros do novo RA
                    $sql = "INSERT INTO professores (nome, email, ra, senha) VALUES ('$request[nome]', '$request[email]', '$request[ra]', '$senha')";

                }
            }
        } else{

        // Verificação de espaço em branco
            if($request['nome']  == '' || $request['email'] == '' || $request['rm'] == '' || $request['senha'] == '' ){

                $dados = array(
                    'mensagem' => 'Há campos vazios que precisam ser preenchidos',
                    'icone' => 'error'
                );
                echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                exit;

            } else{

            // Senão houver espaço em brancon haverá a Query desse RM no Banco já cadastrado
                $sql ="SELECT * FROM alunos WHERE rm = $request[rm]";
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
                    
                $senha = base64_encode($request[senha]);
                // Senão houver sido cadastrado, cria-se a Query para cadastros do novo RM
                    $sql = "INSERT INTO alunos (nome, email, rm, senha) VALUES ('$request[nome]', '$request[email]', '$request[rm]', '$senha')";

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