<?php

    // USER
    const REGISTERED = ["msg"=>"Cadastro efetuado, redirecionando.", "icon"=>"success"];
    const LOGGED = ["msg"=>"Login efetuado, redirecionando.", "icon"=>"success"];
    const LOGIN_EMAIL_ALREADY_REGISTERED = ["msg"=>"RA/RM ou Email já cadastrado.", "icon"=>"error"];
    const WRONG_PASSWORD = ["msg"=>"Senha incorreta.", "icon"=>"error"];
    const USER_NOT_FOUND = ["msg"=>"Usuário não encontrado.", "icon"=>"error"];
    const ALREADY_LOGGED = ["msg"=>"Você ja se encontra logado!", "icon"=>"error"];

    // EQUIPAMENT
    const EQUIPAMENT_CREATED = ["msg" => "Equipamento catalogado com êxito.", "icon" => "success"];
    const EQUIPAMENT_UPDATED = ["msg" => "Equipamento editado com êxito.", "icon" => "success"];
    const EQUIPAMENT_DELETED = ["msg" => "Equipamento deletado com êxito.", "icon" => "success"];
    
    // REAGENT
    const REAGENT_CREATED = ["msg" => "Reagente catalogado com êxito.", "icon" => "success"];
    const REAGENT_UPDATED = ["msg" => "Reagente editado com êxito.", "icon" => "success"];
    const REAGENT_DELETED = ["msg" => "Reagente deletado com êxito.", "icon" => "success"];

    // GLASSWARE
    const GLASSWARE_CREATED = ["msg" => "Vidraria catalogada com êxito.", "icon" => "success"];
    const GLASSWARE_UPDATED = ["msg" => "Vidraria editada com êxito.", "icon" => "success"];
    const GLASSWARE_DELETED = ["msg" => "Vidraria deletada com êxito.", "icon" => "success"];

    // BROKEN GLASSWARE
    const BROKEN_GLASSWARE_CREATED = ["msg" => "Vidraria quebrada catalogada com êxito.", "icon" => "success"];
    const BROKEN_GLASSWARE_UPDATED = ["msg" => "Vidraria quebrada editada com êxito.", "icon" => "success"];
    const BROKEN_GLASSWARE_DELETED = ["msg" => "Vidraria quebrada deletada com êxito.", "icon" => "success"];

    // REPORT
    const REPORT_CREATED = ["msg" => "Relatório cadastrado com êxito.", "icon" => "success"];
    const REPORT_UPDATED = ["msg" => "Relatório editado com êxito.", "icon" => "success"];
    const REPORT_DELETED = ["msg" => "Relatório deletado com êxito.", "icon" => "success"];
    
    // FILE
    const FILE_NOT_SEND = ["msg" => "Não há uma imagem anexada!", "icon" => "error"];
    const FILE_TOO_BIG = ["msg"=>"O tamanho da imagem excede 2.5MB!", "icon"=>"error"];
    const INVALID_EXTENSION = ["icon"=>"error","msg"=>"Extensão inválida (.jpg, .jpeg & .png)!"];
    const ERROR_UPLOAD = ["msg"=>"Erro ao enviar arquivo, tente novamente ou entre em contato!","icon"=>"error"];

    // FORM
    const INVALID_REPORT_REAGENT_QUANTITY = ["msg" => "Quantidade usada de reagente inválida!", "icon" => "error"];
    const INVALID_EMAIL = ["msg"=>"Email Inválido.", "icon"=>"error"];
    const INVALID_TYPE = ["msg"=>"Tipo de usuário inválido.", "icon"=>"error"];
    const INVALID_DATE_TIME = ["msg"=>"Data e hora inválida.", "icon"=>"error"];
    const INVALID_QUANTITY = ["msg"=>"Quantidade inválida.", "icon"=>"error"];
    const INVALID_LABORATORY = ["msg"=>"Laboratório inválido.", "icon"=>"error"];
    const INVALID_MEASURE = ["msg"=>"Unidade de medida inválida.", "icon"=>"error"];
    const EMPTY_FIELDS = ["msg"=>"Há campo(s) vazio(s) que precisa(m) ser preenchido(s).","icon"=>"error"];
    const INVALID_ID = ["msg"=>"ID inválido!", "icon"=>"error"];
    const INVALID_PATRIMONY = ["msg"=>"Número de patrimônio inválido.", "icon"=>"error"];
    const INVALID_PERMISSION = ["msg"=>"Sem permissão para realizar tal ação.", "icon"=>"error"];
    const INVALID_LOGIN = ["msg"=>"RA/RM inválido.", "icon"=>"error"];

    // OTHER
    const GENERAL_ERROR = ["msg"=>"Erro no servidor! Entre em contato.","icon"=>"error"];
    const FK_ERROR = ["msg"=>"Não é possível excluir este item pois ele está relacionado a um relatório!", "icon"=>"error"];
    const SESSION_EMPTY = ["msg"=>"Sem permissão, faça seu login!", "icon"=>"error"];

    // NOTHING FOUND
    const NOTHING_FOUND = "<div class='col-12 col-col-12 col-sm-12 col-lg-12'>
                                <h2 class='text-center'>
                                    Nenhum registro encontrado
                                </h2>
                            </div>";
    const EMPTY_TABLE = "<tr role='row' class='bg-light'>
                            <td colspan='2' style='padding:5px;'>
                                Nenhum registro encontrado
                            </td>
                        </tr>";