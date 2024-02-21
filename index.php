<?php 
$nombre= $_POST["nombre"];
$correo= $_POST["correo"];
$telefono= $_POST["telefono"];
$mensaje= $_POST["mensaje"];

$body= "Nombre: ".$nombre."<br>Correo: ".$correo."<br>Telefono: ".$telefono."<br>Mensaje: ".$mensaje;
/*
$destino="adrianperera@outlook.com";
mail($destino,"Contacto",$body);
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php'; 

// La creación de instancias y pasar `true` habilita las excepciones
$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->SMTPDebug = 0;                      // Habilita la salida de depuración detallada
    $mail->isSMTP();                                            // Enviar usando SMTP 
    $mail->Host       = 'smtp.gmail.com';                // Configure el servidor SMTP para enviar a través de
    $mail->SMTPAuth   = true;                                    // Habilitar autenticación SMTP
    $mail->Username   = 'adrianperera73@gmail.com';                     // Nombre de usuario SMTP
    $mail->Password   = 'adri1235+';                               // Contraseña SMTP
    $mail->SMTPSecure = 'tls';         // Habilita el cifrado TLS; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // Puerto TCP para conectarse, use 465 para `PHPMailer::ENCRYPTION_SMTPS` above

    // Destinatarios
    $mail->setFrom('adrianperera73@gmail.com', $nombre);
    $mail->addAddress('adrianperera73@gmail.com');     // Agregar un destinatario
    

    //$mail->addAddress('ellen@example.com');               // El nombre es opcional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Adjuntos 
    //$mail->addAttachment('/var/tmp/file.tar.gz');          // Agregar archivos adjuntos
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Nombre opcional

    // Contenido
    $mail->isHTML(true);                                 // Establezca el formato de correo electrónico en HTML
    $mail->Subject = 'Prueba de envio de correo';//'Aquí está el asunto';
    $mail->Body    = $body;//'¡ Este es el cuerpo del mensaje HTML <b> en negrita! </b>';
    $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
    );
    $mail->CharSet='UTF-8';
    //$mail->AltBody = 'Este es el cuerpo en texto plano para clientes de correo que no son HTML';

    $mail->send();
    echo '<script>
        alert("El mensaje se envio correctamente");
        window.history.go(-1);
        </script>';

} catch (Exception $e) {
    echo 'No se pudo enviar el mensaje. ', $mail->ErrorInfo;
}
?>
