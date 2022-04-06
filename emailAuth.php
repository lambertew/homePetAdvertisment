
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
require 'vendor/autoload.php';
  


session_start();
session_cache_expire(30);
include_once('database/dbPersons.php');
include_once('domain/Person.php');
// $id = str_replace("_"," ",$_GET["id"]);
// $person = retrieve_person($_SESSION['_id']);
// if (!$person) { // try again by changing blanks to _ in id
//     $id = str_replace(" ","_",$_GET["id"]);
//     $person = retrieve_person($id);
//     if (!$person) {
//         echo('<p id="error">Error: there\'s no person with this id in the database</p>' . $id);
//         die();
//     }
// }
?>

<html>
    <head>
        <title>
            Email Authentication
        </title>
        <link rel="stylesheet" href="lib/jquery-ui.css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <script src="lib/jquery-1.9.1.js"></script>
		<script src="lib/jquery-ui.js"></script>
    </head>
    <body>
        <div id="container">
            <?PHP include('header.php'); ?>
            <div id="content">
                <?PHP
                include('personValidate.inc');
                if ($_POST['_form_submit'] != 1)
                //in this case, the form has not been submitted, so show it
                    include('emailAuthForm.inc');
                else if (($_POST['_form_submit'] == 1) && ($_POST['_form_submit_2'] != 1))
                {
                    //in this case, the form has been submitted, so validate it
                    $errors = valid_email($_POST['email']);  //step one is validation.
                    // errors array lists problems on the form submitted
                    if (!$errors) {
                        // display the errors and the form to fix
                        echo('<div class="warning">');
                        echo('<ul>');
                        echo("<li><strong><font color=\"red\">Malformed Email!</font></strong></li>\n");
                        echo("</ul></div></p>");
                        // $person = new Person($person->get_first_name(), $_POST['last_name'], $person->get_phone(), 
                        // 		        $_POST['email'], 
                        //                 $_POST['old_pass']);
                        include('emailAuthForm.inc');
                    }
                    // this was a successful form submission; update the database and exit
                    else
                        send_email($_POST['email']);
                        //echo "</div>";
                        include("verificationCodeForm.inc");
                    include('footer.inc');
                    echo('</div></body></html>');
                    die();
                }
                else
                {
                    $error = verify_code($_POST['codeEntered']);
                    if (!$error)
                    {
                        echo('<div class="warning">');
                        echo('<ul>');
                        echo("<li><strong><font color=\"red\">Incorrect Verification Code</font></strong></li>\n");
                        echo("</ul></div></p>");
                        include('verificationCodeForm.inc');
                    }
                    else
                    {
                        echo "<script type=\"text/javascript\">window.location = \"petPostForm.php\";</script>";
                    }
                    include('footer.inc');
                    echo('</div></body></html>');
                    die();
                }

                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function send_email($email) {
                    $path = strrev(substr(strrev($_SERVER['SCRIPT_NAME']), strpos(strrev($_SERVER['SCRIPT_NAME']), '/')));
                    //echo 'Email ' . $email;
                    $mail = new PHPMailer(true);
                        
                        $mail->SMTPDebug = false;      
                                                      
                        $mail->isSMTP();        
                                                            
                        $mail->Host       = 'smtp.gmail.com;';                    
                        $mail->SMTPAuth   = true;                             
                        $mail->Username   = 'cpsc430spca2@gmail.com';                 
                        $mail->Password   = 'computerscience';                        
                        $mail->SMTPSecure = 'tls';                              
                        $mail->Port       = 587;  
                        //echo 'Made It Here';

                        $mail->setFrom('cpsc430spca2@gmail.com');           
                        $mail->addAddress($email);
                        //$mail->addAddress('receiver2@gfg.com', 'Name');
                        $verificationCode = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
                        $_SESSION['realCode'] = $verificationCode;
                        $mail->isHTML(true);                                  
                        $mail->Subject = 'SPCA Email Authentication!';
                        $mail->Body    = 'Here is your verification code <b>' . $verificationCode . '</b> Please enter it in your browser.';
                        $mail->AltBody = 'Please Work!';
                        try {
                            $mail->send();
                            echo "Message has been sent successfully";
                        } catch (Exception $e) {
                            echo "Mailer Error: " . $mail->ErrorInfo;
                        }
                }

                function verify_code($enteredCode)
                {
                    if ($_SESSION['realCode'] == $enteredCode)
                    {
                        return true;
                    }
                    return false;
                }
                ?>
            </div>
        </div>
    </body>
</html>




