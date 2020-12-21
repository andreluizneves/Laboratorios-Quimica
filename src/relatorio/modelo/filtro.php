<?php

    include('../../banco/conexao.php');

    session_start();

    if($conexao){

        $request = $_POST;
        $filtro = trim($request['filtro']);
        $sql = "SELECT r.id_relatorio, DATE_FORMAT(data_hora, '%d/%m/%Y ás %H:%i:%s') as data_hora, titulo, 
        p.nome as nome_professor, l.nome AS laboratorio FROM relatorios r
        INNER JOIN professores p ON p.id_professor = r.id_professor
        INNER JOIN labs l ON l.id_lab = r.id_lab WHERE titulo LIKE '%".$filtro."%' ORDER BY titulo";
        $resultado = mysqli_query($conexao, $sql);
        $linhas = mysqli_num_rows($resultado);

        if($linhas > 0){

            while($linha = mysqli_fetch_assoc($resultado)){
                $dadosTipo[] = $linha;
            }
            
            $dados = array(
                'dados' => $dadosTipo,
                'status' => 'ok',
                'user' => $_SESSION['tipo_user']
            );

        }

        mysqli_close($conexao);

    } else{
        $dados = array(
            'mensagem' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );
    }
    
    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);