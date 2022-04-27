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
include_once('domain/Adopter.php');
include_once('database/dbPetPost.php');
include_once('domain/PetPost.php');
$id = str_replace("_"," ",$_GET["id"]);
$petPost = retrieve_petpost_by_petid($id);
$adopter = retrieve_adopter_by_id($petPost->get_owner_id());
?>
<html>
    <head>
        <title>
            Editing <?PHP echo($petPost->get_pet_name()); ?>
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
                if ($_POST['_form_submit'] != 1) {
                    include('editPetPostForm.inc');
                } else {
                    process_form($petPost,$adopter);
                    echo "</div>";
                    include('footer.inc');
                    echo('</div></body></html>');
                    die();
                }

                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function process_form($petPost,$adopter) {
                    //$target_file = $petPost->get_pet_picture();
                    //if (is_uploaded_file($_FILES['choosefile']['tmp_name'])) {
                        $target_dir = "images/";
                        $target_file = $target_dir . basename($_FILES["choosefile"]["name"]);
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        
                        if ($_FILES["fileToUpload"]["size"] > 500000) {
                            echo "File is too large.<br>";
                        }
                        
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && imageFileType != "gif") {
                            echo "Wrong file type. Please upload JPG, JPEG, or PNG.<br>";
                        }
                        
                        if (move_uploaded_file($_FILES["choosefile"]["tmp_name"], $target_file)) {
                            echo "The file ". htmlspecialchars(basename($_FILES["choosefile"]["name"])). " has been uploaded.<br>";
                        } else {
                            echo "The file ". htmlspecialchars(basename($_FILES["choosefile"]["name"])). " could not be uploaded.<br>";
                        }
                    //}
                   
                    $owner_name = $_POST["name"];
                    $phone = $_POST["phone"];
                    $email = $_POST["email"];
                    $pet_name = $_POST["pet_name"];
                    $pet_type = $_POST["pet_type"];
                    if (empty($pet_type)) {
                        $pet_type = $petPost->get_pet_type();
                    }
                    $pet_story = $_POST["pet_story"];
                    $pet_picture = $target_file;
                    
                    $adopter->set_name($owner_name);
                    $adopter->set_phone($phone);
                    $adopter->set_email($email);
                    $petPost->set_pet_name($pet_name);
                    $petPost->set_pet_type($pet_type);
                    $petPost->set_pet_story($pet_story);
                    $petPost->set_pet_picture($pet_picture);
                    
                    $adopter_result = edit_user_info($adopter);
                    $petpost_result = edit_petpost($petPost);
                    if(!$petpost_result || !$adopter_result) {
                        echo "Pet Post could not be updated.";
                    } else {
                        echo "Pet Post successfully updated.";
                    }
                    header('Refresh: 2; URL=http://localhost/homePetAdvertisement/editPetPostForm.php?id='. $petPost->get_id() . '');
                    return 1;
                }
                ?>
            </div>
        </div>
    </body>
</html> 
