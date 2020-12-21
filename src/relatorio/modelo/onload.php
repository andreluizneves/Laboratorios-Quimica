<?php

    include('../../banco/conexao.php');
    
    session_start();

    if(!isset($_SESSION['login'])){
        $dados = array(
            'logado' => 'não',
        );
    }else{
        if($_SESSION['tipo_user'] == 'professor(a)'){
            $dados = array(
                'logado' => 'sim',
                'nome' => $_SESSION['nome'],
                'ra' => $_SESSION['ra'],
                'tipo_user' => 'professor(a)'
            );
            $_SESSION['ids_equipamento'] = array();
            $_SESSION['ids_reagente'] = array();
            $_SESSION['ids_vidraria'] = array();
        } else{
            $dados = array(
                'logado' => 'sim',
                'nome' => $_SESSION['nome'],
                'rm' => $_SESSION['rm'],
                'tipo_user' => 'aluno(a)'
            );
        }
    }
    
    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);