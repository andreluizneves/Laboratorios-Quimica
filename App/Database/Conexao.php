<?php
    session_start();
    include("Responses.php");

    class Conexao {
        public $PDO;
        private $DRIVER = "mysql";
        private $HOST = "localhost";
        private $DATABASE = "laboratorios_quimica";
        private $USER = "root";
        private $PASSWORD = "root";

        public function __construct() {
            try{
                $this->PDO = new PDO("$this->DRIVER:host=$this->HOST;dbname=$this->DATABASE;charset=utf8", $this->USER, $this->PASSWORD);
            }catch(PDOException $e){
                echo("Erro durante a conexão: {$e->getMessage()}");
            }
        }

        public function VerificarUser(){
            if($_SESSION["tipo"] == "Professor(a)"){
                return 1;
            }else{
                return PERMISSAO_INVALIDA;
            }
        }

        public function getPhoto($id, $table){
            $sql = "SELECT foto FROM ".$table."s WHERE id_$table = :id";
            $stmt = $this->PDO->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)["foto"]; 
        }

        public function UploadPhoto($foto){
            $pasta = "fotos/";
            !file_exists("../$pasta") ? mkdir("../$pasta", 0755) : "";
            $nomeTemporario = $foto["tmp_name"];
            $nomeArquivo = $foto["name"];
            $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
            if($extensao == "jpg" || $extensao == "jpeg" || $extensao == "png"){
                $novoNome = uniqid(time()) . "." . $extensao;
                move_uploaded_file($nomeTemporario, "../$pasta$novoNome");
                return $novoNome;
            }else{
                return EXTENSAO_INVALIDA;
            }
        }

        public function RenderizarBotoes($id, $entidade){
            if($this->VerificarUser()){
                $btns = "<div class='botoes'>
                            <button id='$id' title='Editar' entidade='$entidade' class='btn btn-primary btn-edit'>Editar <i class='fas fa-pen'></i></button>
                            <button id='$id' title='Deletar' entidade='$entidade' class='btn btn-danger btn-delete'>Deletar <i class='fas fa-trash'></i></button>
                        </div>";
            }
            return $btns;
        }

        public function RenderizarBotoesVidrariaQuebrada($id){
            if($this->VerificarUser()){
                $btns = "<div class='botoes'>
                            <button id='$id' title='Editar' class='btn btn-primary btn-edit-vidraria-quebrada'>Editar <i class='fas fa-pen'></i></button>
                            <button id='$id' title='Deletar' entidade='vidrarias-quebradas' class='btn btn-danger btn-delete-vidraria-quebrada'>Deletar <i class='fas fa-trash'></i></button>
                        </div>";
            }
            return $btns;
        }
    }