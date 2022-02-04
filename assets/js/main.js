$(document).ready(() => {
    //FUNÇÕES INICIAIS
    const entity = $("body").attr("entity");
    $(".jumbotron").css({
        "background-image": `url("assets/img/${entity}.jpg")`
    });
    setTimeout(() => {
        Ajax(`services/list?entity=${entity}`, "html", null, response => {
            ShowCards(response);
        });
        $("body").css("visibility", "visible");
        $("button, input, textarea, select").attr("disabled", false);
    }, 750);

    // LISTAGEM INICIAL
    $(".btn-list").click(() => {
        Ajax(`services/list?entity=${entity}`, "html", null, response => {
            $(".btn-list").parent("div").hide();
            $(".btn-form").parent("div").show();
            ShowCards(response);
        });
    });

    // PESQUISA
    $("input[name=search]").keyup(() => {
        if ($("input[name=search]").val() != "") {
            Ajax(`services/search?entity=${entity}`, "html", { search: $("input[name=search]").val() }, response => {
                $(".btn-list").parent("div").hide();
                $(".btn-form").parent("div").show();
                ShowCards(response);
            });
        } else {
            Ajax(`services/list?entity=${entity}`, "html", null, response => {
                ShowCards(response);
            });
        }
    });

    // CARREGAR FORMULÁRIO
    $(".btn-form").click(() => {
        Ajax(`services/load-form?entity=${entity}`, "html", null, response => {
            $(".btn-form").parent("div").hide();
            $(".btn-list").parent("div").show();
            $(".content").html(response);
            setTimeout(() => {
                $(".form").show("slow");
            }, 500);
        });
    });

    // CATALOGAR
    $(".content").on("click", ".btn-new", () => {
        VerifyFields($("form").serializeArray());
        AjaxFile(`services/new?entity=${entity}`, "json", $("form")[0], response => {
            SweetAlert(response.icon, response.msg);
            CleanFields(response.icon);
        });
    });
    $(".content").on("click", ".btn-new-report", () => {
        VerifyFields($("form").serializeArray());
        var equipament = [];
        var reagents = [];
        var glassworks = [];
        var array = $("#modal-equipament").find(".card-report[used=true]");
        for (let i = 0; i < array.length; i++) {
            const id = $(array[i]).attr("id");
            equipament.push(id);
        }
        var array = $("#modal-reagents").find(".card-report[used=true]");
        for (let i = 0; i < array.length; i++) {
            const id = $(array[i]).attr("id");
            const used = $(array[i]).find("#quantity_used").val();
            reagents.push([id, used]);
        }
        var array = $("#modal-glassworks").find(".card-report[used=true]");
        for (let i = 0; i < array.length; i++) {
            const id = $(array[i]).attr("id");
            glassworks.push(id);
        }
        data = {
            title: $("#title").val(),
            date_time: $("#date_time").val(),
            duration: $("#duration").val(),
            laboratory: $("#laboratory").val(),
            description: $("#description").val(),
            equipament: equipament,
            reagents: reagents,
            glassworks: glassworks,
        };
        Ajax(`services/new?entity=${entity}`, "json", data, response => {
            SweetAlert(response.icon, response.msg);
            response.icon == "success" ? Ajax(`services/list?entity=report`, "html", null, response => {
                ShowCards(response);
                $(".btn-list").parent("div").hide();
                $(".btn-form").parent("div").show();
            }) : "";
        });
    });

    // VISUALIZAR
    $(".content").on("click", ".card", function(e) {
        if (e.target.nodeName == "BUTTON" || e.target.nodeName == "I") {
            e.preventDefault();
        } else {
            Ajax(`services/view?entity=${entity}`, "html", { id: $(this).attr("id") }, response => {
                $(".modal-content").html(response);
                $(".modal-content").find("input, select, textarea").attr("disabled", true);
                $(".div-photo, .btn-update, .warning-edit").hide();
                $("#modal").modal("show");
            });
        }
    });

    // EDITAR
    $(".content").on("click", ".btn-edit", function(e) {
        Ajax(`services/view?entity=${entity}`, "html", { id: $(this).attr("id") }, response => {
            $(".modal-content").html(response);
            $("#modal").modal("show");
        });
    });
    // ATUALIZAR
    $(".modal-content").on("click", ".btn-update", function() {
        VerifyFields($("form").serializeArray());
        AjaxFile(`services/update?entity=${entity}`, "json", $("form")[0], response => {
            SweetAlert(response.icon, response.msg);
            if (response.icon == "success") {
                CleanFields(response.icon);
                $(".modal").modal("hide");
                Ajax(`services/list?entity=${entity}`, "html", null, response => {
                    ShowCards(response);
                });
            }
        });
    });

    // DELETAR
    $(".content").on("click", ".btn-delete", function(e) {
        Swal.fire({
            html: `<h2 style="color: white;"> Deseja mesmo fazer a exclusão deste item?</h2>`,
            background: "rgb(39, 39, 61)",
            icon: "question",
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonText: "Sim",
            confirmButtonColor: "#d9534f",
            cancelButtonText: "Não",
            cancelButtonColor: "#f0ad4e"
        }).then(result => {
            if (result.value) {
                Ajax(`services/delete?entity=${entity}`, "json", { id: $(this).attr("id") }, response => {
                    SweetAlert(response.icon, response.msg);
                    CleanFields(response.icon);
                    if (response.icon == "success") {
                        $(".modal").modal("hide");
                        $(this).parent().parent().parent().parent().hide("slow");
                        setTimeout(() => {
                            $(this).parent().parent().parent().parent().remove();
                            if ($(".row").find("div.col-12.col-md-6.col-sm-6.col-lg-3.mb-4").length == 0) {
                                Ajax(`services/list?entity=${entity}`, "html", null, response => {
                                    ShowCards(response);
                                });
                            }
                        }, 600)
                    }
                });
            }
        });
    });

    // LIMPAR MODAL AO FECHAR
    $(".modal").on("hidden.bs.modal", function() {
        $(".modal-content").empty();
    });

    // BUTÕES DE ABERTURA DE MODAL NO FORMULÁRIO DE RELATÓRIO
    $(".content").on("click", ".btn-equipament", () => {
        $("#modal-equipament").modal("show");
    });
    $(".content").on("click", ".btn-reagents", () => {
        $("#modal-reagents").modal("show");
    });
    $(".content").on("click", ".btn-glassworks", () => {
        $("#modal-glassworks").modal("show");
    });

    // BLOQUEAR TODOS OS BOTÕES E DESBLOQUEAR APÓS 1 SEGUNDO
    $("button").click(() => {
        $("button").attr("disabled", true);
        setTimeout(() => {
            $("button").attr("disabled", false);
        }, 1000);
    });

    // SELECIONAR ITEM DO FORMULÁRIO DE RELATÓRIO
    $(".content").on("click", ".card-report", function(e) {
        if (e.target.nodeName == "INPUT") {
            e.preventDefault();
        } else {
            if ($(this).attr("used") == "true") {
                $(this).attr("used", false);
                $(this).find(".div-quantity_used").hide("fast");
            } else {
                $(this).attr("used", true);
                $(this).find(".div-quantity_used").show("fast");
            }
        }
    });

    // OUTRAS FUNCIONALIDADES
    $(".btn-modal-5s").click(() => {
        $(".modal").modal("show");
    });
});