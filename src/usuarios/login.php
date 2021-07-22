<?php
    include("../../App/Database/Conexao.php");
    include("../../App/Model/Usuario.php");
    include("../../App/Controller/UsuarioController.php");

    $usuario = new UsuarioController;
    $usuario = $usuario->Logar($_POST["tipo"], $_POST["login"], $_POST["senha"]);
    echo json_encode($usuario);