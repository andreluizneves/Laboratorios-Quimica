<?php

    include('../../banco/conexao.php');

    if($conexao){

        session_start(); 
    
        $request = $_POST;
        $tipousuario = $request['tipo-usuario'];
        $senha = base64_encode($request['senha']);
        
        if($tipousuario == 'professor(a)'){

            if($request['ra']  == '' || $request['senha'] == ''){

                $dados = array(
                    'mensagem' => 'Há campos vazios que precisam ser preenchidos',
                    'icone' => 'error'
                );
                echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                exit;  
                
            } else{

                $sql = "SELECT * FROM professores WHERE ra = $request[ra] AND senha = '$senha'";
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
                        'mensagem' => 'Credênciais Incorretas',
                        'icone' => 'error'
                    );
                }
            }
            
        } else {

            if($request['rm']  == '' || $request['senha'] == ''){

                $dados = array(
                    'mensagem' => 'Há campos vazios que precisam ser preenchidos',
                    'icone' => 'error'
                );
                echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                exit;  
                
            } else{

                $sql = "SELECT * FROM alunos WHERE rm = $request[rm] AND senha = '$senha'";
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
        exit;  
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);