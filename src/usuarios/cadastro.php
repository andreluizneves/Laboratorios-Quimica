<?php
    include("../../App/Database/Conexao.php");
    include("../../App/Model/Usuario.php");
    include("../../App/Controller/UsuarioController.php");

    $usuario = new UsuarioController;
    $usuario = $usuario->Cadastrar($_POST["nome"], $_POST["tipo"], $_POST["login"], $_POST["email"], $_POST["senha"]);
    echo json_encode($usuario);