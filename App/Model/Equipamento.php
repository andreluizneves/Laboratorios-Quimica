<?php

    class Equipamento extends Conexao{

        public function Insert($id_laboratorio, $nome, $patrimonio, $descricao, $foto){
            $nomeFoto = $this->UploadPhoto($foto);
            if($nomeFoto == EXTENSAO_INVALIDA){
                // Verifica se retorno o erro de extensão da função
                return EXTENSAO_INVALIDA;
            }else{
                // Executa o SQL
                $stmt = $this->PDO->prepare("INSERT INTO equipamentos (id_laboratorio, nome, patrimonio, descricao, foto) VALUES (:id_laboratorio, :nome, :patrimonio, :descricao, :foto)");
                $stmt->bindParam(":id_laboratorio", $id_laboratorio);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":patrimonio", $patrimonio);
                $stmt->bindParam(":descricao", $descricao);
                $stmt->bindParam(":foto", $nomeFoto);
                return $stmt->execute() ? EQUIPAMENTO_CATALOGADO : ERRO_GERAL;
            }
        }

        public function Search($filtro){
            $sql = "SELECT id_equipamento, nome, patrimonio, foto FROM equipamentos WHERE nome LIKE :filtro ORDER BY nome";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindValue(":filtro", "%$filtro%");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function Update($id_equipamento, $id_laboratorio, $nome, $patrimonio, $descricao, $foto){
            if(empty($foto["name"])){
                // Verifica se foi enviado uma foto e pega o nome da foto para o SQL do UPDATE
                $fotoNova = $this->getPhoto($id_equipamento, "equipamento");
            }else{
                // Pega o nome da foto antiga para o unlink e já faz o upload da nova foto
                $fotoAntiga = $this->getPhoto($id_equipamento, "equipamento");
                $fotoNova = $this->UploadPhoto($foto);
            }
            if($fotoNova == EXTENSAO_INVALIDA){
                // Verifica se retorno o erro de extensão da função
                return EXTENSAO_INVALIDA;
            }else{
                /* Confere se a variavel $fotoAntiga existe, pois ela é criada caso tenha
                 enviado uma foto, se verdadeiro, a fonto antiga é deletada do servidor*/
                isset($fotoAntiga) ? unlink("../../../src/equipamentos/fotos/$fotoAntiga") : "";
                $sql = "UPDATE equipamentos SET nome = :nome, patrimonio = :patrimonio, descricao = :descricao, id_laboratorio = :id_laboratorio, foto = :foto WHERE id_equipamento = :id_equipamento";
                $stmt = $this->PDO->prepare($sql);
                $stmt->bindParam(":id_laboratorio", $id_laboratorio);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":patrimonio", $patrimonio);
                $stmt->bindParam(":descricao", $descricao);
                $stmt->bindParam(":foto", $fotoNova);
                $stmt->bindParam(":id_equipamento", $id_equipamento);
                return $stmt->execute() ? EQUIPAMENTO_ATUALIZADO : ERRO_GERAL;
            }
        }

        public function Select(){
            $sql = "SELECT id_equipamento, nome, patrimonio, foto FROM equipamentos ORDER BY nome ASC";
            $stmt = $this->PDO->query($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function ViewOne($id){
            $stmt = $this->PDO->prepare("SELECT * FROM equipamentos WHERE id_equipamento = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function Delete($id){
            // SQL para verificar se há esse id em outra tabela relacional
            $sql = "SELECT id_relatorio_equipamento FROM equipamentos e INNER JOIN relatorios_equipamentos re ON e.id_equipamento = re.id_equipamento WHERE re.id_equipamento = :id";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            // Verifica se há relação com outro registro
            if($stmt->rowCount() > 0){
                return FK_DELETE;
            }else{
                // Se não estiver registrado em nenhum relatório, prossegue com a exclusão
                $foto = $this->getPhoto($id, "equipamento");
                $stmt = $this->PDO->prepare("DELETE FROM equipamentos WHERE id_equipamento = :id");
                $stmt->bindParam(":id", $id);
                if($stmt->execute()){
                    unlink("../../../src/equipamentos/fotos/$foto");
                    return EQUIPAMENTO_DELETADO;
                }
            }
        }
    }