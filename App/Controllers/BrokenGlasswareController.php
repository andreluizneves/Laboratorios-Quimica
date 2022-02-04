<?php

    declare(strict_types=1);

    namespace App\Controllers;

    use App\Core\Controller;
    use App\Models\{
        BrokenGlassware,
        Glassware,
        Report
    };
    use App\Utils\{
        Response,
        Session,
        Form
    };
    use PDO;

    /**
     * Classe herdada de Controller responsável por controlar as ações da Vidraria Quebrada.
     * @author Mário Guilherme de Andrade Rodrigues
     */
    class BrokenGlasswareController extends Controller {
        public BrokenGlassware $modelBrokenGlassware;
        public Glassware $modelGlassware;
        public Report $modelReport;

        /**
         * Método responsável de carregar a configuração do banco de dados e instanciar o modelo de Vidraria Quebrada, Vidraria e Relatório.
         * @return void
         */
        private function GetModel() : void {
            require __DIR__ . "/../Config/Connection.php";
            $this->modelBrokenGlassware = new BrokenGlassware;
            $this->modelGlassware = new Glassware;
            $this->modelReport = new Report;
        }

        /**
         * Método responsável por retornar um array com todas as vidrarias quebradas.
         * @return array Vidrarias quebradas cadastradas
         */
        private function GetAll() : array {
            return $this->modelBrokenGlassware::Select("bg INNER JOIN glassworks g ON bg.id_glassware = g.id_glassware", "", "name ASC", "id_broken_glassware, name, photo")->fetchAll();
        }

        /**
         * Método responsável por retornar uma vidraria quebrada específica pelo seu ID.
         * @param int $id_broken_glassware ID da vidraria quebrada
         * @return array Dados da vidraria quebrada
         */
        private function GetByID(int $id_broken_glassware) : array {
            return $this->modelBrokenGlassware::Select("bg
                INNER JOIN glassworks g ON bg.id_glassware = g.id_glassware
                LEFT JOIN reports r ON bg.id_report = r.id_report", "id_broken_glassware = ?", "",
                "id_broken_glassware, name, g.id_glassware, g.id_glassware, photo, bg.quantity, bg.id_report, r.id_laboratory", [$id_broken_glassware])->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * Método responsável por retornar a(s) vidraria(s) quebrada(s) específica(s) pelo seu nome.
         * @param string $name Nome da(s) vidraria(s) quebrada(s)
         * @return array Vidraria(s) quebrada(s)
         */
        private function GetByName(string $name) : array {
            return $this->modelBrokenGlassware::Select("bg INNER JOIN glassworks g ON bg.id_glassware = g.id_glassware", "name LIKE ?", "name ASC", "id_broken_glassware, name, photo", [$name])->fetchAll();
        }

        /**
         * Método responsável por carregar a View do formulário da vidraria quebrada.
         * @return void
         */
        public function LoadForm() : void {
            $glassworks = "";
            $reports = "";
            $this->GetModel();
            $data = [
                "glassworks" => $this->modelGlassware::Select("", "", "name ASC", "id_glassware, name")->fetchAll(PDO::FETCH_ASSOC),
                "reports" => $this->modelReport::Select("", "", "title ASC", "id_report, title")->fetchAll(PDO::FETCH_ASSOC)
            ];
            foreach($data["glassworks"] as $glassware) {
                $glassworks .= "<option value='$glassware[id_glassware]'>$glassware[name]</option>";
            }
            foreach($data["reports"] as $report) {
                $reports .= "<option value='$report[id_report]'>$report[title]</option>";
            }
            $data["glassworks"] = $glassworks;
            $data["reports"] = $reports;
            $this->View("BrokenGlassware/form", $data);
        }

        /**
         * Método responsável por carregar a View da tela principal de vidrarias quebradas.
         * @return void
         */
        public function Index() : void {
            if(!Session::IsEmptySession()) {
                $data = [
                    "icon" => "broken-glassware",
                    "title" => "Vidrarias Quebradas",
                    "entity" => "brokenGlassware",
                    "buttons"=> $this->RenderButtons(4),
                    "jumbotron" => "Vidrarias Quebradas",
                    "search" => "Vidrarias Quebradas",
                    "label" => "Vidrarias Quebradas"
                ];
                $this->View("Page/structure", $data);
            } else
                Session::Redirect("/");
        }

        /**
         * Método responsável por renderizar todas vidrarias quebradas.
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
         * Método responsável por renderizar o modal de uma vidraria quebrada específica pelo seu ID.
         * @param int $id_broken_glassware ID da vidraria quebrada
         * @return void
         */
        public function ViewByID(int $id_broken_glassware) : void {
            if(!Session::IsEmptySession()) {
                // OBTÊM O MODEL E PEGAR OS DADOS DA VIDRARIA ESPECÍFICA
                $this->GetModel();
                $data = $this->GetByID($id_broken_glassware);

                // OBTÊM E EMS SEGUIDA RENDERIZA AS VIDRARIAS E OS RELATÓRIOS PARA EDIÇÃO
                $data["glassworks"] = $this->modelGlassware::Select("", "", "name ASC", "id_glassware, name")->fetchAll(PDO::FETCH_ASSOC);
                $data["reports"] = $this->modelReport::Select("", "", "title ASC", "id_report, title")->fetchAll(PDO::FETCH_ASSOC);
                $glassworks = "";
                $reports = "";
                foreach($data["glassworks"] as $glassware) {
                    $glassworks .= "<option value='$glassware[id_glassware]'>$glassware[name]</option>";
                }
                foreach($data["reports"] as $report) {
                    $reports .= "<option value='$report[id_report]'>$report[title]</option>";
                }
                $data["glassworks"] = $glassworks;
                $data["reports"] = $reports;
                $this->View("BrokenGlassware/Components/modal", $data);
            } else
                Response::Message(SESSION_EMPTY);
        }

        /**
         * Método responsável por renderizar a(s) vidrarias(s) quebrada(s) específica(s) pelo seu nome.
         * @param string $search Nome da(s) vidraria(s) quebrada(s)
         * @return void
         */
        public function Search(string $search) : void {
            if(!Session::IsEmptySession()) {
                // LIMPA O NOME E PREPARA O NOME PARA SER UTILIZADO NA BUSCA
                $search = "%" . Form::SanatizeField($search, FILTER_SANITIZE_STRING) . "%";

                // OBTÊM O MODELO E EM SEGUIDA RENDERIZA O RESULTADO
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
         * Método responsável por cadastrar uma vidraria quebrada.
         * @param array $form Dados do formulário
         * @return void
         */
        public function New(array $form) : void {
            if(Session::IsAdmin()) {
                // LIMPA OS CAMPOS
                $id_glassware = (int) Form::SanatizeField($form["id_glassware"], FILTER_SANITIZE_STRING);
                $id_report = $form["id_report"] != 0 ? (int) Form::SanatizeField($form["id_report"], FILTER_SANITIZE_STRING) : null;
                $quantity = (int) Form::SanatizeField($form["quantity"], FILTER_SANITIZE_NUMBER_INT);

                // VERIFICA CAMPOS VAZIOS, VALIDA O ID DA VIDRARIA E A QUANTIDADE
                Form::VerifyEmptyFields([$id_glassware, $quantity]);
                Form::ValidateID($id_glassware);
                Form::ValidateQuantityInt($quantity);

                // OBTÊM O MODELO E FAZ A INSERÇÃO
                $this->GetModel();
                $this->modelBrokenGlassware::Insert([
                    "id_report" => $id_report,
                    "id_glassware" => $id_glassware,
                    "quantity" => $quantity
                ]);
                Response::Message(BROKEN_GLASSWARE_CREATED);
            } else
                Response::Message(INVALID_PERMISSION);
        }

        /**
         * Método responsável por atualizar uma vidraria quebrada específica pelo seu ID.
         * @param array $form Dados do formulário
         * @return void
         */
        public function Update(array $form) : void {
            if(Session::IsAdmin()) {
                // LIMPA OS CAMPOS
                $id_broken_glassware = (int) Form::SanatizeField($form["id"], FILTER_SANITIZE_STRING);
                $id_glassware = (int) Form::SanatizeField($form["id_glassware"], FILTER_SANITIZE_STRING);
                $id_report = $form["id_report"] != 0 ? (int) Form::SanatizeField($form["id_report"], FILTER_SANITIZE_STRING) : null;
                $quantity = (int) Form::SanatizeField($form["quantity"], FILTER_SANITIZE_NUMBER_INT);

                // VERIFICA CAMPOS VAZIOS, VALIDA O ID DA VIDRARIA QUEBREADA, O ID DA VIDRARIA E A QUANTIDADE
                Form::VerifyEmptyFields([$id_glassware, $quantity]);
                Form::ValidateID($id_broken_glassware);
                Form::ValidateID($id_glassware);
                Form::ValidateQuantityInt($quantity);

                // OBTÊM O MODELO E FAZ A INSERÇÃO
                $this->GetModel();
                $values = [
                    "id_broken_glassware" => $id_broken_glassware,
                    "id_report" => $id_report,
                    "id_glassware" => $id_glassware,
                    "quantity" => $quantity
                ];
                $this->modelBrokenGlassware::Update("id_broken_glassware = $id_broken_glassware", $values);
                Response::Message(BROKEN_GLASSWARE_UPDATED);
            } else
                Response::Message(INVALID_PERMISSION);
        }

        /**
         * Método responsável por deletar uma vidraria quebrada específica pelo seu ID.
         * @param int $id_broken_glassware ID da vidraria quebrada
         * @return void
         */
        public function Delete(int $id_broken_glassware) : void {
            if(Session::IsAdmin()) {
                // LIMPA O CAMPO DE ID E O VALIDA
                $id_broken_glassware = (int) Form::SanatizeField((string) $id_broken_glassware, FILTER_SANITIZE_STRING);
                Form::ValidateID($id_broken_glassware);

                // OBTÊM O MODEL E EM SEGUIDA DELETA A VIDRARIA QUEBRADA
                $this->GetModel();
                $this->modelBrokenGlassware::Delete("id_broken_glassware = ?", [$id_broken_glassware]);
                Response::Message(BROKEN_GLASSWARE_DELETED);
            } else
                Response::Message(INVALID_PERMISSION);
        }
    }