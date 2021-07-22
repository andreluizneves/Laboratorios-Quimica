<?php

    class RelatorioController{
        private $model;
        private $dados;

        public function __construct(){
            $this->model = new Relatorio;
        }
        /* O mesmo processo do controller equipamento, reagente, vidraria e
         vidraria quebrada se repete para algumas funções*/
        public function Catalogar($id_laboratorio, $titulo, $data, $hora, $aulas, $descricao, $equipamentos, $reagentes, $vidrarias){
            if($this->model->VerificarUser() === 1){
                if(empty($id_laboratorio) || empty($titulo) || empty($data) ||
                   empty($hora) || empty($aulas) || empty($descricao)){
                    return CAMPOS_VAZIOS;
                }else{
                    if(strlen(explode("-", $data)[0]) == 4){
                        $titulo = trim(substr(htmlspecialchars($titulo), 0, 55));
                        $data = trim(htmlspecialchars($data));
                        $hora = trim(htmlspecialchars($hora));
                        $aulas = trim(htmlspecialchars($aulas));
                        $data_hora = "$data $hora";
                        $descricao = trim(substr(htmlspecialchars($descricao), 0, 300));
                        return $this->model->Insert($id_laboratorio, $titulo, $data_hora, $aulas, $descricao, $equipamentos, $reagentes, $vidrarias);
                    }else{
                        return ERRO_DATA;
                    }
                }
            }else{
                return PERMISSAO_INVALIDA;
            }
        }

        public function Editar($titulo, $aulas, $id_laboratorio, $data, $hora, $descricao, $id_relatorio){
            if($this->model->VerificarUser() === 1){
                if(empty($id_laboratorio) || empty($titulo) || empty($data) ||
                   empty($hora) || empty($aulas) || empty($descricao)){
                    return CAMPOS_VAZIOS;
                }else{
                    if(strlen(explode("-", $data)[0]) == 4){
                        $titulo = trim(substr(htmlspecialchars($titulo), 0, 55));
                        $data = trim(htmlspecialchars($data));
                        $hora = trim(htmlspecialchars($hora));
                        $aulas = trim(htmlspecialchars($aulas));
                        $data_hora = "$data $hora";
                        $descricao = trim(substr(htmlspecialchars($descricao), 0, 300));
                        return $this->model->Update($titulo, $aulas, $id_laboratorio, $data_hora, $descricao, $id_relatorio); 
                    }else{
                        return ERRO_DATA;
                    }
                }
            }
        }

        public function VerRelatorio($id, $editavel){
            $dados = $this->model->ViewOne($id);
            $data = substr($dados[0]["data_hora"], 0, 10);
            $hora = substr($dados[0]["data_hora"], 11, 19);
            $modal = file_get_contents(__DIR__ . "../../View/modal-relatorio.html");
            $this->RenderizarTabela($dados);
            $modal = str_replace([
                "{{ titulo }}",
                "{{ equipamentos }}",
                "{{ reagentes }}",
                "{{ vidrarias }}",
                "{{ vidrarias-quebradas }}",
                "{{ data }}",
                "{{ hora }}",
                "{{ descricao }}",
                "{{ id_relatorio }}",
                "{{ tempo }}",
                "{{ id_laboratorio }}",
                '"{{ editavel }}"'
            ], [
                $dados[0]["titulo"],
                $this->dados[1],
                $this->dados[2],
                $this->dados[3],
                $this->dados[4],
                $data,
                $hora,
                $dados[0]["descricao"],
                $dados[0]["id_relatorio"],
                $dados[0]["aulas"],
                $dados[0]["id_laboratorio"],
                $editavel
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

        public function ListarOptions(){
            $retorno = $this->model->Select();
            if(!empty($retorno)){
                for ($i=0; $i < count($retorno); $i++) { 
                    $id = $retorno[$i][0];
                    $titulo = $retorno[$i][2];
                    $this->dados .= "<option value='$id'>$titulo</option>";
                }
            }else{
                $this->dados = "<option value=''>Nenhuma Aula registrada</option>";
            }
            // Os dados dos relatórios recuperados, são usados para gerar as opções de aulas
            return $this->dados;
        }

        public function Pesquisa($filtro){
            $retorno = $this->model->Search($filtro);
            $this->RenderizarCards($retorno);
            return $this->dados;
        }

        public function RenderizarImgs($dados){
            $imgs = "<div class='mb-2 mt-2' style='text-align-last: center;'>";
            if($dados["equipamento"] === 1){
                $imgs .= "<img style='width: 35px;filter: drop-shadow(2px 4px 6px black)' src='assets/img/icons/icone-equipamento.png' title='Usou Equipamento(s)'> &nbsp;";
            }
            if($dados["reagente"] === 1){
                $imgs .= "<img style='width: 35px;filter: drop-shadow(2px 4px 6px black)' src='assets/img/icons/icone-reagente.png' title='Usou Reagente(s)'> &nbsp;";
            }
            if($dados["vidraria"] === 1){
                $imgs .= "<img style='width: 35px;filter: drop-shadow(2px 4px 6px black)' src='assets/img/icons/icone-vidraria.png' title='Usou Vidraria(s)'> &nbsp;";
            }
            if($dados["vidraria_quebrada"] === 1){
                $imgs .= "<img style='width: 35px;filter: drop-shadow(2px 4px 6px black)' src='assets/img/icons/icone-vidraria-quebrada.png' title='Houve quebra de Vidraria(s)'>";
            }
            $imgs .= "</div>";
            // Se foi usado uma determinada entidades, ela aparece no card, acima ocorre a seleção
            return $imgs;
        }

        public function RenderizarCards($retorno){
            if(!empty($retorno)){
                for ($i=0; $i < count($retorno); $i++) {
                    // Cria as váriaveis para a interpolação durante a renderização dos cards
                    $id = $retorno[$i][0];
                    $dataHora = $retorno[$i][1];
                    $titulo = $retorno[$i][2];
                    $professor = $retorno[$i][3];
                    $laboratorio = $retorno[$i][4];
                    $dados = $retorno[$i];

                    $this->dados .= "<div style='display:none;' id='$id' class='col-12 coluna-card col-md-4 col-sm-12 col-lg-4 mb-4'>
                                        <div entidade='relatorio' id='$id' class='card'>
                                            <div class='card-header font-weight-bold'>
                                                Relatório: $titulo
                                            </div>
                                            <div class='card-body'>
                                                <div class='row'>
                                                    <div class='col-5 text-left'>
                                                        <div class='font-weight-bold'>
                                                            Professor(a): $professor
                                                        </div>
                                                        <br>
                                                        <div class='mt-4'>
                                                            Laboratório $laboratorio
                                                        </div>
                                                    </div>
                                                    <div style='text-align-last: justify;justify-content: space-around;' class='col-7 flex-column text-right d-flex'>
                                                        <div class='font-weight-bold'>
                                                            <i class='fas fa-calendar-alt'></i>
                                                                $dataHora
                                                            <i class='fas fa-clock'></i>
                                                        </div>
                                                        {$this->RenderizarImgs($dados)}
                                                        {$this->model->RenderizarBotoes($id, "relatorio")}
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

        public function RenderizarTabela($dados){
            for ($i=1; $i < count($dados); $i++) { 
                if(!empty($dados[$i])){
                    for ($u=0; $u < count($dados[$i]); $u++) {
                        // Verifica se no array há a "quantia" para identificar o reagente
                        if(array_key_exists("quantia", $dados[$i][$u])){
                            $entidade = $dados[$i][$u]["nome"];
                            $quantia = $dados[$i][$u]["quantia"];
                            $medida = array_key_exists("medida", $dados[$i][$u]) ? $dados[$i][$u]["medida"] : "un" ;
                            $this->dados[$i] .= "<tr role='row' class='bg-light'>
                                                    <td style='padding:5px;'>
                                                        $entidade
                                                    </td>
                                                    <td style='padding:5px;'>
                                                        $quantia $medida
                                                    </td>
                                                </tr>";
                        }else{
                            $entidade = $dados[$i][$u]["nome"];
                            $this->dados[$i] .= "<tr role='row' class='bg-light'>
                                                    <td style='padding:5px;'>
                                                        $entidade
                                                    </td>
                                                </tr>";
                        }
                    }
                }else{
                    $this->dados[$i] = "<tr role='row' class='bg-light'>
                                            <td colspan='2' style='padding:5px;'>
                                                Nenhum registro encontrado
                                            </td>
                                        </tr>";
                }
            }
        }
    }