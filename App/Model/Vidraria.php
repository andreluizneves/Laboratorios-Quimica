<?php

    class Vidraria extends Conexao{

        // As mesmas instruções feitas no modelo do equipamento, se repete nos reagentes
        public function Insert($id_laboratorio, $nome, $quantidade, $descricao, $foto){
            $nomeFoto = $this->UploadPhoto($foto);
            if($nomeFoto == EXTENSAO_INVALIDA){
                return EXTENSAO_INVALIDA;
            }else{
                $stmt = $this->PDO->prepare("INSERT INTO vidrarias (id_laboratorio, nome, quantidade, descricao, foto) VALUES (:id_laboratorio, :nome, :quantidade, :descricao, :foto)");
                $stmt->bindParam(":id_laboratorio", $id_laboratorio);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":quantidade", $quantidade);
                $stmt->bindParam(":descricao", $descricao);
                $stmt->bindParam(":foto", $nomeFoto);
                return $stmt->execute() ? VIDRARIA_CATALOGADA : $stmt->errorInfo();
            }
        }

        public function Search($filtro){
            $sql = "SELECT id_vidraria, nome, quantidade, foto FROM vidrarias WHERE nome LIKE :filtro ORDER BY nome";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindValue(":filtro", "%$filtro%");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function Update($id_vidraria, $id_laboratorio, $nome, $quantidade, $descricao, $foto){
            if(empty($foto["name"])){
                $fotoNova = $this->getPhoto($id_vidraria, "vidraria");
            }else{
                $fotoAntiga = $this->getPhoto($id_vidraria, "vidraria");
                $fotoNova = $this->UploadPhoto($foto);
            }
            if($fotoNova == EXTENSAO_INVALIDA){
                return $fotoNova;
            }else{
                isset($fotoAntiga) ? unlink("../../../src/vidrarias/fotos/$fotoAntiga") : "";
                $sql = "UPDATE vidrarias SET nome = :nome, quantidade = :quantidade, descricao = :descricao, id_laboratorio = :id_laboratorio, foto = :foto WHERE id_vidraria = :id_vidraria";
                $stmt = $this->PDO->prepare($sql);
                $stmt->bindParam(":id_laboratorio", $id_laboratorio);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":quantidade", $quantidade);
                $stmt->bindParam(":descricao", $descricao);
                $stmt->bindParam(":foto", $fotoNova);
                $stmt->bindParam(":id_vidraria", $id_vidraria);
                return $stmt->execute() ? VIDRARIA_ATUALIZADA : ERRO_GERAL;
            }
        }

        public function Select(){
            $sql = "SELECT id_vidraria, nome, quantidade, foto FROM vidrarias ORDER BY nome ASC";
            $stmt = $this->PDO->query($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function ViewOne($id){
            $stmt = $this->PDO->prepare("SELECT id_vidraria, id_laboratorio, nome, quantidade, descricao, foto FROM vidrarias WHERE id_vidraria = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        public function Delete($id){
            $sql = "SELECT id_relatorio_vidraria FROM vidrarias v INNER JOIN relatorios_vidrarias rv ON v.id_vidraria = rv.id_vidraria WHERE rv.id_vidraria = :id";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return FK_DELETE;
            }else{    
                $foto = $this->getPhoto($id, "vidraria");
                $stmt = $this->PDO->prepare("DELETE FROM vidrarias WHERE id_vidraria = :id");
                $stmt->bindParam(":id", $id);
                if($stmt->execute()){
                    unlink("../../../src/vidrarias/fotos/$foto");
                    return VIDRARIA_DELETADA;
                }
            }
        }
    }