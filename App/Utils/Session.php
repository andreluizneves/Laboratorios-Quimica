<?php

    declare(strict_types=1);

    namespace App\Utils;

    class Session {
        /**
         * Método responsável por redirecionar para uma url.
         * @param string $url URL a ser redirecionada
         * @return void
         */
        public static function Redirect(string $url) : void {
            header("Location: $url");
        }

        /**
         * Método responsável por inicializar a sessão.
         * @return void
         */
        public static function StartSession() : void {
            session_start();
        }

        /**
         * Método responsável por destruir a sessão.
         * @return void
         */
        public static function DestroySession() : void {
            session_destroy();
            self::Redirect("/");
        }

        /**
         * Método responsável por verificar se a sessão está vazia.
         * @return bool Retorna true se estiver vazio false se não estiver
         */
        public static function IsEmptySession() : bool {
            return empty($_SESSION) ? true : false;
        }

        /**
         * Método responsável por verificar se o usuário é Professor/Administrador.
         * @return bool Retorna true se o usuário for um Professor/Administrador e false se não for
         */
        public static function IsAdmin() : bool {
            return $_SESSION["type"] == "Professor(a)" ? true : false;
        }
    }