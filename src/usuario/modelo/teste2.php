<?php

    $texto = 'Este é o texto a ser codificado';

    $textoCriptografado = base64_encode($texto);
    $textoDescriptografado = base64_decode($textoCriptografado);

    echo ("O valor do texto criptografado é:" . $textoCriptografado . "é seu valor original é" . $textoDescriptografado);

?>