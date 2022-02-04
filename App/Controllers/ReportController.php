<?php

    declare(strict_types=1);

    namespace App\Controllers;

    use App\Core\Controller;
    use App\Models\{
        Report,
        Equipament,
        Reagent,
        Glassware
    };
    use App\Utils\{
        Response,
        Session,
        Form
    };
    use PDO;

    /**
     * Classe herdada de Controller responsável por controlar as ações do Relatório.
     * @author Mário Guilherme de Andrade Rodrigues
     */
    class ReportController extends Controller {
        private Report $modelReport;
        private Equipament $modelEquipament;
        private Reagent $modelReagent;
        private Glassware $modelGlassware;

        /**
         * Método responsável de carregar a configuração do banco de dados e instanciar o modelo de Relatório.
         * @return void
         */
        private function GetModel() : void {
            require __DIR__ . "/../Config/Connection.php";
            $this->modelReport = new Report;
            $this->modelEquipament = new Equipament;
            $this->modelReagent = new Reagent;
            $this->modelGlassware = new Glassware;
        }

        /**
         * Método responsável por retornar um array com todos os relatórios.
         * @return array Relatórios cadastrados
         */
        private function GetAll() : array {
            return $this->modelReport::Select(
            "r INNER JOIN users u ON u.id_user = r.id_user
             INNER JOIN laboratories l ON l.id_laboratory = r.id_laboratory
             LEFT JOIN (SELECT id_report_reagent, id_report FROM reports_reagents GROUP BY id_report) rr ON rr.id_report = r.id_report
             LEFT JOIN (SELECT id_report_equipament, id_report FROM reports_equipament GROUP BY id_report) re ON re.id_report = r.id_report
             LEFT JOIN (SELECT id_report_glassware, id_report FROM reports_glassworks GROUP BY id_report) rg ON rg.id_report = r.id_report
             LEFT JOIN (SELECT id_broken_glassware, id_report FROM broken_glassworks GROUP BY id_report) bg ON bg.id_report = r.id_report",
             "", "title ASC",
             "r.id_report, DATE_FORMAT(date_time, '%d/%m/%Y ás %Hh%imin') as date_time, title, u.name as teacher,
             l.laboratory AS laboratory, rr.id_report_reagent as HasReagent, re.id_report_equipament as HasEquipament, rg.id_report_glassware as HasGlassware, bg.id_broken_glassware as HasBrokenGlassware")->fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * Método responsável por retornar um relatório específico pelo seu ID.
         * @param int $id_report ID do relatório
         * @return array Dados do relatório
         */
        private function GetByID(int $id_report) : array {
            return $this->modelReport::Select("r INNER JOIN laboratories l ON l.id_laboratory = r.id_laboratory", "id_report = ?", "", "id_report, r.title, duration, r.id_laboratory, date_time, description", [$id_report])->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * Método responsável por retornar um relatório específico pelo seu nome.
         * @param string $title Título do relatório
         * @return array Dados do relatório
         */
        private function GetByTitle(string $title) : array {
            return $this->modelReport::Select(
                "r INNER JOIN users u ON u.id_user = r.id_user
                 INNER JOIN laboratories l ON l.id_laboratory = r.id_laboratory
                 LEFT JOIN (SELECT id_report_reagent, id_report FROM reports_reagents GROUP BY id_report) rr ON rr.id_report = r.id_report
                 LEFT JOIN (SELECT id_report_equipament, id_report FROM reports_equipament GROUP BY id_report) re ON re.id_report = r.id_report
                 LEFT JOIN (SELECT id_report_glassware, id_report FROM reports_glassworks GROUP BY id_report) rg ON rg.id_report = r.id_report
                 LEFT JOIN (SELECT id_broken_glassware, id_report FROM broken_glassworks GROUP BY id_report) bg ON bg.id_report = r.id_report",
                 "r.title LIKE ?", "title ASC",
                 "r.id_report, DATE_FORMAT(date_time, '%d/%m/%Y ás %Hh%imin') as date_time, title, u.name as teacher,
                 l.laboratory AS laboratory, rr.id_report_reagent as HasReagent, re.id_report_equipament as HasEquipament, rg.id_report_glassware as HasGlassware, bg.id_broken_glassware as HasBrokenGlassware", [$title])->fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * Método responsável por carregar a View da tela principal de relatórios.
         * @return void
         */
        public function Index() : void {
            if(!Session::IsEmptySession()) {
                $data = [
                    "icon" => "reports",
                    "title" => "Relatórios",
                    "entity" => "report",
                    "buttons"=> $this->RenderButtons(3),
                    "jumbotron" => "Relatórios",
                    "search" => "Relatórios",
                    "label" => "Relatórios"
                ];
                $this->View("Page/structure", $data);
            } else
                Session::Redirect("/");
        }

        /**
         * Método responsável por renderizar todos os relatórios.
         * @return void
         */
        public function List() : void {
            if(!Session::IsEmptySession()) {
                $this->GetModel();
                $data = $this->GetAll();
                if(!empty($data)) {
                    foreach ($data as $report) {
                        require __DIR__ . "/../Views/Report/Components/card.php";
                    }
                } else
                    die(NOTHING_FOUND);
            } else
                Response::Message(SESSION_EMPTY);
        }

        /**
         * Método responsável por carregar a view de cadastro de relatórios.
         * @return void
         */
        public function LoadForm() : void {
            $this->GetModel();
            $data["equipament"] = $this->modelEquipament::Select("", "", "name ASC", "id_equipament, name, patrimony, photo")->fetchAll(PDO::FETCH_ASSOC);
            $data["reagents"] = $this->modelReagent::Select("", "", "name ASC", "*")->fetchAll(PDO::FETCH_ASSOC);
            $data["glassworks"] = $this->modelGlassware::Select("", "", "name ASC", "*")->fetchAll(PDO::FETCH_ASSOC);
            $this->View("Report/form", $data);
        }

        /**
         * Método responsável por renderizar o modal de um relatório específico pelo seu ID.
         * @param int $id_report ID do relatório
         * @return void
         */
        public function ViewByID(int $id_report) : void {
            if(!Session::IsEmptySession()) {
                $this->GetModel();
                $data = $this->GetByID($id_report);
                $data["equipament"] = $this->modelReport::Select("r INNER JOIN reports_equipament re ON r.id_report = re.id_report 
                                                             INNER JOIN equipament e ON re.id_equipament = e.id_equipament",
                                                            "r.id_report = ?", "", "e.name", [$id_report])->fetchAll(PDO::FETCH_ASSOC);
                $data["reagents"] = $this->modelReport::Select("r INNER JOIN reports_reagents rr ON r.id_report = rr.id_report 
                                                             INNER JOIN reagents rg ON rr.id_reagent = rg.id_reagent",
                                                            "r.id_report = ?", "", "rg.name, rr.quantity, measure", [$id_report])->fetchAll(PDO::FETCH_ASSOC);
                $data["glassworks"] = $this->modelReport::Select("r INNER JOIN reports_glassworks rgl ON r.id_report = rgl.id_report 
                                                             INNER JOIN glassworks g ON rgl.id_glassware = g.id_glassware",
                                                            "r.id_report = ?", "", "g.name", [$id_report])->fetchAll(PDO::FETCH_ASSOC);
                $data["brokenGlassworks"] = $this->modelReport::Select("r INNER JOIN broken_glassworks bg ON r.id_report = bg.id_report
                                                                    INNER JOIN glassworks g ON bg.id_glassware = g.id_glassware",
                                                                    "r.id_report = ?", "", "g.name, bg.quantity", [$id_report])->fetchAll(PDO::FETCH_ASSOC);
                $data["date_time"] = str_replace(" ", "T", $data["date_time"]);
                $this->View("Report/Components/modal", $data);
            } else
                Response::Message(SESSION_EMPTY);
        }

        /**
         * Método responsável por renderizar o(s) relatório(s) específico(s) pelo seu(s) nome.
         * @param string $search Nome do relatório(s)
         * @return void
         */
        public function Search(string $search) : void {
            if(!Session::IsEmptySession()) {
                // LIMPA O NOME E PREPARA O NOME PARA SER UTILIZADO NA BUSCA
                $search = "%" . Form::SanatizeField($search, FILTER_SANITIZE_STRING) . "%";
                $this->GetModel();
                $data = $this->GetByTitle($search);
                if(!empty($data)) {
                    foreach ($data as $report) {
                        require __DIR__ . "/../Views/Report/Components/card.php";
                    }
                } else
                    die(NOTHING_FOUND);
            } else
                Response::Message(SESSION_EMPTY);
        }

        /**
         * Método responsável por cadastrar um relatório.
         * @param array $form Dados do formulário
         * @return void
         */
        public function New(array $form) : void {
            if(Session::IsAdmin()) {
                // LIMPA OS CAMPOS
                $laboratory = (int) Form::SanatizeField($form["laboratory"], FILTER_SANITIZE_STRING);
                $title = Form::SanatizeField($form["title"], FILTER_SANITIZE_STRING);
                $date_time = Form::SanatizeField($form["date_time"], FILTER_SANITIZE_STRING);
                $duration = Form::SanatizeField($form["duration"], FILTER_SANITIZE_STRING);
                $description = Form::SanatizeField($form["description"], FILTER_SANITIZE_STRING);

                // VERIFICA CAMPOS VAZIOS, VALIDA O PATRIMÔNIO E LABORATÓRIO
                Form::VerifyEmptyFields([$laboratory, $title, $date_time, $duration, $description]);
                Form::ValidateLaboratory($laboratory);
                Form::ValidateDateTime($date_time);

                // CRIA OS VETORES DE EQUIPAMENTOS, REAGENTES E VIDRARIAS USADAS
                $equipament = [];
                $reagents = [];
                $glassworks = [];

                // VERIFICA QUAIS ITENS FOI UTILIZADO NO RELATÓRIO
                if(isset($form["equipament"])) {
                    foreach($form["equipament"] as $id_equipament) {
                        $equipament[] = (int) Form::SanatizeField($id_equipament, FILTER_SANITIZE_NUMBER_INT);
                    }
                }
                if(isset($form["reagents"])) {
                    foreach($form["reagents"] as $reagent) {
                        $id_reagent = (int) Form::SanatizeField($reagent[0], FILTER_SANITIZE_NUMBER_INT);
                        $quantity = (float) Form::SanatizeField(str_replace(",", ".", $reagent[1]), FILTER_SANITIZE_STRING);
                        $quantity == 0 ? Response::Message(INVALID_REPORT_REAGENT_QUANTITY) : "";
                        $reagents[] = [
                            "id_reagent" => $id_reagent,
                            "quantity" => $quantity
                        ];
                    }
                }
                if(isset($form["glassworks"])) {
                    foreach($form["glassworks"] as $id_glassware) {
                        $glassworks[] = (int) Form::SanatizeField($id_glassware, FILTER_SANITIZE_NUMBER_INT);
                    }
                }

                // FAZ O UPLOAD DO ARQUIVO E EM SEGUIDA REALIZA O INSERT
                $this->GetModel();
                $id_report = $this->modelReport::Insert([
                    "id_user" => $_SESSION["id_user"],
                    "id_laboratory" => $laboratory,
                    "title" => $title,
                    "date_time" => $date_time,
                    "duration" => $duration,
                    "description" => $description
                ]);
                if($id_report) {
                    foreach($equipament as $id_equipament) {
                        $this->modelReport::InsertReportsEquipament([
                            "id_report" => $id_report,
                            "id_equipament" => $id_equipament
                        ]);
                    }
                    foreach($reagents as $reagent) {
                        $this->modelReport::InsertReportsReagents([
                            "id_report" => $id_report,
                            "id_reagent" => $reagent["id_reagent"],
                            "quantity" => $reagent["quantity"]
                        ]);
                        $this->modelReagent::UpdateQuantity($reagent["id_reagent"], $reagent["quantity"]);
                    }
                    foreach($glassworks as $id_glassware) {
                        $this->modelReport::InsertReportsGlassworks([
                            "id_report" => $id_report,
                            "id_glassware" => $id_glassware
                        ]);
                    }
                    Response::Message(REPORT_CREATED);
                } else
                    Response::Message(GENERAL_ERROR);
            } else
                Response::Message(INVALID_PERMISSION);
        }

        /**
         * Método responsável por atualizar um relatório específico pelo seu ID.
         * @param array $form Dados do formulário
         * @return void
         */
        public function Update(array $form) : void {
            if(Session::IsAdmin()) {
                // LIMPA OS CAMPOS
                $id_report = (int) Form::SanatizeField($form["id"], FILTER_SANITIZE_STRING);
                $title = Form::SanatizeField($form["title"], FILTER_SANITIZE_STRING);
                $duration = Form::SanatizeField($form["duration"], FILTER_SANITIZE_STRING);
                $laboratory = (int) Form::SanatizeField($form["laboratory"], FILTER_SANITIZE_STRING);
                $date_time = Form::SanatizeField($form["date_time"], FILTER_SANITIZE_STRING);
                $description = Form::SanatizeField($form["description"], FILTER_SANITIZE_STRING);

                // VERIFICA CAMPOS VAZIOS, VALIDA O ID DO RELATÓRIO, O PATRIMÔNIO E O LABORATÓRIO
                Form::VerifyEmptyFields([$laboratory, $title, $date_time, $duration, $description]);
                Form::ValidateID($id_report);
                Form::ValidateLaboratory($laboratory);
                Form::ValidateDateTime($date_time);

                // OBTÊM O MODEL E VERIFICA SE FOI ENVIADO UMA FOTO
                $this->GetModel();
                $values = [
                    "id_laboratory" => $laboratory,
                    "title" => $title,
                    "date_time" => $date_time,
                    "duration" => $duration,
                    "description" => $description
                ];
                $this->modelReport::Update("id_report = $id_report", $values);
                Response::Message(REPORT_UPDATED);
            } else
                Response::Message(INVALID_PERMISSION);
        }

        /**
         * Método responsável por deletar um relatório específico pelo seu ID.
         * @param int $id_report ID do relatório
         * @return void
         */
        public function Delete(int $id_report) : void {
            if(Session::IsAdmin()) {
                // LIMPA O CAMPO DE ID E O VALIDA
                $id_report = (int) Form::SanatizeField((string) $id_report, FILTER_SANITIZE_STRING);
                Form::ValidateID($id_report);

                // OBTÊM O MODEL E EM SEGUIDA DELETA O RELATÓRIO
                $this->GetModel();
                $this->modelReport::Delete("id_report = ?", [$id_report]);

                Response::Message(REPORT_DELETED);
            } else
                Response::Message(INVALID_PERMISSION);
        }
    }