<?php

    include('../../banco/conexao.php');

    if($conexao){

        session_start();

        $id_relatorio = $_SESSION['id-list'];

        $request = $_POST;

        if(!empty($request['draw']) || isset($request['draw'])){

            $colunas = $request['columns'];

            //1ª etapa para a consulta do DataTable
            $sql = "SELECT r.id_relatorio, titulo, e.nome AS equipamento, rg.nome AS reagente, v.nome AS vidraria FROM relatorios r LEFT JOIN relatorios_equipamentos re ON r.id_relatorio = re.id_relatorio LEFT JOIN relatorios_reagentes rr ON r.id_relatorio = rr.id_relatorio LEFT JOIN relatorios_vidrarias rv ON r.id_relatorio = rv.id_relatorio LEFT JOIN equipamentos e ON re.id_equipamento = e.id_equipamento LEFT JOIN reagentes rg ON rr.id_reagente = rg.id_reagente LEFT JOIN vidrarias v ON rv.id_vidraria = v.id_vidraria WHERE r.id_relatorio = $id_relatorio";

            $resultado = mysqli_query($conexao, $sql);
            $dados = array();
            while($linha = mysqli_fetch_assoc($resultado)){
                $dados[] = $linha;
            }

            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => intval($totalRegistros),
                "recordsFiltered" => intval($totalFiltrados),
                "data" => $dados,
                $sql
            );

        } else {
            $json_data = array(
                "draw" => 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => array(),
                $sql
            );
        }

        mysqli_close($conexao);

    } else {
        $json_data = array(
            "draw" => 0,
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => array(),
            $sql
        );
    }

    echo json_encode($json_data,  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);