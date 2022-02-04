<nav class="sideall">
    <div class="sidebar">
        <div class="toggle-btn row d-flex justify-content-center align-content-center">
            <center>
                <i class="far fa-arrow-alt-circle-left d-none"></i>
                <i class="far fa-arrow-alt-circle-right"></i>
            </center>
        </div>
        <div class="content-sidebar">
            <div class="sidebar-header">
                <center>
                    <img src="assets/img/<?= $_SESSION["photo"] ?>.svg">
                </center>
            </div>
            <ul class="list-unstyled font-weight-bold">
                <li class="username">
                    <?= "$_SESSION[type]: $_SESSION[name]" ?>
                </li>
                <li class="userlogin">
                    <?= "$_SESSION[typeLogin]: $_SESSION[login]" ?>
                </li>
                <div class="btn-pages">
                    <li class="cursor-pointer btn-top">
                        <i class="fas fa-arrow-alt-circle-up"></i>&nbsp;Topo
                    </li>
                    <?= $data["buttons"] ?>
                    <li>
                        <a href="services/logout">
                            <i class="fa fa-sign-out-alt"></i>&nbsp;Sair
                        </a>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</nav>