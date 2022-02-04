<?php

    declare(strict_types=1);

    namespace App\Controllers;

    use App\Core\Controller;
    use App\Models\Glassware;
    use App\Utils\{
        Response,
        Session,
        File,
        Form
    };
    use PDO;

    /**
     * Classe herdada de Controller responsável por controlar as ações da Vidraira.
     * @author Mário Guilherme de Andrade Rodrigues
     */
    class GlasswareController extends Controller {
        private Glassware $model;

        /**
         * Método responsável de carregar a configuração do banco de dados e instanciar o modelo de Vidraria.
         * @return void
         */
        private function GetModel() : void {
            require __DIR__ . "/../Config/Connection.php";
            $this->model = new Glassware;
        }

        /**
         * Método responsável por retornar um array com todas as vidrarias.
         * @return array Vidrarias cadastradas
         */
        private function GetAll() : array {
            return $this->model::Select("", "", "name ASC", "id_glassware, name, photo")->fetchAll();
        }

        /**
         * Método responsável por retornar uma vidraria específica pelo seu ID.
         * @param int $id_glassware ID da vidraria
         * @return array Dados da vidraria
         */
        private function GetByID(int $id_glassware) : array {
            return $this->model::Select("", "id_glassware = ?", "", "*", [$id_glassware])->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * Método responsável por retornar a(s) vidraria(s) específica(s) pelo seu nome.
         * @param string $name Nome da(s) vidraria(s)
         * @return array Vidraria(s)
         */
        private function GetByName(string $name) : array {
            return $this->model::Select("", "name LIKE ?", "name ASC", "id_glassware, name, photo", [$name])->fetchAll();
        }

        /**
         * Método responsável por carregar a View da tela principal de vidrarias.
         * @return void
         */
        public function Index() : void {
            if(!Session::IsEmptySession()) {
                $data = [
                    "icon" => "glassworks",
                    "title" => "Vidrarias",
                    "entity" => "glassware",
                    "buttons"=> $this->RenderButtons(4),
                    "jumbotron" => "Vidrarias",
                    "search" => "Vidrarias",
                    "label" => "Vidrarias"
                ];
                $this->View("Page/structure", $data);
            } else
                Session::Redirect("/");
        }

        /**
         * Método responsável por renderizar todas as vidrarias.
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
         * Método responsável por renderizar o modal de uma vidraria específica pelo seu ID.
         * @param int $id_glassware ID da vidraria
         * @return void
         */
        public function ViewByID(int $id_glassware) : void {
            if(!Session::IsEmptySession()) {
                $this->GetModel();
                $data = $this->GetByID($id_glassware);
                $this->View("Glassware/Components/modal", $data);
            } else
                Response::Message(SESSION_EMPTY);
        }

        /**
         * Método responsável por renderizar a(s) vidrarias(s) específica(s) pelo seu nome.
         * @param string $search Nome da(s) vidraria(s)
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
         * Método responsável por cadastrar uma vidraria.
         * @param array $form Dados do formulário
         * @param array $photo Dados da foto
         * @return void
         */
        public function New(array $form, array $photo) : void {
            if(Session::IsAdmin()) {
                // LIMPA OS CAMPOS
                $laboratory = (int) Form::SanatizeField($form["laboratory"], FILTER_SANITIZE_STRING);
                $name = Form::SanatizeField($form["name"], FILTER_SANITIZE_STRING);
                $quantity = (int) Form::SanatizeField($form["quantity"], FILTER_SANITIZE_NUMBER_INT);
                $description = Form::SanatizeField($form["description"], FILTER_SANITIZE_STRING);

                // VERIFICA CAMPOS VAZIOS, VALIDA A QUANTIDADE E O LABORATÓRIO
                Form::VerifyEmptyFields([$laboratory, $name, $quantity, $description]);
                Form::ValidateQuantityInt($quantity);
                Form::ValidateLaboratory($laboratory);

                // FAZ O UPLOAD DO ARQUIVO E EM SEGUIDA REALIZA O INSERT
                File::SetFile($photo);
                if(File::$name != ERROR_UPLOAD) {
                    $this->GetModel();
                    $this->model::Insert([
                        "id_laboratory" => $laboratory,
                        "name" => $name,
                        "quantity" => $quantity,
                        "description" => $description,
                        "photo" => File::MoveFile()
                    ]);
                    Response::Message(GLASSWARE_CREATED);
                } else
                    Response::Message(ERROR_UPLOAD);
            } else
                Response::Message(INVALID_PERMISSION);
        }

        /**
         * Método responsável por atualizar uma vidraria específica pelo seu ID.
         * @param array $form Dados do formulário
         * @param array $photo Dados da foto
         * @return void
         */
        public function Update(array $form, array $photo) : void {
            if(Session::IsAdmin()) {
                // LIMPA OS CAMPOS
                $id_glassware = (int) Form::SanatizeField($form["id"], FILTER_SANITIZE_STRING);
                $laboratory = (int) Form::SanatizeField($form["laboratory"], FILTER_SANITIZE_STRING);
                $name = Form::SanatizeField($form["name"], FILTER_SANITIZE_STRING);
                $quantity = (int) Form::SanatizeField($form["quantity"], FILTER_SANITIZE_NUMBER_INT);
                $description = Form::SanatizeField($form["description"], FILTER_SANITIZE_STRING);

                // VERIFICA CAMPOS VAZIOS, VALIDA O ID DA VIDRARIA, A QUANTIDADE O E LABORATÓRIO
                Form::VerifyEmptyFields([$laboratory, $name, $quantity, $description]);
                Form::ValidateID($id_glassware);
                Form::ValidateQuantityInt($quantity);
                Form::ValidateLaboratory($laboratory);

                // OBTÊM O MODEL E VERIFICA SE FOI ENVIADO UMA FOTO
                $this->GetModel();
                if($photo["name"] != "") {
                    File::SetFile($photo);
                    if(File::$name != ERROR_UPLOAD) {
                        $values = [
                            "id_laboratory" => $laboratory,
                            "name" => $name,
                            "quantity" => $quantity,
                            "description" => $description,
                            "photo" => File::MoveFile()
                        ];
                        // DELETA A FOTO ANTIGA
                        $ancientPhoto = $this->GetByID($id_glassware)["photo"];
                        File::DeleteFile($ancientPhoto);
                    } else
                        Response::Message(ERROR_UPLOAD);
                } else {
                    $values = [
                        "id_laboratory" => $laboratory,
                        "name" => $name,
                        "quantity" => $quantity,
                        "description" => $description
                    ];
                }
                $this->model::Update("id_glassware = $id_glassware", $values);
                Response::Message(GLASSWARE_UPDATED);
            } else
                Response::Message(INVALID_PERMISSION);
        }

        /**
         * Método responsável por deletar uma vidraria específica pelo seu ID.
         * @param int $id_glassware ID da vidraria
         * @return void
         */
        public function Delete(int $id_glassware) : void {
            if(Session::IsAdmin()) {
                // LIMPA O CAMPO DE ID E O VALIDA
                $id_glassware = (int) Form::SanatizeField((string) $id_glassware, FILTER_SANITIZE_STRING);
                Form::ValidateID($id_glassware);

                // OBTÊM O MODEL E EM SEGUIDA DELETA A VIDRARIA
                $this->GetModel();
                $photo = $this->GetByID($id_glassware)["photo"];
                $this->model::Delete("id_glassware = ?", [$id_glassware]);

                // DELETA A FOTO ANTIGA
                File::DeleteFile($photo);
                Response::Message(GLASSWARE_DELETED);
            } else
                Response::Message(INVALID_PERMISSION);
        }
    }