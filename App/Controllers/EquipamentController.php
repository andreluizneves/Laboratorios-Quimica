<?php

    declare(strict_types=1);

    namespace App\Controllers;

    use App\Core\Controller;
    use App\Models\Equipament;
    use App\Utils\{
        Response,
        Session,
        File,
        Form
    };
    use PDO;

    /**
     * Classe herdada de Controller responsável por controlar as ações do Equipamento.
     * @author Mário Guilherme de Andrade Rodrigues
     */
    class EquipamentController extends Controller {
        private Equipament $model;

        /**
         * Método responsável de carregar a configuração do banco de dados e instanciar o modelo de Equipamento.
         * @return void
         */
        private function GetModel() : void {
            require __DIR__ . "/../Config/Connection.php";
            $this->model = new Equipament;
        }

        /**
         * Método responsável por retornar um array com todos os equipamentos.
         * @return array Equipamentos cadastrados
         */
        private function GetAll() : array {
            return $this->model::Select("", "", "name ASC", "id_equipament, name, photo")->fetchAll();
        }

        /**
         * Método responsável por retornar um equipamento específico pelo seu ID.
         * @param int $id_equipament ID do equipamento
         * @return array Dados do equipamento
         */
        private function GetByID(int $id_equipament) : array {
            return $this->model::Select("", "id_equipament = ?", "", "*", [$id_equipament])->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * Método responsável por retornar o(s) equipamento(s) específico(s) pelo seu nome.
         * @param string $name Nome do(s) equipamento(s)
         * @return array Equipamento(s)
         */
        private function GetByName(string $name) : array {
            return $this->model::Select("", "name LIKE ?", "name ASC", "id_equipament, name, photo", [$name])->fetchAll();
        }

        /**
         * Método responsável por carregar a View da tela principal de equipamentos.
         * @return void
         */
        public function Index() : void {
            if(!Session::IsEmptySession()) {
                $data = [
                    "icon" => "equipament",
                    "title" => "Equipamentos",
                    "entity" => "equipament",
                    "buttons"=> $this->RenderButtons(1),
                    "jumbotron" => "Equipamentos",
                    "search" => "Equipamentos",
                    "label" => "Equipamentos"
                ];
                $this->View("Page/structure", $data);
            } else
                Session::Redirect("/");
        }

        /**
         * Método responsável por renderizar todos os equipamentos.
         * @return void
         */
        public function List() : void {
            if(!Session::IsEmptySession()) {
                $this->GetModel();
                $data = $this->GetAll();
                if(!empty($data)) {
                    foreach ($data as $row) {
                        require __DIR__ . "/../Views/Page/Components/card.php";
                    }
                } else
                    die(NOTHING_FOUND);
            } else
                Response::Message(SESSION_EMPTY);
        }

        /**
         * Método responsável por renderizar o modal de um equipamento específico pelo seu ID.
         * @param int $id_equipament ID do equipamento
         * @return void
         */
        public function ViewByID(int $id_equipament) : void {
            if(!Session::IsEmptySession()) {
                $this->GetModel();
                $data = $this->GetByID($id_equipament);
                $this->View("Equipament/Components/modal", $data);
            } else
                Response::Message(SESSION_EMPTY);
        }

        /**
         * Método responsável por renderizar o(s) equipamento(s) específico(s) pelo seu nome.
         * @param string $search Nome do(s) equipamento(s)
         * @return void
         */
        public function Search(string $search) : void {
            if(!Session::IsEmptySession()) {
                // LIMPA O NOME E PREPARA O NOME PARA SER UTILIZADO NA BUSCA
                $search = "%" . Form::SanatizeField($search, FILTER_SANITIZE_STRING) . "%";
                $this->GetModel();
                $data = $this->GetByName($search);
                if(!empty($data)) {
                    foreach ($data as $row) {
                        require __DIR__ . "/../Views/Page/Components/card.php";
                    }
                } else
                    die(NOTHING_FOUND);
            } else
                Response::Message(SESSION_EMPTY);
        }

        /**
         * Método responsável por cadastrar um equipamento.
         * @param array $form Dados do formulário
         * @param array $photo Dados da foto
         * @return void
         */
        public function New(array $form, array $photo) : void {
            if(Session::IsAdmin()) {
                // LIMPA OS CAMPOS
                $laboratory = (int) Form::SanatizeField($form["laboratory"], FILTER_SANITIZE_STRING);
                $name = Form::SanatizeField($form["name"], FILTER_SANITIZE_STRING);
                $patrimony = (int) Form::SanatizeField($form["patrimony"], FILTER_SANITIZE_NUMBER_INT);
                $description = Form::SanatizeField($form["description"], FILTER_SANITIZE_STRING);

                // VERIFICA CAMPOS VAZIOS, VALIDA O PATRIMÔNIO E LABORATÓRIO
                Form::VerifyEmptyFields([$laboratory, $name, $patrimony, $description]);
                Form::ValidatePatrimony($patrimony);
                Form::ValidateLaboratory($laboratory);

                // FAZ O UPLOAD DO ARQUIVO E EM SEGUIDA REALIZA O INSERT
                File::SetFile($photo);
                if(File::$name != ERROR_UPLOAD) {
                    $this->GetModel();
                    $this->model::Insert([
                        "id_laboratory" => $laboratory,
                        "name" => $name,
                        "patrimony" => $patrimony,
                        "description" => $description,
                        "photo" => File::MoveFile()
                    ]);
                    Response::Message(EQUIPAMENT_CREATED);
                } else
                    Response::Message(ERROR_UPLOAD);
            } else
                Response::Message(INVALID_PERMISSION);
        }

        /**
         * Método responsável por atualizar um equipamento específico pelo seu ID.
         * @param array $form Dados do formulário
         * @param array $photo Dados da foto
         * @return void
         */
        public function Update(array $form, array $photo) : void {
            if(Session::IsAdmin()) {
                // LIMPA OS CAMPOS
                $id_equipament = (int) Form::SanatizeField($form["id"], FILTER_SANITIZE_STRING);
                $laboratory = (int) Form::SanatizeField($form["laboratory"], FILTER_SANITIZE_STRING);
                $name = Form::SanatizeField($form["name"], FILTER_SANITIZE_STRING);
                $patrimony = (int) Form::SanatizeField($form["patrimony"], FILTER_SANITIZE_NUMBER_INT);
                $description = Form::SanatizeField($form["description"], FILTER_SANITIZE_STRING);

                // VERIFICA CAMPOS VAZIOS, VALIDA O ID DO EQUIPAMENTO, O PATRIMÔNIO E O LABORATÓRIO
                Form::VerifyEmptyFields([$laboratory, $name, $patrimony, $description]);
                Form::ValidateID($id_equipament);
                Form::ValidatePatrimony($patrimony);
                Form::ValidateLaboratory($laboratory);

                // OBTÊM O MODEL E VERIFICA SE FOI ENVIADO UMA FOTO
                $this->GetModel();
                if($photo["name"] != "") {
                    File::SetFile($photo);
                    if(File::$name != ERROR_UPLOAD) {
                        $values = [
                            "id_laboratory" => $laboratory,
                            "name" => $name,
                            "patrimony" => $patrimony,
                            "description" => $description,
                            "photo" => File::MoveFile()
                        ];

                        // DELETA A FOTO ANTIGA
                        $ancientPhoto = $this->GetByID($id_equipament)["photo"];
                        File::DeleteFile($ancientPhoto);
                    } else
                        Response::Message(ERROR_UPLOAD);
                } else {
                    $values = [
                        "id_laboratory" => $laboratory,
                        "name" => $name,
                        "patrimony" => $patrimony,
                        "description" => $description
                    ];
                }
                $this->model::Update("id_equipament = $id_equipament", $values);
                Response::Message(EQUIPAMENT_UPDATED);
            } else
                Response::Message(INVALID_PERMISSION);
        }

        /**
         * Método responsável por deletar um equipamento específico pelo seu ID.
         * @param int $id_equipament ID do equipamento
         * @return void
         */
        public function Delete(int $id_equipament) : void {
            if(Session::IsAdmin()) {
                // LIMPA O CAMPO DE ID E O VALIDA
                $id_equipament = (int) Form::SanatizeField((string) $id_equipament, FILTER_SANITIZE_STRING);
                Form::ValidateID($id_equipament);

                // OBTÊM O MODEL E EM SEGUIDA DELETA O EQUIPAMENTO
                $this->GetModel();
                $photo = $this->GetByID($id_equipament)["photo"];
                $this->model::Delete("id_equipament = ?", [$id_equipament]);

                // DELETA A FOTO ANTIGA
                File::DeleteFile($photo);
                Response::Message(EQUIPAMENT_DELETED);
            } else
                Response::Message(INVALID_PERMISSION);
        }
    }