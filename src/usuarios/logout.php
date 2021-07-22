<?php
    include("../../App/Database/Conexao.php");
    include("../../App/Model/Usuario.php");
    include("../../App/Controller/UsuarioController.php");

    $usuario = new UsuarioController;
    $usuario->Sair();