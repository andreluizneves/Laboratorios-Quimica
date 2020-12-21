<?php

    include('../../banco/conexao.php');
   
    if($conexao){

        $request = $_POST;

        $sql = "SELECT id_relatorio_vidraria, id_relatorio, nome, id_lab, v.id_vidraria FROM vidrarias v INNER JOIN relatorios_vidrarias rv ON v.id_vidraria = rv.id_vidraria WHERE v.id_vidraria = $request[id_vidraria]";

        $sql_foto = "SELECT foto FROM vidrarias WHERE id_vidraria = $request[id_vidraria]";

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
                'msg' => "Vidraria não pode ser deletado pois possui registros de relatório(s) relacionado(s)."
            );
        } else {
            
            $sql = "DELETE FROM vidrarias WHERE id_vidraria = $request[id_vidraria]";

            $resultado = mysqli_query($conexao, $sql);
            if($resultado){
                $dados = array(
                    'icone' => 'success',
                    'msg' => "Vidraria deletada com êxito."
                );
                unlink($dadosa['dados']['foto']);

            } else {
                $dados = array(
                    'icone' => 'error',
                    'msg' => "Não foi possível deletar a Vidraria.",
                    $sql
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