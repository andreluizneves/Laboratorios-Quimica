<?php

    require __DIR__ . "/App/Config/App.php";

    use App\Controllers\ReagentController;

    (new ReagentController)->Index();