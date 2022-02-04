<form class="form">
    <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">
            Visualizando o Reagente:
            <input class="text-center name" maxlength="60" type="text" name="name" value="<?= $data["name"] ?>" style="width: 60%;">
        </h2>
    </div>
    <div class="modal-body">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-6 col-lg-6 col-sm-12 col-12">
                <img class="photo" src="photos/<?= $data["photo"] ?>">
            </div>
            <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-12 col-sm-12">
                        <label class="font-weight-bold mt-1 mb-0" for="quantity">
                            Quantidade
                        </label>
                        <input class="form-control text-center" id="quantity" type="text" name="quantity" value="<?= number_format($data["quantity"], 2, ",", ".") ?>">
                    </div>
                    <div class="col-lg-5 col-md-4 col-12 col-sm-12">
                        <label class="font-weight-bold mt-1 mb-0" for="measure">
                            Unidade de medida
                        </label>
                        <div class="form-group mb-0">
                            <select class="form-control" id="measure" name="measure">
                                <option value="g">
                                    grama (g)
                                </option>
                                <option value="ml">
                                    mililitros (ml)
                                </option>
                                <option value="L">
                                    Litros (l)
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-12 col-sm-12">
                        <div class="form-group">
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
                            <div class="div-photo">
                                <label label class="font-weight-bold mt-1 mb-0" for="photo">
                                    Foto
                                </label>
                                <br>
                                <input class="form-control input-photo" type="file" name="photo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input id="id" type="hidden" name="id" value="<?= $data["id_reagent"] ?>">
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
    $("#laboratory").val("<?= $data["id_laboratory"] ?>");
    $("#measure").val("<?= $data["measure"] ?>");
    $("#quantity").inputmask("Regex", {
        regex: "^[0-9]{1,4}(\\,\\d{1,2})?$"
    });
</script>