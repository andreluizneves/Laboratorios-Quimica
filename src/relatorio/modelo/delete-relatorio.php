<?php

    include('../../banco/conexao.php');

    if($conexao){
        session_start();
        $request = $_POST;

        $id_relatorio = isset($request['id_relatorio']) ? $request['id_relatorio'] : '';

        $sql_inicial = "SELECT * FROM relatorios";
        $resultado_linha = mysqli_query($conexao, $sql_inicial);
        $linhaInicial = mysqli_num_rows($resultado_linha);

        $sql = "DELETE FROM relatorios WHERE id_relatorio = $id_relatorio AND id_professor = '$_SESSION[id]'";
        $resultado = mysqli_query($conexao, $sql);
        $linhaFinal = mysqli_num_rows($resultado);
        
        if($linhaFinal != $linhaInicial){
            
            $dados = array(
                'icone' => 'info',
                'msg' => 'Apenas o Professor criador do relatório responsável pode deletar este relatório',
                $sql
            );
            echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            exit;

        } else{
            $sql_equipamento = "DELETE FROM relatorios_equipamentos WHERE id_relatorio = $id_relatorio";
            $sql_reagente = "DELETE FROM relatorios_reagentes WHERE id_relatorio = $id_relatorio";
            $sql_vidraria = "DELETE FROM relatorios_vidrarias WHERE id_relatorio = $id_relatorio";
            $sql_vidraria_quebrada = "DELETE FROM vidrarias_quebradas WHERE id_relatorio = $id_relatorio";

            $resultado_equipamento = mysqli_query($conexao, $sql_equipamento);
            $resultado_reagente = mysqli_query($conexao, $sql_reagente);
            $resultado_vidraria = mysqli_query($conexao, $sql_vidraria);
            $resultado_vidraria_quebrada = mysqli_query($conexao, $sql_vidraria_quebrada);

            $sql = "DELETE FROM relatorios WHERE id_relatorio = $id_relatorio AND id_professor = '$_SESSION[id]'";
            $resultado = mysqli_query($conexao, $sql);
            
            $dados = array(
                'icone' => 'success',
                'msg' => 'Relatório e seus registros do que foi usado apagado com êxito',
                mysqli_affected_rows($conexao)
            );
        }
    } else {
        $dados = array(
            'msg' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);