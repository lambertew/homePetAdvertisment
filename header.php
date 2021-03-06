<?php
/*
 * Copyright 2013 by Allen Tucker. 
 * This program is part of RMHP-Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */
?>
<!-- Begin Header -->
<style type="text/css">
    h1 {padding-left: 0px; padding-right:165px;}
</style>
<div id="header">
<!--<br><br><img src="images/rmhHeader.gif" align="center"><br>
<h1><br><br>SPCA <br></h1>-->

</div>

<div align="center" id="navigationLinks">

    <?PHP

        /*         * Set our permission array.
         * anything a guest can do, a volunteer and manager can also do
         * anything a volunteer can do, a manager can do.
         *
         * If a page is not specified in the permission array, anyone logged into the system
         * can view it. If someone logged into the system attempts to access a page above their
         * permission level, they will be sent back to the home page.
         */
        //pages guests are allowed to view
        $permission_array['index.php'] = 0;
        $permission_array['about.php'] = 0;
        $permission_array['petpostform.php'] = 0;
        $permission_array['searchPetPost.php'] = 0;
        $permission_array['login_form.php'] = 0;
        //pages volunteers can view
        //pages only managers can view
        $permission_array['personsearch.php'] = 2;
        $permission_array['personedit.php'] = 2;
        $permission_array['resetPassword.php'] = 2;
        $permission_array['editUserInfo.php'] = 2;
        $permission_array['editPetPostForm.php'] = 2;
        $permission_array['approveSubmissions.php'] = 2;
        $permission_array['logout.php'] = 2;

        //Check if they're at a valid page for their access level.
        $current_page = strtolower(substr($_SERVER['PHP_SELF'], strpos($_SERVER['PHP_SELF'],"/")+1));
        $current_page = substr($current_page, strpos($current_page,"/")+1);
        
        if($permission_array[$current_page]>$_SESSION['access_level']){
            //in this case, the user doesn't have permission to view this page.
            //we redirect them to the index page.
            echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
            //note: if javascript is disabled for a user's browser, it would still show the page.
            //so we die().
            die();
        }
        //This line gives us the path to the html pages in question, useful if the server isn't installed @ root.
        $path = strrev(substr(strrev($_SERVER['SCRIPT_NAME']), strpos(strrev($_SERVER['SCRIPT_NAME']), '/')));
		    $venues = array("portland"=>"RMH Portland","bangor"=>"RMH Bangor");
        
        // echo '<br><h1><img src="images/emma.jpg" width="auto"; height = "500"; margin = "5; />';
        echo '<br><b><center><p style="font-size:30px;">SPCA</p></center></b>';
        if ($_SESSION['access_level'] == 0) {
            echo('<a href="' . $path . 'index.php">Home</a> ');
            echo(' | <a href="' . $path . 'about.php">About</a>');
            echo(' | <a href="' . $path . 'emailAuth.php">Create Pet Post</a>');
            echo(' | <a href="' . $path . 'searchPetPost.php">Search Pet Posts</a>');
            echo(' | <a href="' . $path . 'login_form.php">Login</a>');
        } else {
        	  echo('<a href="' . $path . 'index.php">Home</a>');
        	  echo(' | <a href="' . $path . 'about.php">About</a>');
            echo(' | <a href="' . $path . 'petPostForm.php">Create Pet Post</a>');
            echo(' | <a href="' . $path . 'searchPetPost.php">Search Pet Posts</a>');
            echo(' | <a href="' . $path . 'editUserInfo.php">Edit User Information</a>');
            echo(' | <a href="' . $path . 'personEdit.php?id=' . 'new' . '">Create New Admin</a>');
            echo(' | <a href="' . $path . 'resetAuth.php">Reset Password</a>');
            echo(' | <a href="' . $path . 'approveSubmissions.php">Approve Submissions</a>');
            echo(' | <a href="' . $path . 'logout.php">Logout</a><br>');
        }
?>
</div>
<!-- End Header -->