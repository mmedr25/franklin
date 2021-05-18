<?php
include 'connect.php';

$firstname = (isset($_POST["firstname"])) ? $_POST["firstname"] : "";
$lastname = (isset($_POST["lastname"])) ? $_POST["lastname"] : "";
$email = (isset($_POST["email"])) ? $_POST["email"] : "";
$message = (isset($_POST["message"])) ? $_POST["message"] : "";

if (!empty($firstname) && !empty($lastname) && !empty($email)) {

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // send a message
        return false;  
    } 
    $sql = "INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `message`) VALUES (NULL, :firstname, :lastname, :email, :message)";
    $prepare = $con->prepare($sql);
    $prepare->bindParam(":firstname", $firstname);
    $prepare->bindParam(":lastname", $lastname);
    $prepare->bindParam(":email", $email);
    $prepare->bindParam(":message", $message);
    $prepare->execute();

    // if field add in database
    if ($prepare->execute()) {
        $to = $email;
        $subject = "formulaire de contact";

        $mailBody = file_get_contents('templates/email.html');
        $mailBody = str_replace("{{firstname}}", $firstname, $mailBody);
        $mailBody = str_replace("{{lastname}}", $lastname, $mailBody);
        $mailBody = str_replace("{{email}}", $email, $mailBody);
        $mailBody = str_replace("{{message}}", $message, $mailBody);

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <montheeric1@gmail.com>' . "\r\n";
        // $headers .= 'Cc: myboss@example.com' . "\r\n";

        mail($to,$subject,$mailBody,$headers);
    }
}


