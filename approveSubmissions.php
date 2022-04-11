<?php
session_start();
session_cache_expire(30);
include_once('database/dbPetPost.php');
include_once('domain/PetPost.php');
include_once('petPost.php');
?>

<html>
    <head>
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
                $petpost = retrieve_awaiting_approval();
                $petname = $petpost->get_pet_name();
                if (!$petname)
                {
                    echo "No Pet Posts Awaiting Approval!";
                }
                else if ($_POST['_form_submit'] != 1)
                {
                    $petpostid = $petpost->get_id();
                    $ownerid = $petpost->get_owner_id();
		            $petname = $petpost->get_pet_name();
		            $pettype = $petpost->get_pet_type();
		            $petstory = $petpost->get_pet_story();
		            $petpicture = $petpost->get_pet_picture();
                    petPostTemplate($petpost, "Post Pending Approval");
                    include('approveSubmissionsForm.inc');
                }
                else {
                    $_POST['_form_submit'] == 0;
                    $petpost = retrieve_awaiting_approval();
                    $petpostid = $petpost->get_id();
                    process_approval($petpostid);
                    
                }
                echo "</div>";
                include('footer.inc');
                echo('</div></body></html>');
                die();

                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function process_approval($petpostid) {
                    //$path = strrev(substr(strrev($_SERVER['SCRIPT_NAME']), strpos(strrev($_SERVER['SCRIPT_NAME']), '/')));
                    if ($_POST['Choice'] == "Approve")
                    {
                        $result = update_approval($petpostid);
                        if ($result)
                        {
                            echo "Successfully approved!";
                        }
                        else
                        {
                            echo "Approve did not work!";
                        }
                    }
                    else
                    {
                        $result = remove_petpost($petpostid);
                        if ($result)
                        {
                            echo "Successfully Denied!";
                        }
                        else
                        {
                            echo "Deny did not work!";
                        }
                    }
                    //echo "<script type=\"text/javascript\">window.location = \"approveSubmissions.php\";</script>";
                    header('Refresh: 1; URL=http://localhost/homePetAdvertisement/approveSubmissions.php');
                }
                ?>
            </div>
        </div>
    </body>
</html>




