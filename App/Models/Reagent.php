<?php

    declare(strict_types=1);

    namespace App\Models;

    use App\Database\Database;
    use PDOStatement;

    class Reagent {
        /**
         * Método responsável por realizar seleções na tabela de Reagentes.
         * @param string $join Join com outras tabelas
         * @param string $where Condição para o SELECT
         * @param string $order Ordenação dos resultados
         * @param string $fields Campos da tabela
         * @param array $params Parâmetros da SQL (Array [$value])
         * @return PDOStatement
         */
        public static function Select(string $join = "", string $where = "", string $order = "", string $fields = "*", array $params = []) : PDOStatement {
            return (new Database("reagents"))->Select($join, $where, $order, $fields, $params);
        }

        /**
         * Método responsável por realizar inserções na tabela de Reagentes.
         * @param array $values Valores a serem inseridos (Array associativo ["field" => $value])
         * @return int ID do reagente cadastrado
         */
        public static function Insert(array $params) : int {
            return (new Database("reagents"))->Insert($params);
        }

        /**
         * Método responsável por realizar atualizações na tabela de Reagentes.
         * @param string $where Condição para atualização
         * @param array $values Valores a serem atualizados (Array associativo ["field" => $value])
         * @return bool Retorna true se a atualização for bem sucedida
         */
        public static function Update(string $where, array $values) : bool {
            return (new Database("reagents"))->Update($where, $values);
        }

        /**
         * Método responsável por realizar atualizações na tabela de Reagentes.
         * @param string $where Condição para atualização
         * @param array $values Valores a serem atualizados (Array associativo ["field" => $value])
         * @return bool Retorna true se a atualização for bem sucedida
         */
        public static function UpdateQuantity(int $id_reagent, float $quantity) : bool {
            return (new Database("reagents"))->UpdateQuantity($id_reagent, $quantity);
        }

        /**
         * Método responsável por realizar exclusões na tabela de Reagentes.
         * @param string $where Condição para exclusão
         * @param array $params Parâmetros da SQL (Array [$value])
         * @return bool Retorna true se a exclusão for bem sucedida
         */
        public static function Delete(string $where, array $params) : bool {
            return (new Database("reagents"))->Delete($where, $params);
        }
    }