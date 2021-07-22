<?php

    class VidrariaQuebradaController{
        private $model;
        private $dados;

        public function __construct(){
            $this->model = new VidrariaQuebrada;
        }

        // O mesmo processo do controller equipamento, reagente
        // e vidraria quebrada se repete para algumas funções
        public function Catalogar($id_vidraria, $id_relatorio, $quantidade){
            if($this->model->VerificarUser() === 1){
                if(empty($id_vidraria) || empty($id_relatorio) || empty($quantidade)){
                    return CAMPOS_VAZIOS;
                }else{
                    $quantidade = trim(htmlspecialchars($quantidade));
                    return $this->model->Insert($id_vidraria, $id_relatorio, $quantidade);
                }
            }else{
                return $this->model->VerificarUser();
            }
        }

        public function Editar($id_vidraria_quebrada, $id_vidraria, $id_relatorio, $quantidade){
            if($this->model->VerificarUser() === 1){
                if(empty($id_vidraria_quebrada) || empty($id_vidraria) || empty($quantidade) ||
                   empty($id_relatorio)){
                    return ERRO_UPDATE;
                }else{
                    $quantidade = trim(htmlspecialchars($quantidade));
                    return $this->model->Update($id_vidraria_quebrada, $id_vidraria, $id_relatorio, $quantidade);
                }
            }else{
                return $this->model->VerificarUser();
            }
        }

        public function VerVidrariaQuebrada($id, $editavel){
            $dados = $this->model->ViewOne($id);
            $vidrarias = new VidrariaController;
            $vidrarias = $vidrarias->ListarOptions();
            $aulas = new RelatorioController;
            $aulas = $aulas->ListarOptions();
            $modal = file_get_contents(__DIR__ . "../../View/modal-vidraria-quebrada.html");
            $modal = str_replace([
                "{{ vidrarias }}",
                "{{ foto }}",
                "{{ quantidade-quebrada }}",
                "{{ aulas }}",
                "{{ laboratorio }}",
                "{{ id_vidraria_quebrada }}",
                "{{ id_vidraria }}",
                "{{ id_relatorio }}",
                '"{{ editavel }}"',
            ], [
                $vidrarias,
                $dados["foto"],
                $dados["quantidade_quebrada"],
                $aulas,
                $dados["laboratorio"],
                $dados["id_vidraria_quebrada"],
                $dados["id_vidraria"],
                $dados["id_relatorio"],
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

        public function RenderizarCards($retorno){
            if(!empty($retorno)){
                for ($i=0; $i < count($retorno); $i++) {
                    $id = $retorno[$i][0];
                    $nome = $retorno[$i][1];
                    $aula = $retorno[$i][2];
                    $foto = $retorno[$i][3];
                    $this->dados .= "<div style='display:none;' id='$id' class='col-12 coluna-card col-md-6 col-sm-6 col-lg-3 text-dark'>
                                        <div entidade='vidraria-quebrada' id='$id' class='card mb-4 item'>
                                            <h4 class='text-center mb-2 mt-2 font-weight-bold nome'>
                                                $nome
                                            </h4>
                                            <p class='text-center'>
                                                <img class='card-img-top img' height='200px' src='src/vidrarias/fotos/$foto'>
                                            </p>
                                            <div class='card-body'>
                                                <p class='card-text font-weight-bold p2px'>
                                                    Aula em que foi quebrada:
                                                </p>
                                                <p class='card-text'>
                                                    $aula
                                                </p>
                                                {$this->model->RenderizarBotoes($id, "vidraria-quebrada")}
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