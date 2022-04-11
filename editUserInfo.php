<?php
/*
 * Copyright 2013 by ... and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

session_start();
session_cache_expire(30);
include_once('database/dbPetPost.php');
include_once('domain/PetPost.php');
?>
<head>
    <link rel="stylesheet" href="styles.css" type="text/css" />
</head>
<body>
    <div id="container">
        <?PHP include('header.php'); ?>
        <div id="content">
        	<?php
            $petposts = retrieve_all_petposts();
            if (!$petposts) {
                echo "No posts yet...";
            } else {
        	    for ($x = 0; $x < sizeof($petposts); $x++) {
        	        $approval = $petposts[$x]->get_approved();
        	        $petname = $petposts[$x]->get_pet_name();
        	        $petstory = $petposts[$x]->get_pet_story();
        	        $petpicture = $petposts[$x]->get_pet_picture();
        	        ?>
        	        <fieldset style="text-align:center";>
        	        	<legend><b><?php echo $petname ?></b></legend>
        	          	<div style="display:inline-block; margin:auto;">
        	          		<br><img src="<?php echo htmlspecialchars($petpicture); ?>" alt="test" width="200" height="200"/>
        	            	<p style="text-align:center";><?php echo $petstory?></p>
        	          	</div>
        	          	<p style="float:right;"><a href="editPetPost.php?id=<?php echo $petposts[$x]->get_id(); ?>">Edit</a></p>
        	         </fieldset>
        	         <?php
                }
            }?>
         </div>
      <?PHP include('footer.inc'); ?>
    </div>
</body>
