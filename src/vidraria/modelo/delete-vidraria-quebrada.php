<?php

    include('../../banco/conexao.php');
   
    if($conexao){

        $request = $_POST;

        $sql_foto = "SELECT foto FROM vidrarias_quebradas WHERE id_vidraria_quebrada = $request[id_vidraria_quebrada]";

        $resultado_foto = mysqli_query($conexao, $sql_foto);

        $dados2 = mysqli_fetch_assoc($resultado_foto);

        $dadosa = array(
            'dados' => $dados2,
            'sql' => $sql
        );

        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_num_rows($resultado);

        if($linha > 0){
            $dados = array(
                'icone' => 'info',
                'msg' => "Vidraria Quebrada não pode ser deletada pois possui registros de relatório(s) relacionado(s)."
            );
        } else {
            
            $sql = "DELETE FROM vidrarias_quebradas WHERE id_vidraria_quebrada = $request[id_vidraria_quebrada]";

            $resultado = mysqli_query($conexao, $sql);
            if($resultado){
                $dados = array(
                    'icone' => 'success',
                    'msg' => "Vidraria Quebrada deletada com êxito."
                );
                unlink($dadosa['dados']['foto']);

            } else {
                $dados = array(
                    'icone' => 'error',
                    'msg' => "Não foi possível deletar a Vidraria Quebrada."
                );
            }
        }

    } else{

        $dados = array(
            'msg' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );

    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);