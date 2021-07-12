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
        window.location = "../index-2.html"
    }
    </script>

</head>
<body onLoad="setTimeout('delayedRedirect()', 8000)" style="background-color:#fff;">
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';

$mail = new PHPMailer(true);

try {

    //Recipients - main edits
    $mail->setFrom('info@potenza.com', 'Message from POTENZA');                    // Email Address and Name FROM
    $mail->addAddress('jhon@potenza.com', 'Jhon Doe');                             // Email Address and Name TO - Name is optional
    $mail->addReplyTo('noreply@potenza.com', 'Message from POTENZA');              // Email Address and Name NOREPLY
    $mail->isHTML(true);                                                       
    $mail->Subject = 'Message from POTENZA';                                       // Email Subject

    //The email body message
    $message  = "<strong>Experience</strong><br />";

    if (isset($_POST['experience_1']) && $_POST['experience_1'] != "")
        {
        $message .= "<br />Specialities:<br />";
        foreach($_POST['experience_1'] as $value)
            {
                $message.= "- " . trim(stripslashes($value)) . "<br />";
            };
        }
    if (isset($_POST['other_skills']) && $_POST['other_skills'] != "")
        {
            $message .= "<br />Other skills: " . $_POST['other_skills'] . "<br />";
        }

    $message .= "<br /><strong>Experience</strong>";
    $message .= "<br />Short Bio: " . $_POST['short_bio'];
    $message .= "<br />Personal Website: " . $_POST['personal_website'];
    $message .= "<br />Linkedin profile: " . $_POST['linkedin'];

    $message .= "<br /><br /><strong>Experience</strong>";
    $message .= "<br />First and Last Name: " . $_POST['name'];
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
                        
    $message .= "<br /><br />Terms and conditions accepted: " . $_POST['terms'];

	$mail->Body = "" . $message . "";

    $mail->send();

    // Confirmation/autoreplay email send to who fill the form
    $mail->ClearAddresses();
    $mail->addAddress($_POST['email']); // Email address entered on form
    $mail->isHTML(true);
    $mail->Subject    = 'Confirmation'; // Custom subject
    $mail->Body = "" . $message . "";

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