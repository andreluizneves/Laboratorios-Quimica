function AjaxFile(url, dataType, data, callback) {
    $.ajax({
        type: "POST",
        url: url,
        dataType: dataType,
        data: new FormData(data),
        nimeType: "multipart/form-data",
        cache: false,
        contentType: false,
        processData: false,
        error: () => {
            SweetAlert("error", "Erro! Tente novamente");
        }
    }).done(callback);
}

function Ajax(url, dataType, data, callback) {
    $.ajax({
        type: "POST",
        url: url,
        dataType: dataType,
        data: data,
    }).done(callback);
}

function SweetAlert(icon, msg) {
    Swal.fire({
        icon: icon,
        html: `<h2 style="color:white; font-weight:bold;">${msg}</h2>`,
        background: "rgb(31, 50, 51)",
        allowOutsideClick: false
    });
}

function Redirect(icon, url) {
    if (icon == "success") {
        setTimeout(() => {
            $(location).attr("href", url);
        }, 2000);
    }
}

function VerifyFields(form) {
    for (let i = 0; i < form.length; i++) {
        if (form[i].value == "") {
            SweetAlert("error", "Há campo(s) vazio(s) que precisam ser preenchidos");
            throw "exit";
        }
    }
}

function CleanFields(icon) {
    if (icon == "success") {
        $("input, select, textarea").val("");
        $("select").prop("selectedIndex", 0);
    }
}

function ShowCards(cards, velocity) {
    $(".content").html(cards);
    var i = 0;
    var show = setInterval(() => {
        if (i <= $(".content > div").length) {
            $($(".content > div")[i]).show(velocity);
            i++;
        } else {
            clearInterval(show);
        }
    }, 200);
}