
<?php

session_start();
session_cache_expire(30);
include_once('database/dbPersons.php');
include_once('domain/Person.php');
$id = str_replace("_"," ",$_GET["id"]);
$person = retrieve_person($_SESSION['_id']);
if (!$person) { // try again by changing blanks to _ in id
    $id = str_replace(" ","_",$_GET["id"]);
    $person = retrieve_person($id);
    if (!$person) {
        echo('<p id="error">Error: there\'s no person with this id in the database</p>' . $id);
        die();
    }
}
?>

<html>
    <head>
        <title>
            Editing <?PHP echo($person->get_first_name() . " " . $person->get_last_name()); ?>
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
                    include('resetPasswordForm.inc');
                else {
                    //in this case, the form has been submitted, so validate it
                    $errors = validate_reset($person);  //step one is validation.
                    // errors array lists problems on the form submitted
                    if ($errors) {
                        // display the errors and the form to fix
                        show_errors($errors);
                        // $person = new Person($person->get_first_name(), $_POST['last_name'], $person->get_phone(), 
                        // 		        $_POST['email'], 
                        //                 $_POST['old_pass']);
                        include('resetPasswordForm.inc');
                    }
                    // this was a successful form submission; update the database and exit
                    else
                        process_form($id,$person);
                        echo "</div>";
                    include('footer.inc');
                    echo('</div></body></html>');
                    die();
                }

                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function process_form($id,$person) {
                    $path = strrev(substr(strrev($_SERVER['SCRIPT_NAME']), strpos(strrev($_SERVER['SCRIPT_NAME']), '/')));
                    if (change_password($person->get_id(), md5($_POST['new_password'])))
                    {
                        echo('<p>You have successfully reset <a href="' . $path . 'resetPassword.php?id=' . $person->get_id() . '"><b>' . $person->get_id(). ' </b></a>\'s password in the database.</p>');
                    }
                    else
                    {
                        echo('<p>You have failed reset <a href="' . $path . 'resetPassword.php?id=' . $id . '"><b>' . $id. ' </b></a>\'s in the database.</p>');
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>




