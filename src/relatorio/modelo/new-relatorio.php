<?php

    include('../../banco/conexao.php');

    if($conexao){

        session_start();

        $request = $_POST;
        $lab = $request['laboratorio'];
        $dia = $request['data'];
        $hora = $request['hora'];
        $data_hora = $dia . ' ' . $hora;
        $professor = $_SESSION['id'];

        if($lab == 'externo'){
            $lab = 1;
        } else if ($lab == 'interno'){
            $lab = 2;
        } else{
            $lab = 3;
        }

        if($_SESSION['ids_reagente'] == null && $_SESSION['equipamento'] == null && $_SESSION['vidraria'] == null){

            $dados = array(
                'msg' => "Selecione o que foi utilizado na aula",
                'icone' => 'error'
            );
            echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            exit;

        } else{

            if($request['titulo'] != "" || $request['descricao'] != "" || $lab != "" || $dia != "" || $hora != ""){

                $sql = "INSERT INTO relatorios (titulo, descricao, data_hora, tempo, id_professor, id_lab) VALUES ('$request[titulo]', '$request[descricao]', '$data_hora', '$request[tempo]', $professor, $lab)";

                $resultado = mysqli_query($conexao, $sql);
                
                $id_relatorio_anterior = mysqli_insert_id($conexao);

            } else{

                $dados = array(
                    'mensagem' => "Preencha os campos vazios do formulário",
                    'icone' => 'error'
                );

            }

        } 

        if($_SESSION['ids_reagente'] != null){

            foreach($_SESSION['ids_reagente'] as $chave => $dado){

                // Ordem {$id:$quantidade}
                $informacoes = explode(":", $dado);
                $id_reagente = $informacoes[0];
                $quantidade_usada = $informacoes[1];

                //TABELA N:N (relatorios_reagentes)
                $sql_reagente = "INSERT INTO relatorios_reagentes (id_relatorio, id_reagente, quantidade) VALUES ($id_relatorio_anterior, $id_reagente, $quantidade_usada)";

                $resultado_reagente = mysqli_query($conexao, $sql_reagente);

                //DAR BAIXA NA QUANTIDADE DE REAGENTE (reagentes)
                $sql_baixa="UPDATE reagentes SET quantidade = quantidade - $quantidade_usada WHERE id_reagente = $id_reagente";


                $resultado_baixa = mysqli_query($conexao, $sql_baixa);
            }
        }
        if($_SESSION['equipamento'] != null){

            foreach($_SESSION['equipamento'] as $chave => $dado){
                // TABELA N:N (relatorios_equipamentos)
                $sql_equipamento="INSERT INTO relatorios_equipamentos (id_relatorio, id_equipamento) VALUES ($id_relatorio_anterior, $dado)";
                            
                $resultado_equipamento = mysqli_query($conexao, $sql_equipamento);

            }
        } 
        if($_SESSION['vidraria'] != null){

            foreach($_SESSION['vidraria'] as $chave => $dado){

                // TABELA N:N (relatorios_vidrarias)
                $sql_vidraria="INSERT INTO relatorios_vidrarias (id_relatorio, id_vidraria) VALUES ($id_relatorio_anterior, $dado)";

                $resultado_vidraria = mysqli_query($conexao, $sql_vidraria);

            }
        }
        if($resultado){
                $dados = array(
                    'icone' => 'success',
                    'msg' => 'Relatado com êxito',
                    'sql' => $sql_baixa
                );
                $_SESSION['ids_equipamento'] = array();
                $_SESSION['ids_reagente']['reagente'] = array(
                    'ids' => array(),
                    'uso' => array()
                );
                $_SESSION['ids_vidraria'] = array();
                
                unset($_SESSION['equipamento']);
                unset($_SESSION['vidraria']);

            }else{
                $dados = array(
                    'icone' => 'error',
                    'msg' => 'Preencha os campos vazios'
                );
            }

            mysqli_close($conexao);
        
    }else{
        $dados = array(
            'mensagem' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );
        echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        exit;
    }
   
    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);