<div class="col-12 col-md-12 col-sm-12 col-lg-12 form" style="display:none">
    <form>
        <div class="row d-flex justify-content-center mb-2">
            <div class="col-lg-4 col-md-4 col-12 col-sm-12">
                <label class="col-form-label font-weight-bold" for="title">
                    Título do Relatório
                </label>
                <input class="form-control text-center input" id="title" maxlength="60" type="text" name="title">
            </div>
            <div class="col-12 col-md-2 col-lg-2 col-sm-12">
                <label class="col-form-label font-weight-bold" for="date_time">
                    Data e hora
                </label>
                <input class="form-control input" id="date_time" type="datetime-local" name="date_time" placeholder="31/12/2999 23:59:59">
            </div>
        </div>
        <div class="row d-flex justify-content-center mb-2">
            <div class="col-12 col-md-3 col-sm-12 col-lg-3">
                <div div class="form-group">
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
            <div class="col-12 col-md-3 col-sm-12 col-lg-3">
                <div class="form-group">
                    <label class="font-weight-bold mt-1 mb-0" for="duration">
                        Tempo da Aula
                    </label>
                    <div class="form-group">
                        <select class="form-control" id="duration" name="duration">
                            <option value="00:50:00">
                                1 aula (50 min)
                            </option>
                            <option value="01:40:00">
                                2 aulas (1h 40min)
                            </option>
                            <option value="02:30:00">
                                3 aulas (2h 30min)
                            </option>
                            <option value="03:20:00">
                                4 aulas (3h 20min)
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center mb-2">
            <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                <label class="font-weight-bold mt-1 mb-0" for="description">
                    Descrição
                </label>
                <textarea class="form-control text-justify" id="description" maxlength="300" name="description" cols="30" rows="20" style="height: 200px;resize: none;"></textarea>
            </div>
        </div>
        <div class="row d-flex justify-content-center mb-2">
            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                <label>
                    O que foi utilizado:
                </label>
                <div class="row">
                    <div class="col-lg-4">
                        <button class="btn btn-primary btn-equipament" type="button">
                            Selecionar Equipamentos
                        </button>
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-primary btn-reagents" type="button">
                            Selecionar Reagentes
                        </button>
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-primary btn-glassworks" type="button">
                            Selecionar Vidrarias
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="form-group m-0 col-lg-6 col-md-6 col-sm-12 col-12">
                <button class="btn btn-success btn-block font-weight-bold btn-new-report" type="button">
                    RELATAR
                </button>
            </div>
        </div>
    </form>
</div>

<div id="modal-equipament" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lgg" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h1 class="modal-title font-weight-bold text-black" id="my-modal-title">
                    Equipamentos
                </h1>
            </div>
            <div class="modal-body">
                <div class="row align-items-center" style="height:690px; overflow: scroll; overflow-x:hidden;">
                    <?php if(!empty($data["equipament"])): ?>
                        <?php foreach ($data["equipament"] as $equipamentData): ?>
                            <div style="padding:10px" class="col-12 col-md-6 col-sm-6 col-lg-3 text-dark">
                                <div class="card-report" id="<?= $equipamentData["id_equipament"] ?>" used="false">
                                    <h4 class="text-center mb-2 mt-2 font-weight-bold">
                                        <?= $equipamentData["name"] ?>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?= NOTHING_FOUND ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<div id="modal-reagents" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lgg" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h1 class="modal-title font-weight-bold text-black" id="my-modal-title">
                    Reagentes
                </h1>
            </div>
            <div class="modal-body">
                <div class="row align-items-center" style="height:690px; overflow: scroll; overflow-x:hidden;">
                    <?php if(!empty($data["reagents"])): ?>
                        <?php foreach ($data["reagents"] as $reagent): ?>
                            <div class="col-12 col-md-6 col-sm-6 col-lg-3 text-dark" style="padding:10px;transition:1s;">
                                <div class="card-report" id="<?= $reagent["id_reagent"] ?>" used="false">
                                    <h4 class="text-center mb-2 mt-2 font-weight-bold nome">
                                        <?= $reagent["name"] ?>
                                    </h4>
                                    <div class="card-body pt-2 pb-2">
                                        <div class="row">
                                            <div class="col-lg-8 col-8 col-md-8 col-sm-8">
                                                <p class="card-text font-weight-bold">
                                                    Quantidade:
                                                </p>
                                            </div>
                                            <div class="col-lg-4 col-4 col-md-4 col-sm-4">
                                                <p class="card-text">
                                                    <?= $reagent["quantity"] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-2 pb-2 div-quantity_used" style="display: none;">
                                        <div class="row">
                                            <div class="col-lg-8 col-8 col-md-8 col-sm-8">
                                                <p class="card-text font-weight-bold">
                                                    Usado:
                                                </p>
                                            </div>
                                            <div class="col-lg-4 col-4 col-md-4 col-sm-4">
                                                <input class="form-control input text-center" id="quantity_used" type="text" name="quantity_used">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?= NOTHING_FOUND ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>            
<div id="modal-glassworks" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lgg" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h1 class="modal-title font-weight-bold text-black" id="my-modal-title">
                    Vidrarias
                </h1>
            </div>
            <dv class="modal-body">
                <div class="row align-items-center" style="height:690px; overflow: scroll; overflow-x:hidden;">
                    <?php if(!empty($data["glassworks"])): ?>
                        <?php foreach ($data["glassworks"] as $glassware): ?>
                            <div class="col-12 col-md-6 col-sm-6 col-lg-3 text-dark" style="padding:10px">
                                <div class="card-report" id="<?= $glassware["id_glassware"] ?>" used="false">
                                    <h4 class="text-center mb-2 mt-2 font-weight-bold">
                                        <?= $glassware["name"] ?>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?= NOTHING_FOUND ?>
                    <?php endif; ?>
                </div>
            </dv>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $("input[name=quantity_used]").inputmask("Regex", {
        regex: "^[0-9]{1,4}(\\,\\d{1,2})?$"
    });
</script>