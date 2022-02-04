<?php

    declare(strict_types=1);

    namespace App\Models;

    use App\Database\Database;
    use PDOStatement;

    class User {
        /**
         * Método responsável por realizar seleções na tabela de Usuários.
         * @param string $join Join com outras tabelas
         * @param string $where Condição para o SELECT
         * @param string $order Ordenação dos resultados
         * @param string $fields Campos da tabela
         * @param array $params Parâmetros da SQL (Array [$value])
         * @return PDOStatement
         */
        public static function Select(string $join = "", string $where = "", string $order = "", string $fields = "*", array $params = []) : PDOStatement {
            return (new Database("users"))->Select($join, $where, $order, $fields, $params);
        }

        /**
         * Método responsável por realizar inserções na tabela de Usuários.
         * @param array $values Valores a serem inseridos (Array associativo ["field" => $value])
         * @return int ID do usuário cadastrado
         */
        public static function Insert(array $params) : int {
            return (new Database("users"))->Insert($params);
        }
    }