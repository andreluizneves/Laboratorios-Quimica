<?php

    include('../../banco/conexao.php');

    if($conexao){

        $requestData = $_REQUEST;

        if(!empty($requestData['draw']) || isset($requestData['draw'])){

            $colunas = $requestData['columns'];

            //1ª etapa para a consulta do DataTable
            $sql = "SELECT id_relatorio, data_hora, descricao, id_professor FROM relatorios WHERE 1=1";

            $resultado = mysqli_query($conexao, $sql);
            $totalRegistros = mysqli_num_rows($resultado);

            //2ª etapa para obter o total de registros filtrados
            $filtro = $requestData['search']['value'];
            if(!empty($filtro)){
                $sql .= " AND (id_relatorio LIKE '$filtro%' ";
                $sql .= " OR nome LIKE '$filtro%') "; 
            }

            $resultado = mysqli_query($conexao, $sql);
            $totalFiltrados = mysqli_num_rows($resultado);

            //3ª etapa obter a ordem juntamente o limite
            $colunaOrdem = $requestData['order'][0]['column'];
            $ordem = $colunas[$colunaOrdem]['data'];
            $direcao = $requestData['order'][0]['dir'];

            $inicio = $requestData['start'];
            $tamanho = $requestData['length'];

            $sql .= " ORDER BY $ordem $direcao LIMIT $inicio, $tamanho"; 

            $resultado = mysqli_query($conexao, $sql);
            $dados = array();
            while($linha = mysqli_fetch_assoc($resultado)){
                $dados[] = array_map('utf8_encode', $linha);
            }

            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalRegistros),
                "recordsFiltered" => intval($totalFiltrados),
                "data" => $dados
            );

        } else {
            $json_data = array(
                "draw" => 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => array()
            );
        }

        mysqli_close($conexao);

    } else {
        $json_data = array(
            "draw" => 0,
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => array()
        );
    }

    echo json_encode($json_data,  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

  