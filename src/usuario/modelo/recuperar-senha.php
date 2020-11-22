<?php   

    include("../../banco/conexaod.php");
    include("../../../recursos/libs/PHPMailer-master/PHPMailerAutoload.php");

    // Inicia a classe PHPMailer 
    $mail = new PHPMailer(); 

    // Método de envio 
    $mail->IsSMTP(); 

    // Enviar por SMTP 
    $mail->Host = "http://localhost/Repositorio-Quimica/src/usuario/modelo/email.php"; 

    // Você pode alterar este parametro para o endereço de SMTP do seu provedor 
    $mail->Port = 3306; 


    // Usar autenticação SMTP (obrigatório) 
    $mail->SMTPAuth = true; 

    // Usuário do servidor SMTP (endereço de email) 
    // obs: Use a mesma senha da sua conta de email 
    $mail->Username = 'marioguietec@gmail.com'; 
    $mail->Password = '10123445613'; 

    // Configurações de compatibilidade para autenticação em TLS 
    $mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 

    // Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 
    $mail->SMTPDebug = 2; 

    // Define o remetente 
    // Seu e-mail 
    $mail->From = "marioguietec@gmail.com"; 

    // Seu nome 
    $mail->FromName = "Mário"; 

    // Define o(s) destinatário(s) 
    $mail->AddAddress('mariogui167@gmail.com', 'Mário'); 

    // Opcional: mais de um destinatário
    // $mail->AddAddress('fernando@email.com'); 

    // Opcionais: CC e BCC
    // $mail->AddCC('joana@provedor.com', 'Joana'); 
    // $mail->AddBCC('roberto@gmail.com', 'Roberto'); 

    // Definir se o e-mail é em formato HTML ou texto plano 
    // Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
    $mail->IsHTML(true); 

    // Charset (opcional) 
    $mail->CharSet = 'UTF-8'; 

    // Assunto da mensagem 
    $mail->Subject = "Assunto da mensagem"; 

    // Corpo do email 
    $mail->Body = 'Aqui entra o conteudo texto do email'; 

    // Opcional: Anexos 
    // $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf"); 

    // Envia o e-mail 
    $enviado = $mail->Send(); 

    // Exibe uma mensagem de resultado 
    if ($enviado) 
    { 
        echo "Seu email foi enviado com sucesso!"; 
    } else { 
        echo "Houve um erro enviando o email: ".$mail->ErrorInfo; 
    }