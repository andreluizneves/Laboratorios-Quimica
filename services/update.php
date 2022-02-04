<?php

    require __DIR__ . "/../App/Config/App.php";

    $obj = "App\\Controllers\\" . ucfirst($_GET["entity"]) . "Controller";

    (new $obj())->Update($_POST, $_FILES["photo"] ?? null);