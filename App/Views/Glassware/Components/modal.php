<form class="form">
    <div class="modal-header">
        <h2 class="modal-title">
            Visualizando a Vidraria:
            <input class="text-center name" maxlength="60" type="text" name="name" value="<?= $data["name"] ?>" style="width: 60%;">
        </h2>
    </div>
    <div class="modal-body">
        <div class="row d-flex align-items-center">
            <div class="col-md-6 col-lg-6 col-sm-12 col-12">
                <img class="photo" src="photos/<?= $data["photo"] ?>">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-12">
                <label class="font-weight-bold mt-1 mb-0" for="description">
                    Descrição
                </label>
                <textarea class="form-control text-justify description" id="description" maxlength="300" name="description" cols="30" rows="20"><?= $data["description"] ?></textarea>
                <div class="div-photo">
                    <label class="font-weight-bold mt-1 mb-0" for="photo">
                        Foto
                    </label>
                    <br>
                    <input class="form-control input-photo" type="file" name="photo">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                <label class="font-weight-bold mt-1 mb-0" for="quantity">
                    Quantidade
                </label>
                <input class="form-control text-center" id="quantity" type="number" name="quantity" value="<?= $data["quantity"] ?>">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-12">
                <label class="font-weight-bold mt-1 mb-0" for="laboratory">
                    Laboratório
                </label>
                <div class="form-group">
                    <select class="form-control" id="laboratory" name="laboratory">
                        <option value="1">
                            Externo
                        </option>
                        <option value="2">
                            Interno
                        </option>
                        <option value="3">
                            Ambos
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <input id="id" type="hidden" name="id" value="<?= $data["id_glassware"] ?>">
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
    $("#quantity").mask("999999999");
    $("#laboratory").val("<?= $data["id_laboratory"] ?>");
</script>