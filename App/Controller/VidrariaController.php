<?php

    class VidrariaController{
        private $model;
        private $dados;

        public function __construct(){
            $this->model = new Vidraria;
        }

        // Casos que pode ocorrer com a imagem e verificação da quantidade
        public function VerificaFoto($quantidade, $foto){
            switch ($foto["foto"]["error"]) {
                case 0:
                    if($foto["foto"]["size"] > 2500000){
                        return TAMANHO_EXCEDENTE;
                    }else{
                        if(is_numeric($quantidade)){
                            return 1;
                        }else{
                            return QUANTIDADE_INVALIDA;
                        }
                    }
                    break;

                case 1:
                    return EXCEDE_TAMANHO_SERVER;
                    break;

                case 4:
                    if(is_numeric($quantidade)){
                        return 1;
                    }else{
                        return QUANTIDADE_INVALIDA;
                    }
                    break;
            }
        }

        /* O mesmo processo do controller equipamento, reagente
         e vidraria quebrada se repete para algumas funções*/
        public function Catalogar($id_laboratorio, $nome, $quantidade, $descricao, $foto){
            if($this->model->VerificarUser() === 1){
                if(empty($id_laboratorio) || empty($nome) || empty($quantidade) ||
                   empty($descricao) || empty($foto["foto"]["name"])){
                    return CAMPOS_VAZIOS;
                }else{
                    if($this->VerificaFoto($quantidade, $foto) === 1){
                        $nome = trim(substr(htmlspecialchars($nome), 0, 50));
                        $quantidade = trim(htmlspecialchars($quantidade));
                        $descricao = trim(substr(htmlspecialchars($descricao), 0, 300));
                        return $this->model->Insert($id_laboratorio, $nome, $quantidade, $descricao, $foto["foto"]);
                    }else{
                        return $this->VerificaFoto($quantidade, $foto);
                    }
                }
            }else{
                return $this->model->VerificarUser();
            }
        }

        public function Editar($id_vidraria, $id_laboratorio, $nome, $quantidade, $descricao, $foto){
            if($this->model->VerificarUser() === 1){
                if(empty($id_vidraria) || empty($id_laboratorio) || empty($nome) ||
                   empty($quantidade) || empty($descricao)){
                    return ERRO_UPDATE;
                }else{
                    if($this->VerificaFoto($quantidade, $foto) === 1){
                        $nome = trim(substr(htmlspecialchars($nome), 0, 50));
                        $quantidade = trim(htmlspecialchars($quantidade));
                        $descricao = trim(substr(htmlspecialchars($descricao), 0, 300));
                        return $this->model->Update($id_vidraria, $id_laboratorio, $nome, $quantidade, $descricao, $foto["foto"]);
                    }else{
                        return $this->VerificaFoto($quantidade, $foto);
                    }
                }
            }else{
                return $this->model->VerificarUser();
            }
        }

        public function VerVidraria($id, $editavel){
            $dados = $this->model->ViewOne($id);
            $modal = file_get_contents(__DIR__ . "../../View/modal-vidraria.html");
            $modal = str_replace([
                "{{ nome }}",
                "{{ foto }}",
                "{{ descricao }}",
                "{{ quantidade }}",
                "{{ id_laboratorio }}",
                "{{ id_vidraria }}",
                '"{{ editavel }}"',
            ], [
                $dados["nome"],
                $dados["foto"],
                $dados["descricao"],
                $dados["quantidade"],
                $dados["id_laboratorio"],
                $dados["id_vidraria"],
                $editavel,
            ], $modal);
            return $modal;
        }

        public function Deletar($id){
            if($this->model->VerificarUser() === 1){
                return $this->model->Delete($id);
            }else{
                return $this->model->VerificarUser();
            }
        }

        public function ListarVidrariaRelatorio(){
            $retorno = $this->model->Select();
            $this->RenderizarCardsRelatorio($retorno);
            return $this->dados;
        }

        public function Listar(){
            $retorno = $this->model->Select();
            $this->RenderizarCards($retorno);
            return $this->dados;
        }

        public function ListarOptions(){
            $retorno = $this->model->Select();
            $this->IterarOptions($retorno);
            return $this->dados;
        }

        public function Pesquisa($filtro){
            $retorno = $this->model->Search($filtro);
            $this->RenderizarCards($retorno);
            return $this->dados;
        }

        public function RenderizarCards($retorno){
            if(!empty($retorno)){
                for ($i=0; $i < count($retorno) ; $i++) { 
                    $id = $retorno[$i][0];
                    $nome = $retorno[$i][1];
                    $quantidade = $retorno[$i][2];
                    $foto = $retorno[$i][3];

                    $this->dados .= " <div style='display:none;' id='$id' class='col-12 coluna-card col-md-6 col-sm-6 col-lg-3 text-dark'>
                                        <div entidade='vidraria' id='$id' class='card mb-4 item'>
                                            <h4 class='text-center mb-2 mt-2 font-weight-bold nome'>
                                                $nome
                                            </h4>
                                            <p class='text-center'>
                                                <img class='card-img-top img' height='200px' src='src/vidrarias/fotos/$foto'>
                                            </p>
                                            <div class='card-body'>
                                                <p class='card-text font-weight-bold p2px'>
                                                    Quantidade:
                                                </p>
                                                <p class='card-text'>
                                                    $quantidade unidades
                                                </p>
                                                {$this->model->RenderizarBotoes($id, "vidraria")}
                                            </div>
                                        </div>
                                    </div>";
                }
            }else{
                $this->dados = NENHUM_REGISTRO;
            }
            return $this->dados;
        }

        public function RenderizarCardsRelatorio($retorno){
            if(!empty($retorno)){
                for ($i=0; $i < count($retorno) ; $i++) { 
                    $id = $retorno[$i][0];
                    $nome = $retorno[$i][1];
                    $quantidade = $retorno[$i][2];
    
                    $this->dados .= "<div id='$id' style='padding:10px' class='col-12 col-md-6 col-sm-6 col-lg-3 text-dark'>
                                        <div id='$id' view='relatorio' selecionado='false' class='card select-relatorio-vidraria item'>
                                            <h4 class='text-center mb-2 mt-2 font-weight-bold nome'>
                                                $nome
                                            </h4>
                                            <div class='card-body pt-2 pb-2'>
                                                <div class='row'>
                                                    <div class='col-lg-8 col-8 col-md-8 col-sm-8'>
                                                        <p class='card-text font-weight-bold'>
                                                            Quantidade:
                                                        </p>
                                                    </div>
                                                    <div class='col-lg-4 col-4 col-md-4 col-sm-4'>
                                                        <p class='card-text'>
                                                            $quantidade
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

        public function IterarOptions($retorno){
            if(!empty($retorno)){
                for ($i=0; $i < count($retorno); $i++) { 
                    $id = $retorno[$i][0];
                    $nome = $retorno[$i][1];
                    $this->dados .= "<option value='$id'>$nome</option>";
                }
                /* Gera as opções para o formulário da vidraria quebrada, fazendo a abstração de
                dados do Model "Vidraria"*/
            }
            return $this->dados;
        }
    }