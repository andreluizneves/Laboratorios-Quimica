<?php

    declare(strict_types=1);

    namespace App\Controllers;

    use App\Core\Controller;
    use App\Models\Reagent;
    use App\Utils\{
        Response,
        Session,
        File,
        Form
    };
    use PDO;

    /**
     * Classe herdada de Controller responsável por controlar as ações do Reagente.
     * @author Mário Guilherme de Andrade Rodrigues
     */
    class ReagentController extends Controller {
        private Reagent $model;

        /**
         * Método responsável de carregar a configuração do banco de dados e instanciar o modelo de Reagente.
         * @return void
         */
        private function GetModel() : void {
            require __DIR__ . "/../Config/Connection.php";
            $this->model = new Reagent;
        }

        /**
         * Método responsável por retornar um array com todos os reagentes.
         * @return array Reagentes cadastrados
         */
        private function GetAll() : array {
            return $this->model::Select("", "", "name ASC", "id_reagent, name, photo")->fetchAll();
        }

        /**
         * Método responsável por retornar um reagente específico pelo seu ID.
         * @param int $id_reagent ID do reagente
         * @return array Dados do reagente
         */
        private function GetByID(int $id_reagent) : array {
            return $this->model::Select("", "id_reagent = ?", "", "*", [$id_reagent])->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * Método responsável por retornar o(s) reagente(s) específico(s) pelo seu nome.
         * @param string $name Nome do(s) reagente(s)
         * @return array Reagente(s)
         */
        private function GetByName(string $name) : array {
            return $this->model::Select("", "name LIKE ?", "name ASC", "id_reagent, name, photo", [$name])->fetchAll();
        }

        /**
         * Método responsável por carregar a View da tela principal de reagentes.
         * @return void
         */
        public function Index() : void {
            if(!Session::IsEmptySession()) {
                $data = [
                    "icon" => "reagents",
                    "title" => "Reagentes",
                    "entity" => "reagent",
                    "buttons"=> $this->RenderButtons(2),
                    "jumbotron" => "Reagentes",
                    "search" => "Reagentes",
                    "label" => "Reagentes"
                ];
                $this->View("Page/structure", $data);
            } else
                Session::Redirect("/");
        }

        /**
         * Método responsável por renderizar todos os reagentes.
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
         * Método responsável por renderizar o modal de um reagente específico pelo seu ID.
         * @param int $id_reagent ID do reagente
         * @return void
         */
        public function ViewByID(int $id_reagent) : void {
            if(!Session::IsEmptySession()) {
                $this->GetModel();
                $data = $this->GetByID($id_reagent);
                $this->View("Reagent/Components/modal", $data);
            } else
                Response::Message(SESSION_EMPTY);
        }

        /**
         * Método responsável por renderizar o(s) reagente(s) específico(s) pelo seu nome.
         * @param string $search Nome do(s) reagente(s)
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
         * Método responsável por cadastrar um reagente.
         * @param array $form Dados do formulário
         * @param array $photo Dados da foto
         * @return void
         */
        public function New(array $form, array $photo) : void {
            if(Session::IsAdmin()) {
                // LIMPA OS CAMPOS
                $laboratory = (int) Form::SanatizeField($form["laboratory"], FILTER_SANITIZE_STRING);
                $name = Form::SanatizeField($form["name"], FILTER_SANITIZE_STRING);
                $measure = Form::SanatizeField($form["measure"], FILTER_SANITIZE_STRING);
                $quantity = (float) Form::SanatizeField(str_replace(",", ".", $form["quantity"]), FILTER_SANITIZE_STRING);

                // VERIFICA CAMPOS VAZIOS, VALIDA UNIDADE DE MEDIDA, QUANTIDADE E LABORATÓRIO
                Form::VerifyEmptyFields([$laboratory, $name, $measure, $quantity]);
                Form::ValidateMeasure($measure);
                Form::ValidateQuantityFloat($quantity);
                Form::ValidateLaboratory($laboratory);

                // FAZ O UPLOAD DO ARQUIVO E EM SEGUIDA REALIZA O INSERT
                File::SetFile($photo);
                if(File::$name != ERROR_UPLOAD) {
                    $this->GetModel();
                    $this->model::Insert([
                        "id_laboratory" => $laboratory,
                        "name" => $name,
                        "measure" => $measure,
                        "quantity" => $quantity,
                        "photo" => File::MoveFile()
                    ]);
                    Response::Message(REAGENT_CREATED);
                } else
                    Response::Message(ERROR_UPLOAD);
            } else
                Response::Message(INVALID_PERMISSION);
        }

        /**
         * Método responsável por atualizar um reagente específico pelo seu ID.
         * @param array $form Dados do formulário
         * @param array $photo Dados da foto
         * @return void
         */
        public function Update(array $form, array $photo) : void {
            if(Session::IsAdmin()) {
                // LIMPA OS CAMPOS
                $id_reagent = (int) Form::SanatizeField($form["id"], FILTER_SANITIZE_STRING);
                $laboratory = (int) Form::SanatizeField($form["laboratory"], FILTER_SANITIZE_STRING);
                $name = Form::SanatizeField($form["name"], FILTER_SANITIZE_STRING);
                $measure = Form::SanatizeField($form["measure"], FILTER_SANITIZE_STRING);
                $quantity = (float) Form::SanatizeField(str_replace(",", ".", $form["quantity"]), FILTER_SANITIZE_STRING);

                // VERIFICA CAMPOS VAZIOS, VALIDA O ID DO REAGENTE, A UNIDADE DE MEDIDA, QUANTIDADE E O LABORATÓRIO
                Form::VerifyEmptyFields([$laboratory, $name, $measure, $quantity]);
                Form::ValidateID($id_reagent);
                Form::ValidateMeasure($measure);
                Form::ValidateQuantityFloat($quantity);
                Form::ValidateLaboratory($laboratory);

                // OBTÊM O MODEL E VERIFICA SE FOI ENVIADO UMA FOTO
                $this->GetModel();
                if($photo["name"] != "") {
                    File::SetFile($photo);
                    if(File::$name != ERROR_UPLOAD) {
                        $values = [
                            "id_laboratory" => $laboratory,
                            "name" => $name,
                            "measure" => $measure,
                            "quantity" => $quantity,
                            "photo" => File::MoveFile()
                        ];
                        // DELETA A FOTO ANTIGA
                        $ancientPhoto = $this->GetByID($id_reagent)["photo"];
                        File::DeleteFile($ancientPhoto);
                    } else
                        Response::Message(ERROR_UPLOAD);
                } else {
                    $values = [
                        "id_laboratory" => $laboratory,
                        "name" => $name,
                        "measure" => $measure,
                        "quantity" => $quantity
                    ];
                }
                $this->model::Update("id_reagent = $id_reagent", $values);
                Response::Message(REAGENT_UPDATED);
            } else
                Response::Message(INVALID_PERMISSION);
        }

        /**
         * Método responsável por deletar um reagente específico pelo seu ID.
         * @param int $id_reagent ID do reagente
         * @return void
         */
        public function Delete(int $id_reagent) : void {
            if(Session::IsAdmin()) {
                // LIMPA O CAMPO DE ID E O VALIDA
                $id_reagent = (int) Form::SanatizeField((string) $id_reagent, FILTER_SANITIZE_STRING);
                Form::ValidateID($id_reagent);

                // OBTÊM O MODEL E EM SEGUIDA DELETA O REAGENTE
                $this->GetModel();
                $photo = $this->GetByID($id_reagent)["photo"];
                $this->model::Delete("id_reagent = ?", [$id_reagent]);

                // DELETA A FOTO ANTIGA
                File::DeleteFile($photo);
                Response::Message(REAGENT_DELETED);
            } else
                Response::Message(INVALID_PERMISSION);
        }
    }