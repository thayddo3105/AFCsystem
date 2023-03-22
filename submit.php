<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/functions.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/db_connection.php';
$result = $connection ->query("Select nome, CPF, senha, email, telefone, nivel_acesso from usuario");


while($user_data = mysqli_fetch_assoc($result)){

    $email = $user_data['email'];
    $nome = $user_data['nome'];

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;
        $mail->isSMTP();
        $mail->Host = CONTACTFORM_SMTP_HOSTNAME;
        $mail->SMTPAuth = true;
        $mail->Username = CONTACTFORM_SMTP_USERNAME;
        $mail->Password = CONTACTFORM_SMTP_PASSWORD;
        $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;
        $mail->Port = CONTACTFORM_SMTP_PORT;

        // Recipients
        $mail->setFrom('afcsystem385666@gmail.com', 'AFC System');
        $mail->addAddress("$email", "$nome");
        $mail->addReplyTo('afcsystem385666@gmail.com', 'Information');

        // Content
        $mail->Subject = 'Anomalia detectada!';
        $mail->Body    = "Temperaturas incomuns detectadas no laboratório $Num_Lab!";
        $mail->AltBody = "Temperaturas incomuns detectadas no laboratório $Num_Lab!";

        $mail->send();
        echo "Email enviado ($nome, $email), ";
    } catch (Exception $e) {
        echo "An error occurred while trying to send your message: ".$mail->ErrorInfo;
    }

};

?>