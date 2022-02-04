<div class="col-12 col-md-6 col-sm-6 col-lg-3 mb-4" style="display: none;">
    <div class="card" id="<?= $row[0] ?>">
        <h4 class="text-center mb-2 mt-2">
            <?= $row[1] ?>
        </h4>
        <p class="text-center">
            <img class="card-img-top" height="200px" src="photos/<?= $row[2] ?>">
        </p>
        <?php if(App\Utils\Session::IsAdmin()): ?>
            <div class="card-body pt-0">
                <div>
                    <button id="<?= $row[0] ?>" title="Editar" class="btn btn-primary btn-edit">
                        Editar
                        <i class="fas fa-pen"></i>
                    </button>
                    <button id="<?= $row[0] ?>" title="Deletar" class="btn btn-danger btn-delete">
                        Deletar
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>