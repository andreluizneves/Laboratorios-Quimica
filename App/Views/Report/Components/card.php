<div class="col-12 col-md-4 col-sm-12 col-lg-4 mb-4" style="display:none;">
    <div class="card" id="<?= $report["id_report"] ?>">
        <div class="card-header font-weight-bold">
            Relatório: <?= $report["title"] ?>
        </div>
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-5 text-left">
                    <div class="font-weight-bold">
                        Professor(a): <?= $report["teacher"] ?>
                    </div>
                    <br>
                    <div class="mt-4">
                        Laboratório <?= $report["laboratory"] ?>
                    </div>
                </div>
                <div style="text-align-last: justify;justify-content: space-around;" class="col-7 flex-column text-right d-flex">
                    <div class="font-weight-bold">
                        <i class="fas fa-calendar-alt"></i>
                        <?= $report["date_time"] ?>
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="mb-2 mt-2" style="text-align-last: center;">
                        <img style="width: 35px;filter: <?= $report["HasEquipament"] ? "drop-shadow(2px 4px 6px black)" : "opacity(0.35);" ?>" src="assets/img/icons/equipament.png" title="Usou Equipamento(s)"> &nbsp;
                        <img style="width: 35px;filter: <?= $report["HasReagent"] ? "drop-shadow(2px 4px 6px black)" : "opacity(0.35);" ?>" src="assets/img/icons/reagents.png" title="Usou Reagentes(s)"> &nbsp;
                        <img style="width: 35px;filter: <?= $report["HasGlassware"] ? "drop-shadow(2px 4px 6px black)" : "opacity(0.35);" ?>" src="assets/img/icons/glassworks.png" title="Usou Vidrarias(s)"> &nbsp;
                        <img style="width: 35px;filter: <?= $report["HasBrokenGlassware"] ? "drop-shadow(2px 4px 6px black)" : "opacity(0.35);" ?>" src="assets/img/icons/broken-glassware.png" title="Quebrou Vidrarias"> &nbsp;
                    </div>
                    <?php if(App\Utils\Session::IsAdmin()): ?>
                        <div>
                            <button id="<?= $report["id_report"] ?>" title="Editar" class="btn btn-primary btn-edit">
                                Editar
                                <i class="fas fa-pen"></i>
                            </button>
                            <button id="<?= $report["id_report"] ?>" title="Deletar" class="btn btn-danger btn-delete">
                                Deletar
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>