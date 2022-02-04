<?php

    declare(strict_types=1);

    namespace App\Core;

    class Controller {
        /**
         * Botões da navbar
         * @var array
         */
        private array $buttons = [
            "<li class='btn-menu'>
                <i class='fas fa-home'></i>&nbsp;Menu
            </li>",
            "<li class='btn-equipament'>
                <i class='fas fa-microscope'></i>&nbsp;Equipamentos
            </li>",
            "<li class='btn-reagents'>
                <i class='fas fa-flask'></i>&nbsp;Reagentes
            </li>",
            "<li class='btn-reports'>
                <i class='fas fa-clipboard-list'></i>&nbsp;Relatórios
            </li>",
            "<li class='btn-glassworks'>
                <i class='fas fa-vials'></i>&nbsp;Vidrarias
            </li>",
            "<li class='btn-broken-glassware'>
                <i class='fas fa-ban'></i>&nbsp;Vidrarias Quebradas
            </li>"
        ];

        /**
         * Método responsável por retornar o objeto Model.
         * @param string $model Nome do Model
         * @return object Objeto Model
         */
        public function Model(string $model) : object {
            $model = "App\\Models\\$model";
            return new $model;
        }

        /**
         * Método responsável por retornar uma determinada View com ou sem dados.
         * @param string $view Caminho da View
         * @param array $data Dados que serão passados para o View
         * @return void
         */
        public function View(string $view, array $data = []) : void {
            require __DIR__ . "/../Views/$view.php";
        }

        /**
         * Método responsável por renderizar os botões da navbar.
         * @param int $indexBtn Índice do botão que será apagado (página atual)
         * @return string Botões da navbar em HTML
         */
        public function RenderButtons(int $indexBtn = null) : string {
            unset($this->buttons[$indexBtn]);
            return implode("", $this->buttons);
        }
    }