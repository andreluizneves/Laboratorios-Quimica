<?php

    class Usuario extends Conexao{

        public function Insert($coluna, $nome, $tipo, $login, $email, $senha){
            $stmt = $this->PDO->prepare("SELECT $coluna FROM usuarios WHERE $coluna = :login");
            $stmt->bindParam(":login", $login);
            $stmt->execute();

            // Faz a verificação se o usuário já existe com o tipo informado (RA ou RM)

            if($stmt->rowCount() > 0 && $tipo == "Professor(a)"){
                return RA_CADASTRADO;
            }else if($stmt->rowCount() > 0 && $tipo == "Aluno(a)"){
                return RM_CADASTRADO;
            }else{
                $stmt = $this->PDO->prepare("SELECT email FROM usuarios WHERE email = :email");
                $stmt->bindParam(":email", $email);
                $stmt->execute();
                // Faz a verificação se o usuário já existe com o email informado
                if($stmt->rowCount() > 0){
                    return EMAIL_CADASTRADO;
                }else{
                    // Prossegue com a execução de cadastro
                    $stmt = $this->PDO->prepare("INSERT INTO usuarios (nome, tipo, $coluna, email, senha) VALUES (:nome, :tipo, :login, :email, :senha)");
                    $stmt->bindParam(":nome", $nome);
                    $stmt->bindParam(":tipo", $tipo);
                    $stmt->bindParam(":login", $login);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":senha", password_hash($senha, PASSWORD_DEFAULT));

                    if($stmt->execute()){
                        // Cria a sessão do usuário no sistema
                        $stmt = $this->PDO->prepare("SELECT * FROM usuarios WHERE email = :email");
                        $stmt->bindParam(":email", $email);
                        $stmt->execute();
                        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
                        $_SESSION["id_usuario"] = $dados["id_usuario"];
                        $_SESSION["nome"] = $dados["nome"];
                        $_SESSION["tipo"] = $dados["tipo"];
                        $_SESSION["coluna"] = strtoupper($coluna);
                        $_SESSION["foto"] = $coluna == "ra" ? "assets/img/professores.svg" : "assets/img/alunos.svg";
                        $_SESSION["login"] = $dados[$coluna];
                        $_SESSION["email"] = $dados["email"];
                        return CADASTRADO;
                    }else{
                        return ERRO_GERAL;
                    }
                }
            }
        }

        public function Select($coluna, $login, $senha){
            // Realiza o login do usuário
            $sql = "SELECT * FROM usuarios WHERE $coluna = :login";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindParam(":login", $login);
            $stmt->execute();
            if($stmt->rowCount() == 1){
                $dados = $stmt->fetch(PDO::FETCH_ASSOC);
                if(password_verify($senha, $dados["senha"])){
                    $_SESSION["id_usuario"] = $dados["id_usuario"];
                    $_SESSION["nome"] = $dados["nome"];
                    $_SESSION["tipo"] = $dados["tipo"];
                    $_SESSION["coluna"] = strtoupper($coluna);
                    $_SESSION["foto"] = $coluna == "ra" ? "assets/img/professores.svg" : "assets/img/alunos.svg";
                    $_SESSION["login"] = $dados[$coluna];
                    $_SESSION["email"] = $dados["email"];
                    return LOGADO;
                }else{
                    return SENHA_INCORRETA;
                }
            }else{
                return NAO_CADASTRADO;
            }
        }
    }