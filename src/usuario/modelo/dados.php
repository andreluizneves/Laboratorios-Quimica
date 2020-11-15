<?php

    include('../../banco/conexao.php');

    session_start();

    $dados = array(
        'nome' => $_SESSION['nome'],
        'email' => $_SESSION['email'],
        'ra' => $_SESSION['ra']
    );
    
    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);