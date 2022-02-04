<?php

    declare(strict_types=1);

    namespace App\Controllers;

    use App\Core\Controller;
    use App\Utils\Session;

    /**
     * Classe herdada de Controller responsável por controlar as ações das páginas.
     * @author Mário Guilherme de Andrade Rodrigues
     */
    class PageController extends Controller {
        /**
         * Método responsável por carregar a página de apresentação do sistema.
         * @return void
         */
        public function Menu() : void {
            if(!Session::IsEmptySession()) {
                $data = [
                    "buttons" => $this->RenderButtons(0)
                ];
                $this->View("Page/menu", $data);
            } else
                Session::Redirect("/");
        }

        /**
         * Método responsável por carregar a View do formulário de uma determinada entidade.
         * @param string $entity Nome da entidade
         * @return void
         */
        public function LoadForm(string $entity) : void {
            if($entity == "BrokenGlassware")
                (new BrokenGlasswareController)->LoadForm();
            else if($entity == "Report")
                (new ReportController)->LoadForm();
            else
                $this->View("$entity/form");
        }

        /**
         * Método responsável por carregar a View de login de usuário.
         * @return void
         */
        public function FormLogin() : void {
            if(Session::IsEmptySession())
                $this->View("User/login");
            else
                Session::Redirect("menu");
        }

        /**
         * Método responsável por carregar a View de cadastro de usuário.
         * @return void
         */
        public function FormRegister() : void {
            if(Session::IsEmptySession())
                $this->View("User/register");
            else
                Session::Redirect("menu");
        }
    }