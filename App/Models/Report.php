<?php

    declare(strict_types=1);

    namespace App\Models;

    use App\Database\Database;
    use PDOStatement;

    class Report {
        /**
         * Método responsável por realizar seleções na tabela de Relatórios.
         * @param string $join Join com outras tabelas
         * @param string $where Condição para o SELECT
         * @param string $order Ordenação dos resultados
         * @param string $fields Campos da tabela
         * @param array $params Parâmetros da SQL (Array [$value])
         * @return PDOStatement
         */
        public static function Select(string $join = "", string $where = "", string $order = "", string $fields = "*", array $params = []) : PDOStatement {
            return (new Database("reports"))->Select($join, $where, $order, $fields, $params);
        }

        /**
         * Método responsável por realizar inserções na tabela de Relatórios.
         * @param array $values Valores a serem inseridos (Array associativo ["field" => $value])
         * @return int ID do equipamento cadastrado
         */
        public static function Insert(array $params) : int {
            return (new Database("reports"))->Insert($params);
        }

        /**
         * Método responsável por realizar inserções na tabela N:N de Relatórios e Equipamentos.
         * @param array $params Valores a serem inseridos (Array associativo ["field" => $value])
         * @return int ID do relatorio e equipamento cadastrado
         */
        public static function InsertReportsEquipament(array $params) : int {
            return (new Database("reports_equipament"))->Insert($params);
        }

        /**
         * Método responsável por realizar inserções na tabela N:N de Relatórios e Reagentes.
         * @param array $params Valores a serem inseridos (Array associativo ["field" => $value])
         * @return int ID do relatorio e reagente cadastrado
         */
        public static function InsertReportsReagents(array $params) : int {
            return (new Database("reports_reagents"))->Insert($params);
        }

        /**
         * Método responsável por realizar inserções na tabela N:N de Relatórios e Vidrarias.
         * @param array $params Valores a serem inseridos (Array associativo ["field" => $value])
         * @return int ID do relatorio e vidraria cadastrada
         */
        public static function InsertReportsGlassworks(array $params) : int {
            return (new Database("reports_glassworks"))->Insert($params);
        }

        /**
         * Método responsável por realizar atualizações na tabela de Relatórios.
         * @param string $where Condição para atualização
         * @param array $values Valores a serem atualizados (Array associativo ["field" => $value])
         * @return bool Retorna true se a atualização for bem sucedida
         */
        public static function Update(string $where, array $values) : bool {
            return (new Database("reports"))->Update($where, $values);
        }

        /**
         * Método responsável por realizar exclusões na tabela de Relatórios.
         * @param string $where Condição para exclusão
         * @param array $params Parâmetros da SQL (Array [$value])
         * @return bool Retorna true se a exclusão for bem sucedida
         */
        public static function Delete(string $where, array $params) : bool {
            return (new Database("reports"))->Delete($where, $params);
        }
    }