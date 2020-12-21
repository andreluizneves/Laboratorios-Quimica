<?php

    include('../../banco/conexao.php');
    
    if($conexao){

        $request = $_POST;

        $sql = "SELECT id_relatorio_equipamento, id_relatorio, nome, id_lab, e.id_equipamento FROM equipamentos e INNER JOIN relatorios_equipamentos r ON e.id_equipamento = r.id_equipamento WHERE e.id_equipamento = $request[id_equipamento]";
        
        $sql_foto = "SELECT foto FROM equipamentos WHERE id_equipamento = $request[id_equipamento]";

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
                'msg' => "Equipamento não pode ser deletado pois possui registros de relatórios relacionado(s)."
            );
        } else {
            
            $sql = "DELETE FROM equipamentos WHERE id_equipamento = $request[id_equipamento]";

            $resultado = mysqli_query($conexao, $sql);
            if($resultado){
                $dados = array(
                    'icone' => 'success',
                    'msg' => "Equipamento deletado com sucesso.",
                    'sql' => $sql
                );
                unlink($dadosa['dados']['foto']);
            } else {
                $dados = array(
                    'icone' => 'error',
                    'msg' => "Não foi possível deletar o equipamento."
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