<?php
/**
 * Created by PhpStorm.
 * User: Pawlusha
 * Date: 11/26/2017
 * Time: 05:38 PM
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'lib/PHPMailer-master/src/Exception.php';
require 'lib/PHPMailer-master/src/PHPMailer.php';
require 'lib/PHPMailer-master/src/SMTP.php';

$MAX_FILE_SIZE = 1024*1024; //1 MB

if(isset($_FILES["file"]["type"]) && isset($_POST["email"])) {

    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg"))
        && ($_FILES["file"]["size"] < $MAX_FILE_SIZE)) {

        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
        } else {
            $sourcePath = $_FILES['file']['tmp_name'];

            $fileTypeSplit = explode("/", $_FILES["file"]["type"]);
            $targetPath = "upload/".md5(rand(1,9999999)).".".end($fileTypeSplit);

            move_uploaded_file($sourcePath,$targetPath) ;
            echo "<img id='croppedImage' src='/".$targetPath."' download />";

            sendEmail($_POST["email"], $targetPath);
        }
    } else {
        echo "<span id='invalid'>Invalid file Size or Type<span>";
    }
}

function sendEmail($email, $imgPath) {
    $EMAIL = '';
    $PASSWORD = '';
    $SMTPHOST = 'smtp.gmail.com';

    $mail = new PHPMailer(true);
    $mail->IsSMTP();

    try {
        $mail->Host= $SMTPHOST;
        $mail->Port= 25;
        $mail->SetFrom($EMAIL);
        $mail->SMTPAuth = true;
        $mail->Username = $EMAIL;
        $mail->Password = $PASSWORD;
        $mail->AddAddress($email);
        $mail->Subject = 'Cropped image.';
        $mail->Body = '<html><body><p>attached image:</p></body></html>';
        $mail->AddEmbeddedImage($imgPath, "my-attach", $imgPath);
        $mail->Send();
    } catch (phpmailerException $e) {
        echo $e->errorMessage();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

