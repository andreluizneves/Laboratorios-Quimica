<?php

    require __DIR__ . "/../App/Config/App.php";

    $obj = "App\\Controllers\\" . ucfirst($_GET["entity"]) . "Controller";

    (new $obj())->Search($_POST["search"]);