<?php

    include('../../banco/conexao.php');

    session_start();
    $request = $_POST;
    $sql = "UPDATE professor
    SET nome = '$request[nome]' WHERE id_professor = '$_SESSION[id]'";

    $resultado = mysqli_query($conexao, $sql);
    echo($sql);