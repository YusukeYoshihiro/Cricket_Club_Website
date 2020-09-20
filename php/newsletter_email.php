<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('./config/db_connect.php');
require('./PHPMailer/src/PHPMailer.php');
require('./PHPMailer/src/SMTP.php');



    // make sql
    $sql = "SELECT name, email FROM newsletter";

    // get query result
    $result = mysqli_query($conn, $sql);


    // fetch result in array format

    // Fetch all
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Free result set
    mysqli_free_result($result);

    mysqli_close($conn);

    foreach ($users as $user) {
        echo $user['name'] . ' '.$user['email'] . ' '; 
       
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls'; 
        $mail->Host = 'smtp.live.com';  //outlook
        // $mail->Host = 'smtp.gmail.com';  //gmail 
        
        $mail->Port = 587; 
        
        $mail->Username = 'xxxxx@hotmail.com'; 
        $mail->Password = 'xxxxx'; 
        
        $mail->setFrom('xxxxx@hotmail.com', 'Newsletter WestVan'); 
        $mail->addAddress($user['email'], 'West Vancouver Cricket Club');
        
       

        $mail->Subject = 'Newsletter WestVan';
        $mail->Body    = 'Dear <b>'.$user['name'].'</b><br> Here is your Newsletter';
        $mail->addAttachment('./cricket_test.pdf', 'newsletter_test.pdf');
        $mail->IsHTML(true);
        
        if($mail->send()){
            echo 'Message has been sent';
        }else{
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

        echo  '<br>';
    }

?>