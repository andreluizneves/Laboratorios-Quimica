<form class="form">
    <div class="modal-header">
        <div class="row">
            <div class="col-12 d-flex flex-row justify-content-center">
                <div>
                    <h2 class="modal-title" id="exampleModalLabel">
                        Visualizando a Vidraria Quebrada:&nbsp;
                    </h2>
                    <select class="form-control" id="id_glassware" name="id_glassware">
                        <?= $data["glassworks"] ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-body">
        <div class="row d-flex align-items-center">
            <div class="col-md-6 col-lg-6 col-sm-12 col-12">
                <img class="photo" src="photos/<?= $data["photo"] ?>">
            </div>
            <div class="col-lg-5 col-md-5 col-12 col-sm-12 mt-1">
                <div class="form-group">
                    <label class="font-weight-bold mt-1 mb-0" for="quantity">
                        Quantidade Quebrada
                    </label>
                    <input class="form-control text-center" id="quantity" type="number" name="quantity" value="<?= $data["quantity"] ?>">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold mt-1 mb-0" for="id_report">
                        Aula em que quebrou
                    </label>
                    <div class="form-group">
                        <select class="form-control" id="id_report" name="id_report">
                        <option value="0">
                            NÃO QUEBRADO EM AULA
                        </option>
                            <?= $data["reports"] ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <input id="id" type="hidden" name="id" value="<?= $data["id_broken_glassware"] ?>">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            Fechar
        </button>
        <button type="button" class="btn btn-primary btn-update">
            Salvar
        </button>
    </div>
</form>
<script>
    $("#id_glassware").val("<?= $data["id_glassware"] ?>");
    $("#id_report").val("<?= $data["id_report"] == null ? "0" : $data["id_report"] ?>");
    $("#laboratory").val("<?= $data["id_laboratory"] ?>");
    $("#quantity").mask("999999999");
</script>