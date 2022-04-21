<?php
/*
 * Copyright 2015 by Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
session_start();
session_cache_expire(30);
?>
<html>
    <head>
        <title>
            SPCA
        </title>
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <style>
        	#appLink:visited {
        		color: gray; 
        	}
        </style> 
    </head>
    <body>
        <div id="container">
            <?PHP include('header.php'); ?>
            <div id="content">
                <?PHP
                include_once('database/dbPersons.php');
                include_once('domain/Person.php');
                include_once('database/dbinfo.php');
                include_once('dbPetPost.php');
                include_once('petPost.php');
                include_once('slideshow.php');

                date_default_timezone_set('America/New_York');
                if ($_SESSION['access_level'] == 2) {
                    $person = retrieve_person($_SESSION['_id']);
                    echo "<p>Welcome, " . $person->get_first_name() . ", to the SPCA!";
                }
                else 
                    echo "<p>Welcome!";
                echo "   Today is " . date('l F j, Y') . ".<p>";
                
                $pet = new_highlights();
                #echo $pet[0]->get_pet_name();
                #echo $pet[1]->get_pet_name();
                #echo $pet[2]->get_pet_name();   
                echo showSlides();

                $ppID = $pet[0]->get_id();
                $r = update_highlights($ppID);
                #echo $r;
                ?>

            </div>
        </div>
    </body>
</html>