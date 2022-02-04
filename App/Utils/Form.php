<?php

    declare(strict_types=1);

    namespace App\Utils;

    use App\Utils\Response;

    class Form {
        /**
         * Método responsável por sanatizar um campo.
         * @param string $field Campo a ser sanatizado
         * @param int $filter Tipo de filtro a ser aplicado
         * @return string Retorna o campo sanatizado
         */
        public static function SanatizeField(string $field, int $filter) : string {
            return filter_var(htmlspecialchars(trim($field)), $filter);
        }

        /**
         * Método responsável por verificar se existe algum campo vazio num formulário.
         * @param array $fields Campos a serem verificados
         * @return void
         */
        public static function VerifyEmptyFields(array $form) : void {
            foreach($form as $field) {
                $field == "" ? Response::Message(EMPTY_FIELDS) : "";
            }
        }

        /**
         * Método responsável por criptografar a senha.
         * @param string $password Senha a ser criptografada
         * @return string Retorna a senha criptografada
         */
        public static function EncryptPassword(string $password) : string {
            return password_hash($password, PASSWORD_DEFAULT);
        }

        /**
         * Método responsável por verificar a senha para login.
         * @param string $password Senha a ser verificada
         * @param string $hash Hash da senha criptografada do banco de dados
         * @return void
         */
        public static function VerifyPassword(string $password, string $hash) : void {
            !password_verify($password, $hash) ? Response::Message(WRONG_PASSWORD) : "";
        }

        /**
         * Método responsável por validar o ID de uma entidade.
         * @param int $id ID a ser validado
         * @return void
         */
        public static function ValidateID(int $id) : void {
            is_numeric($id) && $id < 1 ? Response::Message(INVALID_ID) : "";
        }

        /**
         * Método responsável por validar o tipo de usuário.
         * @param int $type Tipo de usuário (2 = Professor, 1 = Aluno)
         * @return void
         */
        public static function ValidateTypeUser(int $type) : void {
            $type < 1 || $type > 2 ? Response::Message(INVALID_TYPE) : "";
        }

        /**
         * Método responsável por validar o login (RA/RM).
         * @param int $login Login a ser validado
         * @return void
         */
        public static function ValidateLogin(int $login) : void {
            $login < 1 || $login > 99999 ? Response::Message(INVALID_LOGIN) : "";
        }

        /**
         * Método responsável por validar o email.
         * @param string $email Email a ser validado
         * @return void
         */
        public static function ValidateEmail(string $email) : void {
            !filter_var($email, FILTER_VALIDATE_EMAIL) ? Response::Message(INVALID_EMAIL) : "";
        }

        /**
         * Método responsável por validar o número de patrimônio.
         * @param int $patrimony Patrimônio a ser validado
         * @return void
         */
        public static function ValidatePatrimony(int $patrimony) : void {
            $patrimony < 1 || $patrimony > 999999999 ? Response::Message(INVALID_PATRIMONY) : "";
        }

        /**
         * Método responsável por validar o laboratório.
         * @param int $laboratory Laboratório a ser validado
         * @return void
         */
        public static function ValidateLaboratory(int $laboratory) : void {
            $laboratory < 1 || $laboratory > 3 ? Response::Message(INVALID_LABORATORY) : "";
        }

        /**
         * Método responsável por validar a quantidade no valor decimal.
         * @param float $quantity Quantidade a ser validada
         * @return void
         */
        public static function ValidateQuantityFloat(float $quantity) : void {
            $quantity < 1 || $quantity > 9999.99 ? Response::Message(INVALID_QUANTITY) : "";
        }

        /**
         * Método responsável por validar a quantidade no valor inteiro.
         * @param int $quantity Quantidade a ser validada
         * @return void
         */
        public static function ValidateQuantityInt(int $quantity) : void {
            $quantity < 1 || $quantity > 999999999 ? Response::Message(INVALID_QUANTITY) : "";
        }

        /**
         * Método responsável por validar a unidade de medida.
         * @param string $measure Unidade de medida a ser validada
         * @return void
         */
        public static function ValidateMeasure(string $measure) : void {
            $measure != "g" && $measure != "ml" && $measure != "L" ? Response::Message(INVALID_MEASURE) : "";
        }

        /**
         * Método responsável por validar a data e hora.
         * @param string $date_time Data e hora a ser validada
         * @return void
         */
        public static function ValidateDateTime(string $date_time) : void {
            !preg_match("/^[0-9]{4}[-][0-9]{2}[-][0-9]{2}[T][0-9]{2}[:][0-9]{2}$/", $date_time, $matches) ? Response::Message(INVALID_DATE_TIME) : "";
        }
    }