<?php

    class EquipamentoController{
        private $model;
        private $dados;

        public function __construct(){
            $this->model = new Equipamento;
        }

        public function ValidaDados($patrimonio, $foto){
            // Casos que pode ocorrer com a imagem junto à verificação do patrimônio
            switch ($foto["foto"]["error"]) {
                case 0:
                    if($foto["foto"]["size"] > 2500000){
                        return TAMANHO_EXCEDENTE;
                    }else{
                        if(is_numeric($patrimonio)){
                            return 1;
                        }else{
                            return PATRIMONIO_INVALIDO;
                        }
                    }
                    break;

                case 1:
                    return EXCEDE_TAMANHO_SERVER;
                    break;

                case 4:
                    if(is_numeric($patrimonio)){
                        return 1;
                    }else{
                        return PATRIMONIO_INVALIDO;
                    }
                    break;
            }
        }

        public function Catalogar($id_laboratorio, $nome, $patrimonio, $descricao, $foto){
            // Verifica o tipo de usuario, sendo 1 = professor (adm)
            if($this->model->VerificarUser() === 1){
                // Verificação dos campos em branco
                if(empty($id_laboratorio) || empty($nome) || empty($patrimonio) ||
                   empty($descricao) || empty($foto["foto"]["name"])){
                    return CAMPOS_VAZIOS;
                }else{
                    if($this->ValidaDados($patrimonio, $foto) === 1){
                        // Faz a limpeza dos campos eliminando tags html, espaços nas pontas e recorta a string
                        $nome = trim(substr(htmlspecialchars($nome), 0, 50));
                        $patrimonio = trim(htmlspecialchars($patrimonio));
                        $descricao = trim(substr(htmlspecialchars($descricao), 0, 300));
                        return $this->model->Insert($id_laboratorio, $nome, $patrimonio, $descricao, $foto["foto"]);
                    }else{
                        return $this->ValidaDados($patrimonio, $foto);
                    }
                }
            }else{
                return $this->model->VerificarUser();
            }
        }

        public function Editar($id_equipamento, $id_laboratorio, $nome, $patrimonio, $descricao, $foto){
            // Verifica o tipo de usuario, sendo 1 = professor(adm)
            if($this->model->VerificarUser() === 1){
                // Verificação dos campos em branco
                if(empty($id_equipamento) || empty($id_laboratorio) || empty($nome) ||
                   empty($patrimonio) || empty($descricao)){
                    return ERRO_UPDATE;
                }else{
                    if($this->ValidaDados($patrimonio, $foto) === 1){
                        // Faz a limpeza dos campos eliminando tags html, espaços nas pontas e recorta a string
                        $nome = trim(substr(htmlspecialchars($nome), 0, 50));
                        $patrimonio = trim(htmlspecialchars($patrimonio));
                        $descricao = trim(substr(htmlspecialchars($descricao), 0, 300));
                        return $this->model->Update($id_equipamento, $id_laboratorio, $nome, $patrimonio, $descricao, $foto["foto"]);
                    }else{
                        return $this->ValidaDados($patrimonio, $foto);
                    }
                }
            }else{
                return $this->model->VerificarUser();
            }
        }

        public function VerEquipamento($id, $editavel){
            // Recupera os dados do equipamento do banco do dados
            $dados = $this->model->ViewOne($id);
            $modal = file_get_contents(__DIR__ . "../../View/modal-equipamento.html");
            $modal = str_replace([
                "{{ nome }}",
                "{{ foto }}",
                "{{ descricao }}",
                "{{ patrimonio }}",
                "{{ id_laboratorio }}",
                "{{ id_equipamento }}",
                '"{{ editavel }}"',
            ], [
                $dados["nome"],
                $dados["foto"],
                $dados["descricao"],
                $dados["patrimonio"],
                $dados["id_laboratorio"],
                $dados["id_equipamento"],
                $editavel,
            ], $modal);
            // Renomeia os campos a serem substituido (alvos) e renderiza e gera janela modal final
            return $modal;
        }

        public function Deletar($id){
            // Verifica o tipo de usuario, sendo 1 = professor(adm)
            if($this->model->VerificarUser() === 1){
                return $this->model->Delete($id);
            }else{
                return $this->model->VerificarUser();
            }
        }

        public function Listar(){
            $retorno = $this->model->Select();
            $this->RenderizarCards($retorno);
            return $this->dados;
        }

        public function Pesquisa($filtro){
            $retorno = $this->model->Search($filtro);
            $this->RenderizarCards($retorno);
            return $this->dados;
        }

        public function ListarEquipamentoRelatorio(){
            $retorno = $this->model->Select();
            $this->RenderizarCardRelatorio($retorno);
            return $this->dados;
        }

        public function RenderizarCards($retorno){
            if(!empty($retorno)){
                for ($i=0; $i < count($retorno); $i++) {
                    // Cria as váriaveis para a interpolação durante a renderização dos cards 
                    $id = $retorno[$i][0];
                    $nome = $retorno[$i][1];
                    $patrimonio = $retorno[$i][2];
                    $foto = $retorno[$i][3];

                    $this->dados .= "<div style='display:none;' id='$id' class='col-12 coluna-card col-md-6 col-sm-6 col-lg-3 text-dark'>
                                        <div entidade='equipamento' id='$id' class='card mb-4 item'>
                                            <h4 class='text-center mb-2 mt-2 font-weight-bold nome'>
                                                $nome
                                            </h4>
                                            <p class='text-center'>
                                                <img class='card-img-top img' height='200px' src='src/equipamentos/fotos/$foto'>
                                            </p>
                                            <div class='card-body'>
                                                <p class='card-text font-weight-bold p2px'>
                                                    Número de Patrimônio:
                                                </p>
                                                <p class='card-text'>
                                                    $patrimonio
                                                </p>
                                                {$this->model->RenderizarBotoes($id, "equipamento")}
                                            </div>
                                        </div>
                                    </div>";
                }
            }else{
                $this->dados = NENHUM_REGISTRO;
            }
            return $this->dados;
        }

        public function RenderizarCardRelatorio($retorno){
            if(!empty($retorno)){
                for ($i=0; $i < count($retorno); $i++) {
                    // Cria as váriaveis para a interpolação durante a renderização dos cards 
                    $id = $retorno[$i][0];
                    $nome = $retorno[$i][1];
                    $patrimonio = $retorno[$i][2];

                    $this->dados .= "<div id='$id' style='padding:10px' class='col-12 col-md-6 col-sm-6 col-lg-3 text-dark'>
                                        <div id='$id' view='relatorio' selecionado='false' class='card select-relatorio-equipamento item'>
                                            <h4 class='text-center mb-2 mt-2 font-weight-bold nome'>
                                                $nome
                                            </h4>
                                            <div class='card-body pt-2 pb-2'>
                                                <div class='row'>
                                                    <div class='col-lg-8 col-8 col-md-8 col-sm-8'>
                                                        <p class='card-text font-weight-bold'>
                                                            Número de Patrimônio:
                                                        </p>
                                                    </div>
                                                    <div class='col-lg-4 col-4 col-md-4 col-sm-4'>
                                                        <p class='card-text'>
                                                            $patrimonio
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                }
            }else{
                $this->dados = NENHUM_REGISTRO;
            }
            return $this->dados;
        }
    }