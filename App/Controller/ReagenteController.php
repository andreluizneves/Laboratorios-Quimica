<?php

    class ReagenteController{
        private $model;
        private $dados;

        public function __construct(){
            $this->model = new Reagente;
        }

        // Casos que pode ocorrer com a imagem e verificação da quantidade
        public function ValidarDados($quantidade, $foto){
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

        public function Catalogar($id_laboratorio, $nome, $medida, $quantidade, $foto){
            // Verifica a sessao
            if($this->model->VerificarUser() === 1){
                if(empty($id_laboratorio) || empty($nome) || empty($medida) || empty($quantidade) || 
                   empty($foto["foto"]["name"])){
                    // Verifica se todos os campos estao preenchidos
                    return CAMPOS_VAZIOS;
                }else{
                    if($this->ValidarDados($quantidade, $foto) === 1){
                        // Limpa os campos tirando os espaços nas pontas, tags html e recorta a string
                        $nome = trim(substr(htmlspecialchars($nome), 0, 50));
                        $medida = trim(htmlspecialchars($medida));
                        $quantidade = trim(htmlspecialchars($quantidade));
                        return $this->model->Insert($id_laboratorio, $nome, $medida, $quantidade, $foto["foto"]);
                    }else{
                        return $this->ValidarDados($quantidade, $foto);
                    }
                }
            }else{
                return $this->model->VerificarUser();
            }
        }

        public function Editar($id_reagente, $id_laboratorio, $nome, $medida, $quantidade, $foto){
            // Verifica a sessao
            if($this->model->VerificarUser() === 1){
                if(empty($id_reagente) || empty($id_laboratorio) || empty($nome) || empty($medida) ||
                   empty($quantidade)){
                    // Verifica se todos os campos estao preenchidos
                    return ERRO_UPDATE;
                }else{
                    if($this->ValidarDados($quantidade, $foto) === 1){
                        // Limpa os campos tirando os espaços nas pontas, tags html e recorta a string
                        $nome = trim(substr(htmlspecialchars($nome), 0, 50));
                        $quantidade = trim(htmlspecialchars($quantidade));
                        $medida = trim(htmlspecialchars($medida));
                        return $this->model->Update($id_reagente, $id_laboratorio, $nome, $medida, $quantidade, $foto["foto"]);
                    }else{
                        return $this->ValidarDados($quantidade, $foto);
                    }
                }
            }else{
                return $this->model->VerificarUser();
            }
        }

        public function VerReagente($id, $editavel){
            // Recupera os dados do reagente do banco do dados
            $dados = $this->model->ViewOne($id);
            $modal = file_get_contents(__DIR__ . "../../View/modal-reagente.html");
            $modal = str_replace([
                "{{ nome }}",
                "{{ foto }}",
                "{{ quantidade }}",
                "{{ id_reagente }}",
                "{{ id_laboratorio }}",
                "{{ medida }}",
                '"{{ editavel }}"',
            ], [
                $dados["nome"],
                $dados["foto"],
                $dados["quantidade"],
                $dados["id_reagente"],
                $dados["id_laboratorio"],
                $dados["medida"],
                $editavel,
            ], $modal);
            // Renomeia os campos dinâmicos e renderiza a janela modal
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

        public function ListarReagenteRelatorio(){
            $retorno = $this->model->Select();
            $this->RenderizarCardsRelatorio($retorno);
            return $this->dados;
        }

        public function RenderizarCards($retorno){
            if(!empty($retorno)){
                for ($i=0; $i < count($retorno) ; $i++) { 
                    // Cria as váriaveis para a interpolação durante a renderização dos cards
                    $id = $retorno[$i][0];
                    $nome = $retorno[$i][2];
                    $quantidade = $retorno[$i][4];
                    $medida = $retorno[$i][3];
                    $foto = $retorno[$i][5];

                    $this->dados .= "<div style='display:none;' id='$id' class='col-12 coluna-card col-md-6 col-sm-6 col-lg-3 text-dark'>
                                        <div entidade='reagente' id='$id' class='card mb-4 item'>
                                            <h4 class='text-center mb-2 mt-2 font-weight-bold nome'>
                                                $nome
                                            </h4>
                                            <p class='text-center'>
                                                <img class='card-img-top img' height='200px' src='src/reagentes/fotos/$foto'>
                                            </p>
                                            <div class='card-body'>
                                                <p class='card-text font-weight-bold p2px'>
                                                    Quantidade:
                                                </p>
                                                <p class='card-text'>
                                                    $quantidade$medida
                                                </p>
                                                {$this->model->RenderizarBotoes($id, "reagente")}
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
                for ($i=0; $i < count($retorno); $i++) {
                    // Cria as váriaveis para a interpolação durante a renderização dos cards 
                    $id = $retorno[$i][0];
                    $nome = $retorno[$i][2];
                    $quantidade = $retorno[$i][4];

                    $this->dados .= "<div id='$id' style='padding:10px;transition:1s;' class='col-12 col-md-6 col-sm-6 col-lg-3 text-dark'>
                                        <div id='$id' view='relatorio' selecionado='false' class='card select-relatorio-reagente item'>
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
                                            <div class='card-body d-none linha-quantidade pt-2 pb-2'>
                                                <div class='row'>
                                                    <div class='col-lg-8 col-8 col-md-8 col-sm-8'>
                                                        <p class='card-text font-weight-bold'>
                                                            Utilizei:
                                                        </p>
                                                    </div>
                                                    <div class='col-lg-4 col-4 col-md-4 col-sm-4'>
                                                        <input type='number' name='quantidade' class='form-control quantidade-usada input text-center'>
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