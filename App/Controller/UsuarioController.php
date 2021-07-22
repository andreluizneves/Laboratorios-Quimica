<?php

    class UsuarioController{
        private $model;

        public function __construct(){
            $this->model = new Usuario;
        }

        public function Cadastrar($nome, $tipo, $login, $email, $senha){
            if(empty($nome) || empty($email) || empty($senha) || empty($login) || empty(($login))){
                return CAMPOS_VAZIOS;
            }else{
                // Verifica os campos vazio e verifica se o email é válido
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    return EMAIL_INVALIDO;
                }else{
                    if($tipo == 1){
                        $coluna = "ra";
                        $tipo = "Professor(a)";
                    }else{
                        $coluna = "rm";
                        $tipo = "Aluno(a)";
                    }
                    // Verifica o tipo de usuario e em qual coluna será usada da tabela
                    $nome = trim(substr(htmlspecialchars($nome), 0, 50));
                    $senha = trim(substr(htmlspecialchars($senha), 0, 255));
                    // Faz a limpeza dos campos removendo os espaços das pontas, tags html e recorta a string para 50 caracteres
                    return $this->model->Insert($coluna, $nome, $tipo, $login, $email, $senha);
                }
            }
        }

        public function Logar($coluna, $login, $senha){
            if(empty($login) || empty($senha) || empty($coluna)){
                return CAMPOS_VAZIOS;
            }else{
                if($coluna == 1 || $coluna == 2 && $login <= 99999){
                    $coluna = $coluna == 1 ? "ra" : "rm";
                    return $this->model->Select($coluna, $login, $senha);
                }else{
                    return ERRO_GERAL;
                }
            }
        }

        public function Sair(){
            session_destroy();
            return header("Location: /");
        }
    }