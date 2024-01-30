<?php
// Importar as classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Carregar o autoloader do composer
require 'vendor/autoload.php';

function mailReseteSenha($nome, $email, $login, $senha, $assunto){

        // Instância da classe
        $mail = new PHPMailer(true);
        try
        {
            // Configurações do servidor
            $mail->isSMTP();

            // Informações específicas
            $mail->CharSet = "UTF-8";
            $mail->Host = '172.22.0.162';

            // Define o remetente
            $mail->setFrom('portal.pesquisas@ceadis.org.br', 'CEADIS - Portal Pesquisas');

            // Define o destinatário

            $mail->addAddress($email, $nome);

            // E-mail oculto
            $mail->addBCC('sistemas@ceadis.org.br', $nome);

            // Conteúdo da mensagem
            $mail->isHTML();  // Seta o formato do e-mail para aceitar conteúdo HTML

            $mail->Subject = $assunto;
            $mail->Body    = "Olá $nome,<br><br>Segue sua nova senha de acesso ao <strong>Portal Pesquisas - CEADIS</strong><br><br>

                                Login: <strong>$login</strong><br>
                                Senha provisória: <strong>$senha</strong><br><br>
                                Link: http://ceadis.org.br/painel-pesquisa/<br><br>

                                <u> Por favor, não responder este e-mail.</u>";

            // Enviar
            $mail->send();

        }
        catch (Exception $e)
        {
            //print $e->getMessage();
            return FALSE;
        }

        return TRUE;
}

function mailNotificacao($assunto_pesquisa, $titulo_pesquisa, $email, $primeiro_nome, $login, $tempo_estimado){
//function mailNotificacao($titulo_pesquisa, $emails_pesquisa, $assunto_pesquisa){

    // Instância da classe
    $mail = new PHPMailer(true);
    try
    {
        // Configurações do servidor
        $mail->isSMTP();

        // Informações específicas
        $mail->CharSet = "UTF-8";
        $mail->Host = '172.22.0.162';

        // Define o remetente
        $mail->setFrom('portal.pesquisas@ceadis.org.br', 'CEADIS - Portal Pesquisas');

        // Define o destinatário

        $mail->addAddress($email, $primeiro_nome);

        // E-mail oculto
        $mail->addBCC('sistemas@ceadis.org.br', $primeiro_nome);

        $mail->AddEmbeddedImage('../assets/img/assinatura-email.png', 'Assinatura');
        $mail->AddEmbeddedImage('../assets/img/favicon.png', 'Logotipo');
        $mail->AddEmbeddedImage('../assets/img/imgmail2.png', 'Pesquisa');

        // Conteúdo da mensagem
        $mail->isHTML();  // Seta o formato do e-mail para aceitar conteúdo HTML

        $mail->Subject = $assunto_pesquisa;
        $mail->Body    = "Olá $primeiro_nome,<br><br>
			<h2>A PESQUISA DE SATISFAÇÃO DO CEADIS ESTÁ DE CARA NOVA</h2>

                        Para responder,
                                clique no link:<h3><strong> http://ceadis.org.br/painel-pesquisa </strong></h3>
                                e informe seu login e senha utilizado para acessar
                                o Portal Estoque Web.<br><br>

                        Esta pesquisa ficará disponível para responder até
                                02/02/2024<br><br>

                        Contamos com a sua colaboração, é bem rapidinho,
                                não levará mais que 3 minutos para responder!<br><br>

                        <table>
                                <td><img src='cid:Pesquisa'/></td>
                        </table>";


        // Enviar
        $mail->send();

    }
    catch (Exception $e)
    {
        //print $e->getMessage();
        return FALSE;
    }

    return TRUE;
}
