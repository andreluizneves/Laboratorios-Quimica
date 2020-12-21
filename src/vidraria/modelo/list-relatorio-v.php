<?php

    include('../../banco/conexao.php');

    if($conexao){
        
        $sql = "SELECT id_relatorio, titulo FROM relatorios WHERE 1=1";
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
                'status' => 'ok'
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