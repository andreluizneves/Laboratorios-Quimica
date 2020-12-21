<?php

    include('../../banco/conexao.php');

    if($conexao){

        $request = $_POST;
        $id = isset($request['id_relatorio_vidraria']) ? $request['id_relatorio_vidraria'] : '';

        $sql = "SELECT * FROM relatorios WHERE id_relatorio <> '$id'";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_num_rows($resultado);

        if($linha == 0){

            $relatorio = array(
                'status' => 'nenhum',
                'sql' => $sql
            );  
        } else{

            while($linha = mysqli_fetch_assoc($resultado)){
                $dadosTipo[] = $linha;
            }

            $relatorio = array(
                'dados' => $dadosTipo,
                'status' => 'ok',
                $sql
            );
        }

        mysqli_close($conexao);
    } else {
        $relatorio = array(
            'msg' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );
    }

    echo json_encode($relatorio, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);