<?php

    declare(strict_types=1);

    namespace App\Utils;

    class Response {
        /**
         * Método responsável por carregar as respostas do servidor.
         * @return void
         */
        public static function LoadResponses() : void {
            require __DIR__ . "/responses.php";
        }

        /**
         * Método responsável retornar uma resposta para o usuário e sem seguida encerrar a execução do script.
         * @param array $response Resposta a ser retornada com icone e mensagem
         * @return void
         */
        public static function Message(array $response) : void {
            die(json_encode($response));
        }
    }