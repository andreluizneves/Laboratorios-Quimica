<?php

    include('../../banco/conexao.php');

    if($conexao){

            $requestData = $_REQUEST;

                  
            $sql = "SELECT id_relatorio, titulo FROM relatorios WHERE 1=1";

            $resultado = mysqli_query($conexao, $sql);

            if($resultado && mysqli_num_rows($resultado) > 0){

                $dadosTipo = [];
                while($linha = mysqli_fetch_assoc($resultado)){
                    $dadosTipo[] = $linha;
                }

                $dados = array(
                    'mensagem' => "",
                    'dados' => $dadosTipo,
                    'status' => 'ok'
                );
            } else {
                $dados = array(
                    'msg' => "Nada catalogado nos registros",
                    'icone' => 'error',
                    'status' => 'nenhum'
                );
    
            }        
        
        mysqli_close($conexao);

    } else{
        $dados = array(
            'tipo' => TP_MSG_ERROR,
            'mensagem' => "Não foi possível obter uma conexão.",
            'dados' => array()
        );
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
