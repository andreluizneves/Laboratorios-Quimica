<?php

    class Relatorio extends Conexao{

        public function Insert($id_laboratorio, $titulo, $data_hora, $aulas, $descricao, $equipamentos, $reagentes, $vidrarias){
            // Cria o sql do relatorio
            $sql = "INSERT INTO relatorios (id_usuario, id_laboratorio, titulo, data_hora, aulas, descricao) VALUES (:id_usuario, :id_laboratorio, :titulo, :data_hora, :aulas, :descricao)";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindParam(":id_usuario", $_SESSION["id_usuario"]);
            $stmt->bindParam(":id_laboratorio", $id_laboratorio);
            $stmt->bindParam(":titulo", $titulo);
            $stmt->bindParam(":data_hora", $data_hora);
            $stmt->bindParam(":aulas", $aulas);
            $stmt->bindParam(":descricao", $descricao);

            if($stmt->execute()){
                $id_relatorio = $this->PDO->lastInsertId();

                // Prepara o SQL para informar os reagentes e sua quantidade usada
                $sql = "INSERT INTO relatorios_reagentes (id_relatorio, id_reagente, quantidade_usada) VALUES (:id_relatorio, :id_reagente, :quantidade_usada)";
                $stmt = $this->PDO->prepare($sql);

                // Inicio do laço para iterar o array dos reagentes
                for ($i=0; $i < count($reagentes); $i++) {

                    if(!empty($reagentes[$i][1])){

                        // Pegar a quantidade armazenada no estoque para fazera subtração
                        $sqlQuantidade = "SELECT quantidade FROM reagentes WHERE id_reagente = :id_reagente";
                        $sqlQuantidade = $this->PDO->prepare($sqlQuantidade);
                        $sqlQuantidade->bindParam(":id_reagente", $reagentes[$i][0]);
                        $sqlQuantidade->execute();

                        $quantidade = $sqlQuantidade->fetch(PDO::FETCH_ASSOC)["quantidade"];
                        $novaQuantidade = $quantidade - $reagentes[$i][1];
                        // Realiza a subtração para a nova quantidade do reagente

                        if ($novaQuantidade >= 0) {
                            $stmt->bindParam(":id_relatorio", $id_relatorio);
                            $stmt->bindParam(":id_reagente", $reagentes[$i][0]);
                            $stmt->bindParam(":quantidade_usada", $reagentes[$i][1]);
                            $stmt->execute();

                            // Senão negativar o estoque, ele prossegue com a baixa
                            $sqlBaixaEstoque = "UPDATE reagentes SET quantidade = :novaQuantidade WHERE id_reagente = :id_reagente";
                            $stmtSqlBaixaEstoque = $this->PDO->prepare($sqlBaixaEstoque);
                            $stmtSqlBaixaEstoque->bindParam(":novaQuantidade", $novaQuantidade);
                            $stmtSqlBaixaEstoque->bindParam(":id_reagente", $reagentes[$i][0]);
                            $stmtSqlBaixaEstoque->execute();
                        }else{
                            // Se negativar o estoque, apagará o relatório
                            $sql = "DELETE FROM relatorios WHERE id_relatorio = :id_relatorio";
                            $stmt = $this->PDO->prepare($sql);
                            $stmt->bindParam(":id_relatorio", $id_relatorio);
                            $stmt->execute();
                            return ERRO_QUANTIDADE_REAGENTE;
                            exit;
                        }
                    }else{
                        // Se houver campos em branco, apagará o relatório
                        $sql = "DELETE FROM relatorios WHERE id_relatorio = :id_relatorio";
                        $stmt = $this->PDO->prepare($sql);
                        $stmt->bindParam(":id_relatorio", $id_relatorio);
                        $stmt->execute();
                        return QUANTIDADE_VAZIA;
                        exit;
                    }
                }

                // Prepara o SQL para informar os equipamentos e sua quantidade usada
                $sql = "INSERT INTO relatorios_equipamentos (id_relatorio, id_equipamento) VALUES (:id_relatorio, :id_equipamento)";
                $stmt = $this->PDO->prepare($sql);
                // Inicio do laço para iterar o array dos equipamentos
                for ($i=0; $i < count($equipamentos); $i++) { 
                    $stmt->bindParam(":id_relatorio", $id_relatorio);
                    $stmt->bindParam(":id_equipamento", $equipamentos[$i]);
                    $stmt->execute();
                }

                // Prepara o SQL para informar as vidrarias e sua quantidade usada
                $sql = "INSERT INTO relatorios_vidrarias (id_relatorio, id_vidraria) VALUES (:id_relatorio, :id_vidraria)";
                $stmt = $this->PDO->prepare($sql);
                // Inicio do laço para iterar o array das vidrarias
                for ($i=0; $i < count($vidrarias); $i++) { 
                    $stmt->bindParam(":id_relatorio", $id_relatorio);
                    $stmt->bindParam(":id_vidraria", $vidrarias[$i]);
                    $stmt->execute();
                }
                return RELATORIO_CATALOGADO;
            }else{
                return ERRO_GERAL;
            }

        }

        public function Search($filtro){
            $sql = "SELECT id_relatorio, DATE_FORMAT(data_hora, '%d/%m/%Y ás %Hh%imin') as data_hora, titulo, 
            u.nome as nome_professor, l.laboratorio AS laboratorio FROM relatorios r
            INNER JOIN usuarios u ON u.id_usuario = r.id_usuario
            INNER JOIN laboratorios l ON l.id_laboratorio = r.id_laboratorio WHERE titulo LIKE :filtro ORDER BY titulo ASC";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindValue(":filtro", "%$filtro%");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function Update($titulo, $aulas, $id_laboratorio, $data_hora, $descricao, $id_relatorio){
            // Edição do relatório
            $sql = "UPDATE relatorios SET id_laboratorio = :id_laboratorio, titulo = :titulo, data_hora = :data_hora, aulas = :aulas, descricao = :descricao WHERE id_relatorio = :id_relatorio";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindParam(":id_laboratorio", $id_laboratorio);
            $stmt->bindParam(":titulo", $titulo);
            $stmt->bindParam(":data_hora", $data_hora);
            $stmt->bindParam(":aulas", $aulas);
            $stmt->bindParam(":descricao", $descricao);
            $stmt->bindParam(":id_relatorio", $id_relatorio);
            return $stmt->execute() ? RELATORIO_ATUALIZADO : ERRO_GERAL;
        }

        public function Select(){
            // Pega todos os dados úteis relatorios cadastrados
            $sql = "SELECT id_relatorio, DATE_FORMAT(data_hora, '%d/%m/%Y ás %Hh%imin') as data_hora, titulo, 
            u.nome as nome_professor, l.laboratorio AS laboratorio FROM relatorios r
            INNER JOIN usuarios u ON u.id_usuario = r.id_usuario
            INNER JOIN laboratorios l ON l.id_laboratorio = r.id_laboratorio ORDER BY titulo ASC";
            $stmt = $this->PDO->query($sql);
            $stmt->execute();
            $dados = $stmt->fetchAll();

            $sqls = [
                [
                    "tabela" => "equipamento",
                    "sql" => "SELECT id_equipamento FROM relatorios_equipamentos WHERE id_relatorio = :id_relatorio"
                ],
                [
                    "tabela" => "reagente",
                    "sql" => "SELECT id_reagente FROM relatorios_reagentes WHERE id_relatorio = :id_relatorio"
                ],
                [
                    "tabela" => "vidraria",
                    "sql" => "SELECT id_vidraria FROM relatorios_vidrarias WHERE id_relatorio = :id_relatorio"
                ],
                [
                    "tabela" => "vidraria_quebrada",
                    "sql" => "SELECT id_vidraria FROM vidrarias_quebradas WHERE id_relatorio = :id_relatorio"
                ]
            ];
            // Com o array dos sqls, verifica se há registro de cada entidade, retornando 0 ou 1
            for ($u=0; $u < 4; $u++) { 
                for ($i=0; $i < count($dados); $i++) { 
                    $stmt = $this->PDO->prepare($sqls[$u]["sql"]);
                    $stmt->bindParam(":id_relatorio", $dados[$i]["id_relatorio"]);
                    $stmt->execute();
                    if($stmt->rowCount() > 0){
                        $dados[$i][$sqls[$u]["tabela"]] = 1;
                    }else{
                        $dados[$i][$sqls[$u]["tabela"]] = 0;
                    }
                }
            }
            return $dados;
        }

        public function ViewOne($id){
            // Seleciona os dados do relatorio como o seu titulo, tempo de aula, laboratorio etc...
            $sqlDados = "SELECT id_relatorio, titulo, aulas, id_laboratorio, data_hora, descricao FROM relatorios
            WHERE id_relatorio = :id";
            $stmt = $this->PDO->prepare($sqlDados);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $dados[] = $stmt->fetch(PDO::FETCH_ASSOC);

            /* Armazena os SQL num array que selecionará os
               equipamentos, reagentes, vidrarias e vidrarias
               quebradas do relatorio e aplica num loop
            */
            $sql[] = "SELECT e.nome FROM relatorios r
            INNER JOIN relatorios_equipamentos re ON r.id_relatorio = re.id_relatorio
            INNER JOIN equipamentos e ON re.id_equipamento = e.id_equipamento
            WHERE r.id_relatorio = :id";
            $sql[] = "SELECT re.quantidade_usada AS quantia, rg.medida, rg.nome FROM relatorios r
            INNER JOIN relatorios_reagentes re ON r.id_relatorio = re.id_relatorio
            INNER JOIN reagentes rg ON re.id_reagente = rg.id_reagente
            WHERE r.id_relatorio = :id";
            $sql[] = "SELECT e.nome FROM relatorios r
            INNER JOIN relatorios_vidrarias re ON r.id_relatorio = re.id_relatorio
            INNER JOIN vidrarias e ON re.id_vidraria = e.id_vidraria
            WHERE r.id_relatorio = :id";
            $sql[] = "SELECT v.nome, vq.quantidade_quebrada AS quantia FROM relatorios r
            INNER JOIN vidrarias_quebradas vq ON r.id_relatorio = vq.id_relatorio
            INNER JOIN vidrarias v ON v.id_vidraria = vq.id_vidraria
            WHERE r.id_relatorio = :id";

            for ($i=0; $i < count($sql); $i++) { 
                $stmt = $this->PDO->prepare($sql[$i]);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $dados[] = $stmt->fetchAll();
            }
            return $dados;
        }

        public function Delete($id_relatorio){
            /* Exclusão do relatório, as outras tabelas relacionais, já apaga os seus
             respectivos dados, pois as foreign keys estão configuradas com CASCADE*/
            $sql = "DELETE FROM relatorios WHERE id_relatorio = :id_relatorio AND id_usuario = :id_usuario";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindParam(":id_relatorio", $id_relatorio);
            $stmt->bindParam(":id_usuario", $_SESSION["id_usuario"]);
            if($stmt->execute()){
                return $stmt->rowCount() ? RELATORIO_DELETADO : RELATORIO_ERRO_RESPONSAVEL;
            }else{
                return ERRO_GERAL;
            }
        }
    }