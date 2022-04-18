<?php
/*
 * Copyright 2015 by Allen Tucker. This program is part of RMHC-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
/*
 * 	personEdit.php
 *  oversees the editing of a person to be added, changed, or deleted from the database
 * 	@author Oliver Radwan, Xun Wang and Allen Tucker
 * 	@version 9/1/2008 revised 4/1/2012 revised 8/3/2015
 */
session_start();
session_cache_expire(30);
//include_once('database/dbPersons.php');
//include_once('database/dbAdopter.php');
include_once('database/dbPetPost.php');
//include_once('domain/Person.php');
include_once('domain/PetPost.php');
//include_once('database/dbApplicantScreenings.php');
//include_once('domain/ApplicantScreening.php');

$id = str_replace("_"," ",$_GET["id"]);

if ($id == 'new') {
    $petPost = new PetPost('new', 'p', 'e', 'pn', 'pt', 'ps', null, 0);
    /*$person = new Person('new', 'applicant', $_SESSION['venue'], null, null, null, null, null, null, null, null, null, "applicant", 
                    null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, "");*/
} else {
    $petPost = new PetPost('new', 'p', 'e', 'pn', 'pt', 'ps', null, 0);
    /*$person = retrieve_person($id);
    if (!$person) { // try again by changing blanks to _ in id
        $id = str_replace(" ","_",$_GET["id"]);
        $person = retrieve_person($id);
        if (!$person) {
            echo('<p id="error">Error: there\'s no person with this id in the database</p>' . $id);
            die();
        }
    }*/
}
#$petpost = new PetPost(101, 0, null, null, null, null, 0);

