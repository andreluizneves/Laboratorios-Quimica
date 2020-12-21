<?php

    include('../../banco/conexao.php');

    if($conexao){

        $request = $_POST;
        $foto = $_FILES['foto'];
        $foto_id = $foto['error'];
        $id_reagente = $request['id_reagente'];

        if($foto_id > 0){

            $sql = "UPDATE reagentes SET nome = '{$request['nome']}', quantidade = '{$request['quantidade']}', medida = '{$request['medida']}', id_lab = '{$request['laboratorio']}' WHERE id_reagente = '{$request['id_reagente']}'";

        } else{

            $pasta = "foto/";
            if(!file_exists('../' . $pasta)) mkdir('../' . $pasta, 0755);

            $nomeTemporario = $foto['tmp_name'];
            $nomeArquivo = $foto['name'];
            $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
            $novoNome = uniqid(time()) . '.' . $extensao; 
            $destino = $pasta . $novoNome;           

            if(move_uploaded_file($nomeTemporario, '../' . $destino)){

                if($extensao == "jpeg" || $extensao == "png" || $extensao == "jpg" || $extensao == "JPEG" || $extensao == "PNG" || $extensao == "JPG"){
                    
                    $sql_foto = "SELECT foto FROM reagentes WHERE id_reagente = $request[id_reagente]";

                    $sql = "UPDATE reagentes SET nome = '{$request['nome']}', quantidade = '{$request['quantidade']}', foto = '../{$destino}', medida = '{$request['medida']}', id_lab = '{$request['laboratorio']}' WHERE id_reagente = '{$request['id_reagente']}'";
                       
                    $resultado_foto = mysqli_query($conexao, $sql_foto);

                    $dados2 = mysqli_fetch_assoc($resultado_foto);
                    
                    $dadosa = array(
                        'dados' => $dados2,
                        'sql' => $sql
                    );
                } else{

                    $dados = array(
                        'msg' => 'Formato de arquivo não suportado',
                        'icone' => 'error'
                    );
                    
                    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                    exit;
                }
            }
        }

        $resultado = mysqli_query($conexao, $sql);

        if($resultado){
            $dados = array(
                'icone' => 'success',
                'msg' => 'Reagente Atualizado'
            );
            unlink($dadosa['dados']['foto']);
        } else{
            $dados = array(
                'icone' => 'warning',
                'msg' => 'Nada para se alterar'
            );
        }
        
        mysqli_close($conexao);

    } else{
        $dados = array(
            'msg' => "Erro [042]" . "<br>" . "Ocorreu um erro interno no servidor 😕",
            'icone' => 'error'
        );
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);