<?php

    require __DIR__ . "/App/Config/App.php";

    use App\Controllers\BrokenGlasswareController;

    (new BrokenGlasswareController)->Index();