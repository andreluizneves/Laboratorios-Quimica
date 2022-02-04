<?php

    require __DIR__ . "/App/Config/App.php";

    use App\Controllers\GlasswareController;

    (new GlasswareController)->Index();