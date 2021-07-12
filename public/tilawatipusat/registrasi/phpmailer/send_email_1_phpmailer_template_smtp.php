<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Potenza - Job Application Form Wizard with Resume upload and Branch feature">
    <meta name="author" content="Ansonika">
    <title>Potenza | Job Application Form Wizard by Ansonika</title>

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="../css/custom.css" rel="stylesheet">
    
    <script type="text/javascript">
    function delayedRedirect(){
        window.location = "../index.html"
    }
    </script>

</head>
<body onLoad="setTimeout('delayedRedirect()', 8000)" style="background-color:#fff;">
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer(true);

try {

    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtpserver';                           // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'username';                             // SMTP username
    $mail->Password   = 'password';                             // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients - main edits
    $mail->setFrom('info@potenza.com', 'Message from POTENZA');                    // Email Address and Name FROM
    $mail->addAddress('jhon@potenza.com', 'Jhon Doe');                             // Email Address and Name TO - Name is optional
    $mail->addReplyTo('noreply@potenza.com', 'Message from POTENZA');              // Email Address and Name NOREPLY
    $mail->isHTML(true);                                                       
    $mail->Subject = 'Message from POTENZA';                                       // Email Subject

   //The email body message
    $message  = "<strong>Presentation</strong><br />";
    $message .= "First and Last Name: " . $_POST['name'];
    $message .= "<br />Email: " . $_POST['email'];
    $message .= "<br />Telephone: " . $_POST['phone'];
    $message .= "<br />Gender: " . $_POST['gender'];                
    
    /* FILE UPLOAD */
    if(isset($_FILES['fileupload'])){
    $errors= array();
    $file_name = $_FILES['fileupload']['name'];
    $file_size =$_FILES['fileupload']['size'];
    $file_tmp =$_FILES['fileupload']['tmp_name'];
    $file_type=$_FILES['fileupload']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['fileupload']['name'])));

    $expensions= array("pdf","doc","docx");// Define with files are accepted
                              
    $OriginalFilename = $FinalFilename = preg_replace('`[^a-z0-9-_.]`i','',$_FILES['fileupload']['name']); 
    $FileCounter = 1; 
    while (file_exists( '../upload_files/'.$FinalFilename )) // The folder where the files will be stored; set the permission folder to  0755. 
        $FinalFilename = $FileCounter++.'_'.$OriginalFilename; 

        if(in_array($file_ext,$expensions)=== false){
            $errors[]="Extension not allowed, please choose a .pdf, .doc, .docx file.";
        }
        // Set the files size limit. Use this tool to convert the file size param https://www.thecalculator.co/others/File-Size-Converter-69.html
        if($file_size > 153600){
            $errors[]='File size must be max 150Kb';
        }
        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"../upload_files/".$FinalFilename);
            $message .= "<br />Resume: http://www.yourdomain.com/upload_files/".$FinalFilename; // Write here the path of your upload_files folder
        }else{
            $message .= "<br />File name: no files uploaded";
            }
        };
        /* end FILE UPLOAD */

    $message .= "<br /><br /><strong>Work Availability</strong>";
    $message .= "<br />Are you available for work: " . $_POST['availability'];

        if (isset($_POST['minimum_salary_full_time']) && $_POST['minimum_salary_full_time'] != "")
            {
                $message .= "<br />Minimum salary: " . $_POST['minimum_salary_full_time'];
                $message .= "<br />How soon would you be looking to start? " . $_POST['start_availability_full_time'];
                $message .= "<br />Are you willing to work remotely? " . $_POST['remotely_full_time'];
            }
        if (isset($_POST['minimum_salary_part_time']) && $_POST['minimum_salary_part_time'] != "")
            {
                $message .= "<br />Minimum salary: " . $_POST['minimum_salary_part_time'];
                $message .= "<br />How soon would you be looking to start? " . $_POST['start_availability_part_time'];
                $message .= "<br />When you prefer to work? " . $_POST['day_preference_part_time'];
            }
        if (isset($_POST['fixed_rate_contract']) && $_POST['fixed_rate_contract'] != "")
            {
                $message .= "<br />Minimum fixed rate: " . $_POST['fixed_rate_contract'];
                $message .= "<br />Minimum hourly rate: " . $_POST['hourly_rate_contract'];
                $message .= "<br />Minimum hours for a contract: " . $_POST['minimum_hours_conctract'];
                $message .= "<br />Are you willing to work remotely? " . $_POST['remotely_contract'];
            }
                        
    $message .= "<br /><br />Terms and conditions accepted: " . $_POST['terms'];

	// Get the email's html content
    $email_html = file_get_contents('template-email.html');

    // Setup html content
    $body = str_replace(array('message'),array($message),$email_html);
    $mail->MsgHTML($body);

    $mail->send();

    // Confirmation/autoreplay email send to who fill the form
    $mail->ClearAddresses();
    $mail->isSMTP();
    $mail->addAddress($_POST['email']); // Email address entered on form
    $mail->isHTML(true);
    $mail->Subject    = 'Confirmation'; // Custom subject
    
    // Get the email's html content
    $email_html_confirm = file_get_contents('confirmation.html');

    // Setup html content
    $body = str_replace(array('message'),array($message),$email_html_confirm);
    $mail->MsgHTML($body);

    $mail->Send();

    echo '<div id="success">
            <div class="icon icon--order-success svg">
                 <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
                  <g fill="none" stroke="#8EC343" stroke-width="2">
                     <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                     <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                  </g>
                 </svg>
             </div>
            <h4><span>Request successfully sent!</span>Thank you for your time</h4>
            <small>You will be redirect back in 5 seconds.</small>
        </div>';
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

	
?>
<!-- END SEND MAIL SCRIPT -->   

</body>
</html>