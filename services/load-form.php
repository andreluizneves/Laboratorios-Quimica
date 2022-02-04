<?php

    require __DIR__ . "/../App/Config/App.php";

    use App\Controllers\PageController;

    (new PageController)->LoadForm(ucfirst($_GET["entity"]));