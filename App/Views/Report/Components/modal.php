<form class="form">
    <div class="modal-header">
        <h1 class="modal-title text-black" id="exampleModalLabel">
            Aula:
            <input class="text-center name" maxlength="60" type="text" name="title" value="<?= $data["title"] ?>" style="width: 70%;">
        </h1>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-12 col-lg-12 col-sm-12 col-md-12">
                <h3 class="text-black text-left">
                    O que foi usado:
                </h3>
            </div>
        </div>
        <div class="row tabelas">
            <div class="col-12 col-sm-12 col-lg-3 col-md-3">
                <table class="table table-hover display compact cell-border" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                Equipamentos
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($data["equipament"])): ?>
                            <?php foreach ($data["equipament"] as $equipamentData): ?>
                                <tr role="row" class="bg-light">
                                    <td style="padding:5px;">
                                        <?= $equipamentData["name"] ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?= EMPTY_TABLE ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-sm-12 col-lg-3 col-md-3">
                <table class="table table-hover display compact cell-border" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                Reagentes
                            </th>
                            <th>
                                Quantia Usada
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($data["reagents"])): ?>
                            <?php foreach ($data["reagents"] as $reagent): ?>
                                <tr role="row" class="bg-light">
                                    <td style="padding:5px;">
                                        <?= $reagent["name"] ?>
                                    </td>
                                    <td style="padding:5px;">
                                        <?= number_format($reagent["quantity"], 2, ",", ".") . $reagent["measure"]?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?= EMPTY_TABLE ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-sm-12 col-lg-3 col-md-3">
                <table class="table table-hover display compact cell-border" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                Vidrarias
                            </th>
                        </tr>
                        <tbody>
                            <?php if(!empty($data["glassworks"])): ?>
                                <?php foreach ($data["glassworks"] as $glassware): ?>
                                    <tr role="row" class="bg-light">
                                        <td style="padding:5px;">
                                            <?= $glassware["name"] ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?= EMPTY_TABLE ?>
                            <?php endif; ?>
                        </tbody>
                    </thead>
                </table>
            </div>
            <div class="col-12 col-sm-12 col-lg-3 col-md-3">
                <table class="table table-hover display compact cell-border" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                Vidrarias Quebradas
                            </th>
                            <th>
                                Quantia Quebrada
                            </th>
                        </tr>
                        <tbody>
                            <?php if(!empty($data["brokenGlassworks"])): ?>
                                <?php foreach ($data["brokenGlassworks"] as $brokenGlassware): ?>
                                    <tr role="row" class="bg-light">
                                        <td style="padding:5px;">
                                            <?= $brokenGlassware["name"] ?>
                                        </td>
                                        <td style="padding:5px;">
                                            <?= $brokenGlassware["quantity"] ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?= EMPTY_TABLE ?>
                            <?php endif; ?>
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12 col-md-2 col-sm-12 col-lg-2">
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
            <div class="col-12 col-sm-12 col-md-2 col-lg-2">
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
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                <div class="form-group">
                    <label>
                        Data e hora
                    </label>
                    <input class="form-control input" id="date_time" type="datetime-local" name="date_time" value="<?= $data["date_time"] ?>">
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-6 col-md-6">
                <label class="font-weight-bold mt-1 mb-0" for="description">
                    Descrição
                </label>
                <textarea class="form-control text-justify" id="description" maxlength="300" name="description" cols="30" rows="20" style="height: 200px;resize: none;"><?= $data["description"] ?></textarea>
            </div>
        </div>
        <input id="id" type="hidden" name="id" value="<?= $data["id_report"] ?>">
    </div>
    <div class="modal-footer flex-column">
        <h4 class="text-black warning-edit">
            Aviso: apenas permitido alterar o título, tempo de aula, laboratório, data e hora e descricao do relatório!
        </h4>
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            Fechar
        </button>
        <button type="button" class="btn btn-primary btn-update">
            Salvar
        </button>
    </div>
</form>
<script>
    $("#duration").val("<?= $data["duration"] ?>");
    $("#laboratory").val("<?= $data["id_laboratory"] ?>");
</script>