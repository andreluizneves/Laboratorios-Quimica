<?php

    class Pagina{
        private $page;
        private $modal;
        private $form;
        private $botoes = [
            "<li class='itens-navbar btn-menu'>
                <i class='fas fa-home'></i>&nbsp;
                Menu<span class='sr-only'>(current)</span>
            </li>",
            "<li class='itens-navbar btn-equipamentos'>
                <i class='fas fa-microscope'></i>&nbsp;
                Equipamentos<span class='sr-only'>(current)</span>
            </li>",
            "<li class='itens-navbar btn-reagentes'>
                <i class='fas fa-flask'></i>&nbsp;
                Reagentes<span class='sr-only'>(current)</span>
            </li>",
            "<li class='itens-navbar btn-relatorios'>
                <i class='fas fa-clipboard-list'></i>&nbsp;
                Relatórios<span class='sr-only'>(current)</span>
            </li>",
            "<li class='itens-navbar btn-vidrarias'>
                <i class='fas fa-vials'></i>&nbsp;
                Vidrarias<span class='sr-only'>(current)</span>
            </li>",
            "<li class='itens-navbar btn-vidrarias-quebradas'>
                <i class='fas fa-ban'></i>&nbsp;
                Vidrarias Quebradas<span class='sr-only'>(current)</span>
            </li>"
        ];

        // Função para a renderizar a pagina dos equipamentos, reagentes, relatórios, vidrarias e das vidrarias quebradas
        public function RenderPage($pagina, $idxBtn){

            // Verifica se há uma sessão para permitir o acesso
            empty($_SESSION) ? header("Location: /") : "";

            $this->page = file_get_contents(__DIR__ . "../../View/page.html");
            $pronome = substr($pagina, -1) == "o" ? "o(s)" : "a(s)";

            // Apaga o elemento que representa o botao e reordena para renderiza o restante
            unset($this->botoes[$idxBtn]);
            $this->botoes = array_values($this->botoes);

            // Concatena todos os botões a ser renderizado
            for ($i=0; $i < 5; $i++) {
                $this->botoes["renderizado"] .= $this->botoes[$i];
            }

            $this->page = str_replace([
                "{{ icone }}",
                "{{ titulo-pagina }}",
                "{{ css }}",
                "{{ foto }}",
                "{{ nome }}",
                "{{ login }}",
                "{{ botoes }}",
                "{{ titulo-jumbotron }}",
                "{{ atributo-entidade }}",
                "{{ legenda-botao }}",
                "{{ legenda-carregando }}",
                "{{ modal }}"
            ], [
                str_replace("relatório", "relatorio", $pagina),
                ucfirst(str_replace("-q", "s Q", $pagina) . "s"),
                str_replace("relatório", "relatorio", $pagina),
                $_SESSION["foto"],
                $_SESSION["tipo"] . ": " . $_SESSION["nome"],
                $_SESSION["coluna"] . ": " . $_SESSION["login"],
                $this->botoes["renderizado"],
                str_replace("a-", "as ", $pagina) . "s",
                str_replace(["relatório", "a-"], ["relatorio", "a-"], $pagina),
                str_replace("-", " ", $pagina),
                $pronome." ". str_replace("-", "s ", $pagina) . "s",
                $this->modal
            ], $this->page);
            // Renomeia os campos alvos com o conteudo dinâmico e gera página final
            return $this->page;
        }

        public function LoadForm($pagina){
            // Retorna o formulário html de uma determinada página
            $this->form = file_get_contents(__DIR__ . "../../View/form-$pagina.html");
            return $this->form;
        }

        public function LoadFormVidrariaQuebrada(){
            $this->form = file_get_contents(__DIR__ . "../../View/form-vidraria-quebrada.html");
            $vidrarias = new VidrariaController;
            $vidrarias = $vidrarias->ListarOptions();
            $aulas = new RelatorioController;
            $aulas = $aulas->ListarOptions();
            $this->form = str_replace([
                "{{ vidrarias }}",
                "{{ aulas }}"
            ], [
                $vidrarias,
                $aulas
            ], $this->form);
            /* Pega a estrutura do formulario da vidraria quebrada
             e já substitui os campos para as options das aulas e das vidrarias*/
            return $this->form;
        }

        public function LoadFormRelatorio(){
            $this->form = file_get_contents(__DIR__ . "../../View/form-relatorio.html");
            $equipamentos = new EquipamentoController;
            $reagentes = new ReagenteController;
            $vidrarias = new VidrariaController;
            $equipamentos = $equipamentos->ListarEquipamentoRelatorio();
            $reagentes = $reagentes->ListarReagenteRelatorio();
            $vidrarias = $vidrarias->ListarVidrariaRelatorio();
            $this->form = str_replace([
                "{{ dia }}",
                "{{ equipamentos }}",
                "{{ reagentes }}",
                "{{ vidrarias }}",
                "{{ professor }}"], [
                    date('Y-m-d'),
                    $equipamentos,
                    $reagentes,
                    $vidrarias,
                    $_SESSION["nome"]
                ], $this->form);
            /* Pega a estrutura do formulario do relatório e já substitui os campos
             para pequenos cards de equipamentos, reagentes e vidrarias*/
            return $this->form;
        }
    }