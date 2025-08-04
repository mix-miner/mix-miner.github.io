
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$email = $_POST['email'] ?? '';
$duration = $_POST['duration'] ?? '';

if (!$email || !$duration) {
    header("Location: index.html?msg=Geçersiz istek.");
    exit;
}

$key = strtoupper(substr(md5(uniqid()), 0, 4) . '-' . substr(md5(uniqid()), 4, 4) . '-' . substr(md5(uniqid()), 8, 4));

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'electromercadoshopier@gmail.com';
    $mail->Password = 'wgjq krbj urcm nrnu';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('electromercadoshopier@gmail.com', 'Mix Miner');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Mix Miner Lisans Anahtarınız';
    $mail->Body    = '<h3>Mix Miner Lisans Anahtarınız:</h3><p><b>' . $key . '</b><br>Süre: ' . $duration . '</p>';

    $mail->send();
    header("Location: index.html?msg=Anahtar başarıyla gönderildi.");
} catch (Exception $e) {
    header("Location: index.html?msg=Mail gönderilemedi. Hata: {$mail->ErrorInfo}");
}
?>
