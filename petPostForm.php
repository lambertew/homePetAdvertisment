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
include_once('database/dbAdopter.php');
include_once('database/dbPetPost.php');
include_once('domain/Adopter.php');
include_once('domain/PetPost.php');
//include_once('database/dbLog.php');
$id = str_replace("_"," ",$_GET["id"]);

$adopter = new Adopter(1001, null, null, null);
$petpost = new PetPost(1001, 1001, null, null, null, null, 0, 0);

?>
<html>
    <head>
        <title>
            Create Pet Post <?PHP //echo($petPost->get_pet_name()); ?>
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
                if ($_POST['_form_submit'] != 1) {
                    include('petPostForm.inc');
                } else {
                    //in this case, the form has been submitted, so validate it
                    $errors = validate_petpost();  //step one is validation.
                    // errors array lists problems on the form submitted
                    if ($errors) {
                        // display the errors and the form to fix
                        show_errors($errors);
                        include('petPostForm.inc');
                    } else {
                        $upload = 1;
                    if (is_uploaded_file($_FILES['choosefile']['tmp_name'])) {
                        $target_dir = "images/";
                        $target_file = $target_dir . basename($_FILES["choosefile"]["name"]);
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        
                        if ($_FILES["fileToUpload"]["size"] > 500000) {
                            echo "File is too large.<br>";
                            $upload = 0;
                        }
                        
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                            echo "Wrong file type. Please upload JPG, JPEG, or PNG.<br>";
                            $upload = 0;
                        }
                        
                        if ($upload == 1) {
                            move_uploaded_file($_FILES["choosefile"]["tmp_name"], $target_file);
                        } else {
                        }
                    }
                        $id = next_id();
                        $owner_id = next_owner_id();
                        $name = $_POST['name'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $petName = $_POST['petName'];
                        $petType = $_POST['petType'];
                        $petStory = $_POST['petStory'];
                        $petPicture = $target_file;

                        $newadopter = new Adopter($owner_id, $name, $phone, $email);
                        $adopterid = add_adopter($newadopter);
                        if ($adopterid != $owner_id) {
                    	   $neweradopter = new Adopter($adopterid, $name, $phone, $email);
                    	   edit_user_info($neweradopter);
                        }
                        $newpetpost = new PetPost($id, $adopterid, $petName, $petType, $petStory, $petPicture, 0, 0);
                        $postid = add_petpost($newpetpost);
                        if ($postid != $id) {
                    	   $newerpetpost = new PetPost($postid, $adopterid, $petName, $petType, $petStory, $petPicture, 0, 0);
                    	   edit_petpost($newerpetpost);
                        }
                        echo "Pet Post has been submitted for approval.<br>";
                        header('Refresh: 2; URL=http://localhost/homePetAdvertisement/index.php');
                        return 1;
                        //process_form($id,$petPost);
                    }
                }
                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function process_form($id,$petPost) {
                }
                ?>
            </div>
        </div>
    </body>
</html> 
