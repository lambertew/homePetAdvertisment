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
include_once('database/dbPetPost.php');
include_once('domain/PetPost.php');
$id = str_replace("_"," ",$_GET["id"]);

if ($id == 'new') {
    $petPost = new PetPost('new', 'p', 'e', 'pn', 'pt', 'ps', null, 0);
} else {
    $petPost = new PetPost('new', 'p', 'e', 'pn', 'pt', 'ps', null, 0);
}

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
                    $newpetpost = new PetPost(next_id(), 0, $petName, $petType, $petStory, $petPicture, 0);

                    add_petpost($newpetpost);
                    include('petPostForm.inc');
                    echo($newpetpost->get_id());
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
                    //used for url path in linking user back to edit form
                    $path = strrev(substr(strrev($_SERVER['SCRIPT_NAME']), strpos(strrev($_SERVER['SCRIPT_NAME']), '/')));
                    //step two: try to make the deletion, password change, addition, or change
                }
                ?>
            </div>
            <?PHP include('footer.inc'); ?>
        </div>
    </body>
</html> 