?>
<html>
    <head>
        <title>
            Editing <?PHP //echo($petPost->get_pet_name()); ?>
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
                if ($_POST['_form_submit'] != 1)
                {
                    include('petPostForm.inc');
                }
                else if ($_POST['_form_submit'] == 1)
                {
                    $petName = $_POST['petName'];
                    $petType = $_POST['petType'];
                    $petStory = $_POST['petStory'];
                    $petPicture = $_POST['petPicture'];
                    //used for url path in linking user back to edit form
                    //$path = strrev(substr(strrev($_SERVER['SCRIPT_NAME']), strpos(strrev($_SERVER['SCRIPT_NAME']), '/')));

                    $newpetpost = new PetPost(next_id(), 0, $petName, $petType, $petStory, $petPicture, 0);
                    //echo($newpetpost->get_id());

                    add_petpost($newpetpost);
                    include('petPostForm.inc');
                    //echo("Post successfully submitted for approval");
                    echo($newpetpost->get_id());
                    //process_form($id,$petPost);
                }
                $path = strrev(substr(strrev($_SERVER['SCRIPT_NAME']), strpos(strrev($_SERVER['SCRIPT_NAME']), '/')));
                        echo "</div>";
                    include('footer.inc');
                    echo('</div></body></html>');
                    die();

                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function process_form($id,$petPost) {
                    //echo($_POST['first_name']);
                    //step one: sanitize data by replacing HTML entities and escaping the ' character
                    if ($petPost->get_pet_name()=="new") {
                   		$name = trim(str_replace('\\\'', '', htmlentities(str_replace('&', 'and', $_POST['name']))));
                    }
                    else {
                    	$name = $petPost->get_pet_name();
                    }
                    if ($petPost->get_pet_name()=="new") {
                    	$phone = trim(str_replace(' ', '', htmlentities($_POST['phone'])));
                    	$clean_phone = preg_replace("/[^0-9]/", "", $phone);
                    }
                    else {
                        // This line needs to be updated because a pet post does not store the phone, the adopter does
                    	$clean_phone = $petPost->get_phone();
                    }
                    $email = $_POST['email'];
                    $pet_name = $_POST['pet_name'];
                    $pet_type = $_POST['pet_type'];
                    $pet_story = $_POST['pet_story'];
                    $pet_picture = $_POST['pet_picture'];
                    /*if ($screening_type!="") {
                    	$screening = retrieve_dbApplicantScreenings($screening_type);
                    	$step_array = $screening->get_steps();
                    	$step_count = count($step_array);
                    	$date_array = array();
                    	for ($i = 0; $i < $step_count; $i++) {
                        	$date_array[$i] = $_POST['screening_status'][$i];
                        	if ($date_array[$i]!="" && $date_array[$i]!="--" && strlen($date_array[$i]) != 8) {
                           	 	echo('<p>Completion Date for step: "' . $step_array[$i] . '" is in error, please enter mm-dd-yy.<br>');
                        	}
                    	}
                    	$screening_status = implode(',', $date_array);
                    }
                    $status = $_POST['status'];
                	if ($_POST['isstudent']=="yes")  {
                        $position="student";
                        $employer = $_POST['nameofschool'];
                    }
                    else {
                        $position = $_POST['position'];
                        $employer = $_POST['employer'];
                    }
                    $credithours = $_POST['credithours'];
                    $motivation = trim(str_replace('\\\'', '\'', htmlentities($_POST['motivation'])));
                    $specialties = trim(str_replace('\\\'', '\'', htmlentities($_POST['specialties'])));
                    $convictions = $_POST['convictions'];
                    if (!$_POST['availability'])
                          $availability = null;
                    else {
                          $availability = implode(',', $_POST['availability']);
                    }
                    // these two are not visible for editing, so they go in and out unchanged
                    $schedule = $_POST['schedule'];
                    $hours = $_POST['hours'];
                    $birthday = $_POST['birthday'];
                    $start_date = $_POST['start_date'];
                    $howdidyouhear = $_POST['howdidyouhear'];
                    $notes = trim(str_replace('\\\'', '\'', htmlentities($_POST['notes'])));*/
                    //used for url path in linking user back to edit form
                    $path = strrev(substr(strrev($_SERVER['SCRIPT_NAME']), strpos(strrev($_SERVER['SCRIPT_NAME']), '/')));
                    //step two: try to make the deletion, password change, addition, or change
                    /*if ($_POST['deleteMe'] == "DELETE") {
                        $result = retrieve_person($id);
                        if (!$result)
                            echo('<p>Unable to delete. ' . $first_name . ' ' . $last_name . ' is not in the database. <br>Please report this error to the House Manager.');
                        else {
                            //What if they're the last remaining manager account?
                            if (strpos($type, 'manager') !== false) {
                                //They're a manager, we need to check that they can be deleted
                                $managers = getall_type('manager');
                                if (!$managers || mysqli_num_rows($managers) <= 1 || $id=="Allen7037298111" || $id==$_SESSION['id'])
                                    echo('<p class="error">You cannot remove this manager from the database.</p>');
                                else {
                                    $result = remove_person($id);
                                    echo("<p>You have successfully removed " . $first_name . " " . $last_name . " from the database.</p>");
                                    if ($id == $_SESSION['_id']) {
                                        session_unset();
                                        session_destroy();
                                    }
                                }
                            } else {
                                $result = remove_person($id);
                                echo("<p>You have successfully removed " . $first_name . " " . $last_name . " from the database.</p>");
                                if ($id == $_SESSION['_id']) {
                                    session_unset();
                                    session_destroy();
                                }
                            }
                        }
                    }

                    // try to reset the person's password
                    else if ($_POST['reset_pass'] == "RESET") {
                        $id = $_POST['old_id'];
                        $result = remove_person($id);
                        $pass = $first_name . $clean_phone1;
                        $newperson = new Person($first_name, $last_name, $location, $address, $city, $state, $zip, $clean_phone1, $phone1type, $clean_phone2,$phone2type,
                        				$email, $type, $screening_type, $screening_status, $status, $employer, $position, $credithours,
                                        $commitment, $motivation, $specialties, $convictions, $availability, $schedule, $hours, 
                                        $birthday, $start_date, $howdidyouhear, $notes, "");
                        $result = add_person($newperson);
                        if (!$result)
                            echo ('<p class="error">Unable to reset ' . $first_name . ' ' . $last_name . "'s password.. <br>Please report this error to the House Manager.");
                        else
                            echo("<p>You have successfully reset " . $first_name . " " . $last_name . "'s password.</p>");
                    }

                    // try to add a new person to the database
                    else if ($_POST['old_id'] == 'new') {
                        $id = $first_name . $clean_phone1;
                        //check if there's already an entry
                        $dup = retrieve_person($id);
                        if ($dup)
                            echo('<p class="error">Unable to add ' . $first_name . ' ' . $last_name . ' to the database. <br>Another person with the same name and phone is already there.');
                        else {
                        	$newperson = new Person($first_name, $last_name, $location, $address, $city, $state, $zip, $clean_phone1, $phone1type, $clean_phone2,$phone2type,
                        				$email, $type, $screening_type, $screening_status, $status, $employer, $position, $credithours,
                                        $commitment, $motivation, $specialties, $convictions, $availability, $schedule, $hours, 
                                        $birthday, $start_date, $howdidyouhear, $notes, "");
                            $result = add_person($newperson);
                            if (!$result)
                                echo ('<p class="error">Unable to add " .$first_name." ".$last_name. " in the database. <br>Please report this error to the House Manager.');
                            else if ($_SESSION['access_level'] == 0)
                                echo("<p>Your application has been successfully submitted.<br>  The House Manager will contact you soon.  Thank you!");
                            else
                                echo('<p>You have successfully added <a href="' . $path . 'personEdit.php?id=' . $id . '"><b>' . $first_name . ' ' . $last_name . ' </b></a> to the database.</p>');
                        }
                    }

                    // try to replace an existing person in the database by removing and adding
                    else {
                        $id = $_POST['old_id'];
                        $pass = $_POST['old_pass'];
                        $result = remove_person($id);
                        if (!$result)
                            echo ('<p class="error">Unable to update ' . $first_name . ' ' . $last_name . '. <br>Please report this error to the House Manager.');
                        else {
                            $newperson = new Person($first_name, $last_name, $location, $address, $city, $state, $zip, $clean_phone1, $phone1type, $clean_phone2,$phone2type,
                        				$email, $type, $screening_type, $screening_status, $status, $employer, $position, $credithours,
                                        $commitment, $motivation, $specialties, $convictions, $availability, $schedule, $hours, 
                                        $birthday, $start_date, $howdidyouhear, $notes, $pass);
                            $result = add_person($newperson);
                            if (!$result)
                                echo ('<p class="error">Unable to update ' . $first_name . ' ' . $last_name . '. <br>Please report this error to the House Manager.');
                            //else echo("<p>You have successfully edited " .$first_name." ".$last_name. " in the database.</p>");
                            else
                                echo('<p>You have successfully edited <a href="' . $path . 'personEdit.php?id=' . $id . '"><b>' . $first_name . ' ' . $last_name . ' </b></a> in the database.</p>');
                            add_log_entry('<a href=\"personEdit.php?id=' . $id . '\">' . $first_name . ' ' . $last_name . '</a>\'s Personnel Edit Form has been changed.');
                        }
                    }*/
                }
                ?>
            </div>
            <?PHP include('footer.inc'); ?>
        </div>
    </body>
</html> 
