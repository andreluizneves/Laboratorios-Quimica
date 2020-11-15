<?php

    include('../../banco/conexao.php');

    if($conexao){

        session_start(); 
    
        $requestData = $_REQUEST;
        $tipousuario = $requestData['tipo-usuario'];
        
        if($tipousuario == 'professor(a)'){

            if($requestData['ra']  == '' || $requestData['senha'] == ''){

                $dados = array(
                    'mensagem' => 'Há campos vazios que precisam ser preenchidos',
                    'icone' => 'error'
                );
                echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                exit;  // --------- Quebra de código sem campos vazios ----------- //
                
            } else{

                $sql = "SELECT * FROM professor WHERE ra = $requestData[ra] AND senha = '$requestData[senha]'";
                $resultado = mysqli_query($conexao, $sql);
                $linha = mysqli_num_rows($resultado);

                if($linha == 1){

                    $dados = array(
                        'mensagem' => 'Login efetuado, redirecionando...',
                        'icone' => 'success'
                    );

                    $informacoes = mysqli_fetch_assoc($resultado);

                    $_SESSION['id'] = $informacoes['id_professor'];
                    $_SESSION['nome'] = $informacoes['nome'];
                    $_SESSION['ra'] = $informacoes['ra'];
                    $_SESSION['email'] = $informacoes['email'];
                    $_SESSION['tipo_user'] = $tipousuario;
                    $_SESSION['login'] = TRUE;
                    
                    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                    exit;

                } else{
                    $dados = array(
                        'mensagem' => 'Credencias Incorretas',
                        'icone' => 'error'
                    );
                    $_SESSION['login'] = FALSE;
                }
            }
            
        } else {

            if($requestData['rm']  == '' || $requestData['senha'] == ''){

                $dados = array(
                    'mensagem' => 'Há campos vazios que precisam ser preenchidos',
                    'icone' => 'error'
                );
                echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                exit;  // --------- Quebra de código sem campos vazios ----------- //
                
            } else{

                $sql = "SELECT * FROM aluno WHERE rm = $requestData[rm] AND senha = '$requestData[senha]'";
                $resultado = mysqli_query($conexao, $sql);
                $linha = mysqli_num_rows($resultado);

                if($linha == 1){

                    $dados = array(
                        'mensagem' => 'Login efetuado, redirecionando...',
                        'icone' => 'success'
                    );

                    $informacoes = mysqli_fetch_assoc($resultado);

                    $_SESSION['nome'] = $informacoes['nome'];
                    $_SESSION['ra'] = $informacoes['rm'];
                    $_SESSION['email'] = $informacoes['email'];
                    $_SESSION['tipo_user'] = $tipousuario;
                    $_SESSION['login'] = TRUE;
                    
                    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                    exit;

                } else{
                    $dados = array(
                        'mensagem' => 'Credencias Incorretas',
                        'icone' => 'error'
                    );
                    $_SESSION['login'] = FALSE;
                }
            }
        }
        mysqli_close($conexao);
    } else{
        $dados = array(
            'mensagem' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );
        echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        exit;  // --------- Quebra de código sem campos vazios ----------- //
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);