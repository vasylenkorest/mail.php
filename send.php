<html>
<head>
    <title>Форма заявки с сайта</title>
</head>
<body>
<?php
include 'mail.php';

use Snipworks\Smtp\Email;

//проверяем, существуют ли переменные в массиве POST
if (!isset($_POST['fio']) and !isset($_POST['email'])) {
    ?>
    <form action="send.php" method="post">
        <input type="text" name="fio" placeholder="Укажите ФИО" required>
        <input type="text" name="email" placeholder="Укажите e-mail" required>
        <input type="submit" value="Отправить">
    </form> <?php
} else {
    $fio = trim(urldecode(htmlspecialchars($_POST['fio'])));
    $email = trim(urldecode(htmlspecialchars($_POST['email'])));


    $mail = new Email('smtp.ukr.net', 2525);
    $mail->setProtocol(Email::SSL);
    $mail->setLogin('exfat2@ukr.net', 'rXpb1Oh5ugMEoTKq');
    $mail->addTo('exfat@ukr.net', 'Example Receiver');
    $mail->setFrom('exfat2@ukr.net', 'Example Sender');
    $mail->setSubject("Заявка с сайта");
    $mail->setHtmlMessage("ФИО:" . $fio . ". E-mail: " . $email);
    if ($mail->send()) {
        echo "Сообщение успешно отправлено";
    } else {
        echo "При отправке сообщения возникли ошибки";
    }
}
?>
</body>
</html>
