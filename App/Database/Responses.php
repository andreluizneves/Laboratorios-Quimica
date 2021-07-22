<?php

    // EQUIPAMENTOS
    const EQUIPAMENTO_CATALOGADO = ["msg"=>"Equipamento catalogado com êxito.","icone"=>"success"];
    const EQUIPAMENTO_DELETADO =  ["msg"=>"Equipamento deletado com êxito.","icone"=>"success"];
    const EQUIPAMENTO_ATUALIZADO = ["msg"=>"Equipamento editado com êxito.","icone"=>"success"];
    
    // REAGENTES
    const REAGENTE_CATALOGADO = ["msg"=>"Reagente catalogado com êxito.","icone"=>"success"];
    const REAGENTE_DELETADO = ["msg"=>"Reagente deletado com êxito.","icone"=>"success"];
    const REAGENTE_ATUALIZADO = ["msg"=>"Reagente editado com êxito.","icone"=>"success"];

    // VIDRARIAS
    const VIDRARIA_CATALOGADA = ["msg"=>"Vidraria catalogada com êxito.","icone"=>"success"];
    const VIDRARIA_DELETADA = ["msg"=>"Vidraria deletada com êxito.","icone"=>"success"];
    const VIDRARIA_ATUALIZADA = ["msg"=>"Vidraria editada com êxito.","icone"=>"success"];
    const VIDRARIA_QUEBRADA_CATALOGADA = ["msg"=>"Vidraria quebrada catalogada com êxito.","icone"=>"success"];
    const VIDRARIA_QUEBRADA_DELETADA = ["msg"=>"Vidraria quebrada deletada com êxito.","icone"=>"success"];
    const VIDRARIA_QUEBRADA_ATUALIZADA = ["msg"=>"Vidraria quebrada editada com êxito.","icone"=>"success"];
    const VIDRARIA_ERRO_QUANTIDADE = ["msg"=>"Vidrarias remanescentes não pode ser menor que o do estoque (negativo).", "icone"=>"error"];

    // RELATORIOS
    const RELATORIO_CATALOGADO = ["msg"=>"Relatório catalogado com êxito.","icone"=>"success"];
    const RELATORIO_DELETADO = ["msg"=>"Relatório deletado com êxito.","icone"=>"success"];
    const RELATORIO_ATUALIZADO = ["msg"=>"Relatório editado com êxito.","icone"=>"success"];
    const RELATORIO_ERRO_RESPONSAVEL = ["msg"=>"Apenas o professor responsável por esse relatório pode apagá-lo.", "icone"=>"error"];
    const ERRO_QUANTIDADE_REAGENTE = ["msg"=>"A quantidade de reagente utilizado excede a quantia em estoque.", "icone"=>"error"];
    const QUANTIDADE_VAZIA = ["msg"=>"Não foi informada a quantidade no reagente selecionado.", "icone"=>"error"];

    // OUTROS
    const CAMPOS_VAZIOS = ["msg"=>"Há campo(s) vazio(s) que precisa(m) ser preenchido(s).","icone"=>"error"];
    const ERRO_GERAL = ["msg"=>"Impossível executar a ação.","icone"=>"error"];
    const ERRO_UPDATE = ["msg"=>"Impossível atualizar com o) campo) em branco.","icone"=>"error"];
    const PERMISSAO_INVALIDA = ["msg"=>"Apenas professores podem criar, editar ou deletar itens.","icone"=>"error"];
    const FK_DELETE = ["msg"=>"Impossível deletar, há registro de relatórios com esse item!","icone"=>"info"];
    const PATRIMONIO_INVALIDO = ["msg"=>"O número de patrimônio precisa ser um valor numérico.","icone"=>"error"];
    const QUANTIDADE_INVALIDA = ["msg"=>"A quantidade precisa ser um valor numérico.","icone"=>"error"];
    const ERRO_DATA = ["msg"=>"Ano inválido, o mesmo precisa conter 4 digítos.","icone"=>"error"];

    // ACESSO
    const CADASTRADO = ["msg"=>"Cadastro efetuado, redirecionando.", "icone"=>"success"];
    const LOGADO = ["msg"=>"Login efetuado, redirecionando.", "icone"=>"success"];
    const SENHA_INCORRETA = ["msg"=>"Senha incorreta.", "icone"=>"error"];
    const NAO_CADASTRADO = ["msg"=>"Usuário não cadastrado.", "icone"=>"error"];
    const RA_CADASTRADO = ["msg"=>"RA já cadastrado.", "icone"=>"error"];
    const RM_CADASTRADO = ["msg"=>"RM já cadastrado.", "icone"=>"error"];
    const EMAIL_CADASTRADO = ["msg"=>"Email já cadastrado.", "icone"=>"error"];
    const EMAIL_INVALIDO = ["msg"=>"Email Inválido.", "icone"=>"error"];

    // UPLOAD DA IMAGEM
    const EXTENSAO_INVALIDA = ["msg"=>"A extensão do arquivo não é válida.", "icone"=>"error"];
    const TAMANHO_EXCEDENTE = ["msg"=>"O tamanho da foto não pode ultrapassar 2.5 MB.", "icone"=>"error"];
    const FALHA_UPLOAD = ["msg"=>"Erro ao enviar a foto, verifique-o e tente novamente.", "icone"=>"error"];
    const SEM_FOTO = ["msg"=>"Não há uma imagem anexada.", "icone"=>"error"];
    const EXCEDE_TAMANHO_SERVER = ["msg"=>"O tamanho da imagem excede o limite do servidor.", "icone"=>"error"];

    // REGISTROS
    const NENHUM_REGISTRO = "<div class='col-12 col-col-12 col-sm-12 col-lg-12'>
                                <h2 class='text-center'>
                                    Nenhum registro encontrado
                                </h2>
                            </div>";