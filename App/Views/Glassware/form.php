<div class="col-12 col-md-12 col-sm-12 col-lg-12 form" style="display:none">
    <form>
        <div class="row d-flex justify-content-center">
            <div class="form-group col-md-6 col-lg-6 col-12 col-sm-12">
                <label class="col-form-label font-weight-bold" for="name">
                    Nome:
                </label>
                <input class="form-control text-center input" id="name" maxlength="60" type="text" name="name">
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="form-group col-lg-6 col-md-6 col-12 col-sm-12">
                <label class="col-form-label font-weight-bold" for="quantity">
                    Quantidade:
                </label>
                <input class="form-control input text-center" id="quantity" type="number" name="quantity">
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="form-group col-lg-6 col-md-6 col-12 col-sm-12">
                <label class="col-form-label font-weight-bold" for="laboratory">
                    Laboratório em que está armazenado
                </label>
                <select class="form-control input" id="laboratory" name="laboratory">
                    <option value="">
                        Selecione o Laboratório
                    </option>
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
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-md-6 col-12 col-sm-12 d-flex d-flex justify-content-center">
                <div class="form-group m-0">
                    <label class="col-form-label font-weight-bold" for="photo">
                        Foto
                    </label>
                    <input class="form-control-file input" id="photo" type="file" name="photo">
                    <p style="font-size: 15px;">
                        Priorize imagens do formato quadrado de 2.5MB
                    </p>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="form-group col-lg-6 col-md-6 col-12 col-sm-12">
                <label class="col-form-label font-weight-bold" for="description">
                    Descrição:
                </label>
                <textarea class="form-control input" id="description" maxlength="300" name="description" rows="5" style="resize: none;"></textarea>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                <button class="btn btn-success btn-block font-weight-bold btn-new" type="button">
                    CATALOGAR
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    $("#quantity").mask("<?= "999999999" ?>");
</script>