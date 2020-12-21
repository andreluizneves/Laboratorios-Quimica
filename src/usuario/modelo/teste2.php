<?php

    include('../../banco/conexao.php');

    if($conexao){

        session_start(); 
    
        $requestData = $_REQUEST;
        $tipousuario = $requestData['tipoUsuario'];
        $senha = base64_encode($requestData['senha']);
        
        if($tipousuario == 'superiores'){

            if($requestData['cpf']  == '' || $requestData['senha'] == ''){

                $dados = array(
                    'mensagem' => 'Há campos vazios que precisam ser preenchidos',
                    'icone' => 'error'
                );
                echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                exit;  
                
            } else{

                $sql = "SELECT * FROM masters WHERE cpf = '$requestData[cpf]' AND senha = '$senha'";
                $resultado = mysqli_query($conexao, $sql);
                $linha = mysqli_num_rows($resultado);

                if($linha == 1){

                    $informacoes = mysqli_fetch_assoc($resultado);

                    $_SESSION['nome'] = $informacoes['nome'];
                    $_SESSION['cpf'] = $informacoes['cpf'];
                    $_SESSION['tipoUser'] = $tipousuario;
                    $_SESSION['login'] = TRUE;

                    $dados = array(
                        'mensagem' => 'Login efetuado, redirecionando...',
                        'icone' => 'success'
                    );

                    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                    exit;

                } else{
                    $dados = array(
                        'mensagem' => 'Credencias Incorretas',
                        'icone' => 'error',
                        'sql' => $sql
                    );
                }
            }
            
        } else {

            if($requestData['rm']  == '' || $requestData['senha'] == ''){

                $dados = array(
                    'mensagem' => 'Há campos vazios que precisam ser preenchidos',
                    'icone' => 'error'
                );
                echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                exit;  
                
            } else{

                $sql = "SELECT * FROM alunos WHERE rm = '$requestData[rm]' AND senha = '$senha'";
                $resultado = mysqli_query($conexao, $sql);
                $linha = mysqli_num_rows($resultado);

                if($linha == 1){

                    $dados = array(
                        'mensagem' => 'Login efetuado, redirecionando...',
                        'icone' => 'success'
                    );

                    $informacoes = mysqli_fetch_assoc($resultado);

                    $_SESSION['nome'] = $informacoes['nome'];
                    $_SESSION['rm'] = $informacoes['rm'];
                    $_SESSION['tipoUser'] = $tipousuario;
                    $_SESSION['login'] = TRUE;
                    
                    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                    exit;

                } else{
                    $dados = array(
                        'mensagem' => 'Credencias Incorretas',
                        'icone' => 'error'
                    );
                }
            }
        }
        mysqli_close($conexao);
    } else{
        $dados = array(
            'mensagem' => "Erro [042]" . "<br>" . "Ocorreeu um erro interno no servidor 😕",
            'icone' => 'error'
        );
        echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        exit;  
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);