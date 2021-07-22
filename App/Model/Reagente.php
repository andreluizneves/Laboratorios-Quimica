<?php

    class Reagente extends Conexao{

        // As mesmas instruções feitas no modelo do equipamento, se repete nos reagentes
        public function Insert($id_laboratorio, $nome, $medida, $quantidade, $foto){
            $nomeFoto = $this->UploadPhoto($foto);
            if($nomeFoto == EXTENSAO_INVALIDA){
                return EXTENSAO_INVALIDA;
            }else{
                $stmt = $this->PDO->prepare("INSERT INTO reagentes (id_laboratorio, nome, medida, quantidade, foto) VALUES (:id_laboratorio, :nome, :medida, :quantidade, :foto)");
                $stmt->bindParam(":id_laboratorio", $id_laboratorio);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":medida", $medida);
                $stmt->bindParam(":quantidade", $quantidade);
                $stmt->bindParam(":foto", $nomeFoto);
                return $stmt->execute() ? REAGENTE_CATALOGADO : ERRO_GERAL;
            }
        }

        public function Search($filtro){
            $sql = "SELECT * FROM reagentes WHERE nome LIKE :filtro ORDER BY nome";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindValue(":filtro", "%$filtro%");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function Update($id_reagente, $id_laboratorio, $nome, $medida, $quantidade, $foto){
            if(empty($foto["name"])){
                $fotoNova = $this->getPhoto($id_reagente, "reagente");
            }else{
                $fotoAntiga = $this->getPhoto($id_reagente, "reagente");
                $fotoNova = $this->UploadPhoto($foto);
            }
            if($fotoNova == EXTENSAO_INVALIDA){
                return EXTENSAO_INVALIDA;
            }else{
                isset($fotoAntiga) ? unlink("../../../src/reagentes/fotos/$fotoAntiga") : "";
                $sql = "UPDATE reagentes SET nome = :nome, medida = :medida, quantidade = :quantidade, id_laboratorio = :id_laboratorio, foto = :foto WHERE id_reagente = :id_reagente";
                $stmt = $this->PDO->prepare($sql);
                $stmt->bindParam(":id_laboratorio", $id_laboratorio);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":medida", $medida);
                $stmt->bindParam(":quantidade", $quantidade);
                $stmt->bindParam(":foto", $fotoNova);
                $stmt->bindParam(":id_reagente", $id_reagente);
                return $stmt->execute() ? REAGENTE_ATUALIZADO : ERRO_GERAL;
            }
        }

        public function Select(){
            $sql = "SELECT * FROM reagentes ORDER BY nome ASC";
            $stmt = $this->PDO->query($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function ViewOne($id){
            $stmt = $this->PDO->prepare("SELECT * FROM reagentes WHERE id_reagente = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        public function Delete($id){
            $sql = "SELECT id_relatorio_reagente FROM reagentes r INNER JOIN relatorios_reagentes rr ON r.id_reagente = rr.id_reagente WHERE r.id_reagente = :id";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return FK_DELETE;
            }else{
                $foto = $this->getPhoto($id, "reagente");
                $stmt = $this->PDO->prepare("DELETE FROM reagentes WHERE id_reagente = :id");
                $stmt->bindParam(":id", $id);
                if($stmt->execute()){
                    unlink("../../../src/reagentes/fotos/$foto");
                    return REAGENTE_DELETADO;
                }
            }
        }
    }