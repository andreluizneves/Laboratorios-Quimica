<?php

    class VidrariaQuebrada extends Conexao{

        public function Insert($id_vidraria, $id_relatorio, $quantidade){
            // SQL para inserção de dados
            $sql = "INSERT INTO vidrarias_quebradas (id_vidraria, id_relatorio, quantidade_quebrada) VALUES (:id_vidraria, :id_relatorio, :quantidade)";
            $add = $this->PDO->prepare($sql);
            $add->bindParam(":id_vidraria", $id_vidraria);
            $add->bindParam(":id_relatorio", $id_relatorio);
            $add->bindParam(":quantidade", $quantidade);

            // Coleta a quantia em estoque para a futura baixa
            $sql = "SELECT quantidade FROM vidrarias WHERE id_vidraria = :id_vidraria";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindParam(":id_vidraria", $id_vidraria);
            $stmt->execute();
            $minuendo = $stmt->fetch(PDO::FETCH_ASSOC)["quantidade"];
            $quantidadeNova = $minuendo - $quantidade;
            if($quantidadeNova < 0){
                return VIDRARIA_ERRO_QUANTIDADE;
            }else{
                if($add->execute()){
                    // Finaliza com o UPDATE com a quantia reduzida
                    $sql = "UPDATE vidrarias SET quantidade = :quantidade WHERE id_vidraria = :id_vidraria";
                    $stmt = $this->PDO->prepare($sql);
                    $stmt->bindParam(":quantidade", $quantidadeNova);
                    $stmt->bindParam(":id_vidraria", $id_vidraria);
                    return $stmt->execute() ? VIDRARIA_QUEBRADA_CATALOGADA : ERRO_GERAL;
                }else{
                    return ERRO_GERAL;
                }
            }
        }

        public function Search($filtro){
            $sql = "SELECT id_vidraria_quebrada, nome, r.titulo, foto FROM vidrarias_quebradas vq INNER JOIN vidrarias v ON vq.id_vidraria = v.id_vidraria INNER JOIN relatorios r ON vq.id_relatorio = r.id_relatorio WHERE nome LIKE :filtro ORDER BY r.titulo";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindValue(":filtro", "%$filtro%");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function Update($id_vidraria_quebrada, $id_vidraria, $id_relatorio, $quantidade){
            // Consulta inicial para comparar o id da vidriara e a sua quantidade em estoque restante
            $sql = "SELECT id_vidraria, quantidade_quebrada FROM vidrarias_quebradas WHERE id_vidraria_quebrada = :id_vidraria_quebrada";
            $sql = $this->PDO->prepare($sql);
            $sql->bindParam(":id_vidraria_quebrada", $id_vidraria_quebrada);
            $sql->execute();
            $dadosBanco = $sql->fetch(PDO::FETCH_ASSOC);

            // Realiza a comparação do id da vidraria banco com id da vidraria recebida
            if($dadosBanco["id_vidraria"] == $id_vidraria){
                $sql = "SELECT quantidade FROM vidrarias WHERE id_vidraria = :id_vidraria";
                $stmt = $this->PDO->prepare($sql);
                $stmt->bindParam(":id_vidraria", $id_vidraria);
                $stmt->execute();

                // Criar variaveis para armazenar as quantidades restantes, totais e usadas
                $quantiaRestante = $stmt->fetch(PDO::FETCH_ASSOC)["quantidade"];
                $quantiaTotal = $quantiaRestante + $dadosBanco["quantidade_quebrada"];
                $novaQuantiaRestante = $quantiaTotal - $quantidade;

                // Compara a quantidade recebida com a quantidade total para nao haver numero negativo
                if($quantidade <= $quantiaTotal){
                    // Faz o update na tabela vidrarias_quebradas com os valores recebidos
                    $sql = "UPDATE vidrarias_quebradas SET id_vidraria = :id_vidraria, id_relatorio = :id_relatorio, quantidade_quebrada = :quantidade WHERE id_vidraria_quebrada = :id_vidraria_quebrada";
                    $stmt = $this->PDO->prepare($sql);
                    $stmt->bindParam(":id_vidraria", $id_vidraria);
                    $stmt->bindParam(":id_relatorio", $id_relatorio);
                    $stmt->bindParam(":quantidade", $quantidade);
                    $stmt->bindParam(":id_vidraria_quebrada", $id_vidraria_quebrada);

                    if($stmt->execute()){
                        // Faz o update na tabela vidrarias com as quantias corrigidas
                        $sql = "UPDATE vidrarias SET quantidade = :quantidade WHERE id_vidraria = :id_vidraria";
                        $stmt = $this->PDO->prepare($sql);
                        $stmt->bindParam(":quantidade", $novaQuantiaRestante);
                        $stmt->bindParam(":id_vidraria", $id_vidraria);
                        return $stmt->execute() ? VIDRARIA_QUEBRADA_ATUALIZADA : ERRO_GERAL;
                    }else{
                        return ERRO_GERAL;
                    }
                }else{
                    return VIDRARIA_ERRO_QUANTIDADE;
                }
            }else{
                // Coleta a quatidade do banco de dados da vidraria recebida
                $sql = "SELECT quantidade FROM vidrarias WHERE id_vidraria = :id_vidraria";
                $stmt = $this->PDO->prepare($sql);
                $stmt->bindParam(":id_vidraria", $dadosBanco["id_vidraria"]);
                $stmt->execute();

                // Cria as variaveis para armazenar as quantidades restantes e as totais
                $quantiaRestante = $stmt->fetch(PDO::FETCH_ASSOC)["quantidade"];
                $quantiaTotal = $quantiaRestante + $dadosBanco["quantidade"];

                // Corrige a quantidade da vidraria para o seu valor antigo
                $sql = "UPDATE vidrarias SET quantidade = :quantidade WHERE id_vidraria = :id_vidraria";
                $stmt = $this->PDO->prepare($sql);
                $stmt->bindParam(":quantidade", $quantiaTotal);
                $stmt->bindParam(":id_vidraria", $dadosBanco["id_vidraria"]);
            
                $sql = "SELECT quantidade FROM vidrarias WHERE id_vidraria = :id_vidraria";
                $add = $this->PDO->prepare($sql);
                $add->bindParam(":id_vidraria", $id_vidraria);
                $add->execute();

                // Cria as variaveis para armazenar as quantidades restantes e as totais
                $minuendo = $add->fetch(PDO::FETCH_ASSOC)["quantidade"];
                $quantidadeNova = $minuendo - $quantidade;

                if($quantidadeNova < 0){
                    return VIDRARIA_ERRO_QUANTIDADE;
                }else{
                    if($add->execute()){
                        // Atualiza a tabela vidrarias com a nova quantidade corrigida
                        $sql = "UPDATE vidrarias SET quantidade = :quantidade WHERE id_vidraria = :id_vidraria";
                        $stmt = $this->PDO->prepare($sql);
                        $stmt->bindParam(":quantidade", $quantidadeNova);
                        $stmt->bindParam(":id_vidraria", $id_vidraria);

                        if($stmt->execute()){
                            /* Atualiza a tabela vidrarias_quebradas com os
                             valores recebidos incluindo quantidade e vidraria corrigida*/
                            $sql = "UPDATE vidrarias_quebradas SET id_vidraria = :id_vidraria, id_relatorio = :id_relatorio, quantidade_quebrada = :quantidade WHERE id_vidraria_quebrada = :id_vidraria_quebrada";
                            $stmt = $this->PDO->prepare($sql);
                            $stmt->bindParam(":id_vidraria", $id_vidraria);
                            $stmt->bindParam(":id_relatorio", $id_relatorio);
                            $stmt->bindParam(":quantidade", $quantidade);
                            $stmt->bindParam(":id_vidraria_quebrada", $id_vidraria_quebrada);
                            return $stmt->execute() ? VIDRARIA_QUEBRADA_ATUALIZADA : ERRO_GERAL;
                        }else{
                            return ERRO_GERAL;
                    }
                    }else{
                        return ERRO_GERAL;
                    }
                }
            }
        }

        public function Select(){  
            $sql = "SELECT id_vidraria_quebrada, nome, r.titulo, foto FROM vidrarias_quebradas vq INNER JOIN vidrarias v ON vq.id_vidraria = v.id_vidraria INNER JOIN relatorios r ON vq.id_relatorio = r.id_relatorio ORDER BY r.titulo";
            $stmt = $this->PDO->query($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function ViewOne($id){
            $sql = "SELECT id_vidraria_quebrada, vq.id_vidraria, r.id_relatorio, nome, vq.quantidade_quebrada, l.laboratorio, foto FROM vidrarias_quebradas vq INNER JOIN vidrarias v ON vq.id_vidraria = v.id_vidraria INNER JOIN relatorios r ON vq.id_relatorio = r.id_relatorio INNER JOIN laboratorios l ON r.id_laboratorio = l.id_laboratorio WHERE id_vidraria_quebrada = :id";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        public function Delete($id){
            $sql = "SELECT id_vidraria, quantidade_quebrada FROM vidrarias_quebradas WHERE id_vidraria_quebrada = :id_vidraria_quebrada";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindParam(":id_vidraria_quebrada", $id);
            $stmt->execute();
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            // Seleciona a quantia quebrada e o id da vidraria para tornar seu antigo valor
            $id_vidraria = $dados["id_vidraria"];
            $parcela1 = $dados["quantidade_quebrada"];

            $sql = "SELECT quantidade FROM vidrarias WHERE id_vidraria = :id_vidraria";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindParam(":id_vidraria", $id_vidraria);
            $stmt->execute();
            $parcela2 = $stmt->fetch(PDO::FETCH_ASSOC)["quantidade"];
            // seleciona a quantia em estoque da vidraria e faz a soma
            $quantidade = $parcela1 + $parcela2;

            $stmt = $this->PDO->prepare("DELETE FROM vidrarias_quebradas WHERE id_vidraria_quebrada = :id_vidraria_quebrada");
            $stmt->bindParam(":id_vidraria_quebrada", $id);
            if($stmt->execute()){
                // Deleta o registra de vidraria quebrada e atualiza a sua nova quantia
                $sql = "UPDATE vidrarias SET quantidade = :quantidade WHERE id_vidraria = :id_vidraria";
                $stmt = $this->PDO->prepare($sql);
                $stmt->bindParam(":quantidade", $quantidade);
                $stmt->bindParam(":id_vidraria", $id_vidraria);
                return $stmt->execute() ? VIDRARIA_QUEBRADA_DELETADA : ERRO_GERAL;
            }else{
                return ERRO_GERAL;
            }
        }
    }