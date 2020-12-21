<?php

    include('../../banco/conexao.php');
    
    if($conexao){

        $request = $_POST;

        $sql = "SELECT id_relatorio_reagente, id_relatorio, nome, id_lab, r.id_reagente FROM reagentes  INNER JOIN relatorios_reagentes rr ON r.id_reagente = rr.id_reagente WHERE r.id_reagente = $request[id_reagente]";
        
        $sql_foto = "SELECT foto FROM reagentes WHERE id_reagente = $request[id_reagente]";

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
                'msg' => "Reagente não pode ser deletado pois possui registros de relatórios relacionado(s)."
            );
        } else {
            
            $sql = "DELETE FROM reagentes WHERE id_reagente = $request[id_reagente]";

            $resultado = mysqli_query($conexao, $sql);
            if($resultado){
                $dados = array(
                    'icone' => 'success',
                    'msg' => "Reagente deletado com sucesso.",
                    'sql' => $sql
                );
                unlink($dadosa['dados']['foto']);
            } else {
                $dados = array(
                    'icone' => 'warning',
                    'msg' => "O Reagente não pode ser deletado pois possui registros de relatórios relacionado(s).",
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