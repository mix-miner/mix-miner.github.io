
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['email']) || !isset($data['duration'])) {
    echo json_encode(["message" => "Eksik veri gönderildi."]);
    exit;
}
$email = $data['email'];
$duration = $data['duration'];
$key = strtoupper(bin2hex(random_bytes(4)) . '-' . bin2hex(random_bytes(2)));
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'electromercadoshopier@gmail.com';
    $mail->Password = 'Qm590suha@';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('electromercadoshopier@gmail.com', 'Mix Miner');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Mix Miner Lisans Anahtarınız';
    $mail->Body    = "<h3>Lisans Anahtarınız:</h3><p><strong>{$key}</strong></p><p>Süre: {$duration}</p>";
    $mail->send();
    echo json_encode(["message" => "Lisans anahtarı gönderildi."]);
} catch (Exception $e) {
    echo json_encode(["message" => "Mail gönderilemedi. Hata: {$mail->ErrorInfo}"]);
}
?>
