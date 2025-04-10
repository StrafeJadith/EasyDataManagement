<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Asegúrate de tener PHPMailer instalado

function enviarCorreoCompra($correo, $nombre, $fecha, $nombre_producto, $cantidad, $nombre_pago, $totalsum22)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tiendalamanodedios08@gmail.com';
        $mail->Password = 'cikmzzyygmgprsbn';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('tiendalamanodedios08@gmail.com', 'EDM');
        $mail->addAddress($correo);

        $mail->isHTML(true);
        $mail->Subject = 'Compra realizada';
        $mail->Body = 'Hola, ' . $nombre . '<br> Gracias por tu compra en la tienda, aqui tienes un detalle de tu compra:  <br> Fecha compra: ' . $fecha . '<br> Nombre del producto: ' . $nombre_producto . '<br> Cantidad comprada: ' . $cantidad . '<br> Metodo de pago: ' . $nombre_pago . '<br> Total Compra: ' . $totalsum22 . '<br> Se notificara a su numero de telefono para la recoger el producto';

        $mail->send();
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
}
?>