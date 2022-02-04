<div class="col-12 col-md-12 col-sm-12 col-lg-12 form" style="display:none">
    <form>
        <div class="row d-flex justify-content-center">
            <div class="form-group col-12 col-md-6 col-sm-12 col-lg-6">
                <label for="id_glassware" class="font-weight-bold">
                    Selecione a vidraria:
                </label>    
                <select class="form-control" id="id_glassware" name="id_glassware">
                    <option value="">
                        SELECIONE A VIDRARIA
                    </option>
                    <?= $data["glassworks"] ?>
                </select>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="form-group col-12 col-md-6 col-sm-12 col-lg-6">
                <label for="id_report" class="font-weight-bold">
                    Selecione a aula em que foi quebrada:
                </label>
                <select class="form-control" id="id_report" name="id_report">
                    <option value="0">
                        NÃO QUEBRADO EM AULA
                    </option>
                    <?= $data["reports"] ?>
                </select>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="form-group col-12 col-md-6 col-sm-12 col-lg-6">
            <label class="col-form-label font-weight-bold" for="quantity">
                    Quantidade quebrada:
                </label>
                <input class="form-control input text-center" id="quantity" type="number" name="quantity">
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
    $("#quantity").mask("999999999");
</script>