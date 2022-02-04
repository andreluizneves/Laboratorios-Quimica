<?php

    require __DIR__ . "/../App/Config/App.php";

    $obj = "App\\Controllers\\" . ucfirst($_GET["entity"]) . "Controller";

    (new $obj())->New($_POST, $_FILES["photo"] ?? null);