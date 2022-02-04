<?php

    declare(strict_types=1);

    namespace App\Controllers;

    use App\Core\Controller;
    use App\Models\User;
    use App\Utils\{
        Response,
        Form,
        Session
    };
    use PDO;

    /**
     * Classe herdada de Controller responsável por controlar as ações do Usuário.
     * @author Mário Guilherme de Andrade Rodrigues
     */
    class UserController extends Controller {
        private User $model;

        /**
         * Método responsável de carregar a configuração do banco de dados e instanciar o modelo de Usuário.
         * @return void
         */
        private function GetModel() : void {
            require __DIR__ . "/../Config/Connection.php";
            $this->model = new User();
        }

        /**
         * Método responsável por fazer o login do usuário.
         * @param array $form Dados do formulário
         * @return void
         */
        public function Login(array $form) : void {
            if(Session::IsEmptySession()) {
                // LIMPA OS CAMPOS
                $type = (int) Form::SanatizeField($form["type"], FILTER_SANITIZE_NUMBER_INT);
                $login = (int) Form::SanatizeField($form["login"], FILTER_SANITIZE_NUMBER_INT);
                $password = Form::SanatizeField($form["password"], FILTER_SANITIZE_STRING);

                // VERIFICA CAMPOS VAZIOS, TIPO DE USUÁRIO E LOGIN
                Form::VerifyEmptyFields([$type, $login, $password]);
                Form::ValidateTypeUser($type);
                Form::ValidateLogin($login);

                // OBTÊM A MODEL E REALIZA A QUERY
                $this->GetModel();
                $stmtUser = $this->model::Select("", "type = ? AND login = ?", "", "*", [$type, $login]);

                // VERIFICA SE O USUÁRIO EXISTE
                $stmtUser->rowCount() > 0 ? "" : Response::Message(USER_NOT_FOUND);

                // VERIFICA A SENHA
                $user = $stmtUser->fetch(PDO::FETCH_ASSOC);
                Form::VerifyPassword($password, $user["password"]);

                // CRIA A SESSÃO DO USUÁRIO E RETORNA A MENSAGEM
                $_SESSION = [
                    "id_user" => (int) $user["id_user"],
                    "name" => $user["name"],
                    "login" => (int) $user["login"],
                    "email" => $user["email"],
                    "typeLogin" => $type == 2 ? "RA" : "RM",
                    "type" => $user["type"] == 2 ? "Professor(a)" : "Aluno(a)",
                    "photo" => $type == 2 ? "teachers" : "students"
                ];
                Response::Message(LOGGED);
            } else 
                Response::Message(ALREADY_LOGGED);
        }

        /**
         * Método responsável por fazer o cadastro do usuário.
         * @param array $form Dados do formulário
         * @return void
         */
        public function Register(array $form) : void {
            if(Session::IsEmptySession()) {
                // LIMPA OS CAMPOS
                $type = (int) Form::SanatizeField($form["type"], FILTER_SANITIZE_NUMBER_INT);
                $name = Form::SanatizeField($form["name"], FILTER_SANITIZE_STRING);
                $login = (int) Form::SanatizeField($form["login"], FILTER_SANITIZE_NUMBER_INT);
                $email = Form::SanatizeField($form["email"], FILTER_SANITIZE_STRING);
                $password = Form::SanatizeField($form["password"], FILTER_SANITIZE_STRING);

                // VERIFICA CAMPOS VAZIOS, EMAIL, TIPO DE USUÁRIO E LOGIN
                Form::VerifyEmptyFields([$type, $name, $login, $email, $password]);
                Form::ValidateEmail($email);
                Form::ValidateTypeUser($type);
                Form::ValidateLogin($login);
                $password = Form::EncryptPassword($password);

                // OBTÊM A MODEL E REALIZA A QUERY E VERIFICA SE O RM/RA OU O EMAIL ESTÁ EM USO
                $this->GetModel();
                $stmtUser = $this->model::Select("", "type = ? AND login = ? OR email = ?", "", "*", [$type, $login, $email]);
                $stmtUser->rowCount() > 0 ? Response::Message(LOGIN_EMAIL_ALREADY_REGISTERED) : "";

                // CADASTRO O USUÁRIO
                $stmtUser = $this->model::Insert([
                    "name" => $name,
                    "login" => $login,
                    "email" => $email,
                    "password" => $password,
                    "type" => $type
                ]);

                // VERIFICA SE O INSERT DEU CERTO E EM SEGUIDA CRIA A SESSÃO DO USUÁRIO
                $stmtUser === false ? Response::Message(GENERAL_ERROR) : "";
                $_SESSION = [
                    "id_user" => (int) $stmtUser,
                    "name" => $name,
                    "login" => (int) $login,
                    "email" => $email,
                    "typeLogin" => $type == 2 ? "RA" : "RM",
                    "type" => $type == 2 ? "Professor(a)" : "Aluno(a)",
                    "photo" => $type == 2 ? "teachers" : "students"
                ];
                Response::Message(REGISTERED);
            } else 
                Response::Message(ALREADY_LOGGED);
        }
    }