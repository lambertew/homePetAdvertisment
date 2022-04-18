<?php
/*
 * Copyright 2015 by Allen Tucker. This program is part of RMHC-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */

/*
 * 	personForm.inc
 *  shows a form for a person to be added or edited in the database
 * 	@author Oliver Radwan, Xun Wang and Allen Tucker
 * 	@version 9/1/2008, revised 4/1/2012, revised 3/11/2015
 */

if ($_SESSION['access_level'] == 0) {
    echo('<p><strong>Volunteer Service Application</strong><br />');
    echo('Please provide as much information as you can. ' . 
       '<br>When finished, hit <b>Submit</b> at the bottom of this page, and then <b>logout</b>.');
} else if ($_SESSION['access_level'] == 1)
    if ($_SESSION['_id'] != $person->get_id()) {
        echo("<p id=\"error\">You do not have sufficient permissions to edit this user.</p>");
        include('footer.inc');
        echo('</div></div></body></html>');
        die();
    } else {
        echo '<p><strong>Personnel Edit Form</strong>';
        echo(' Here you can edit your own information in the database.' .
        '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
    } else if ($_SESSION['access_level'] == 2)
	    if ($id == 'new') {
	        echo('<p><strong>Create New Admin Form</strong><br />');
	        echo('Adding a new Admin to the database. ' .
	        '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
	    } else {
	        echo '<p><strong>Personnel Edit Form</strong>'.
	        		'&nbsp;&nbsp;&nbsp;&nbsp;(View <strong><a href="volunteerLog.php?id='.$person->get_id().'">Log Sheet</a></strong>)<br>';
	        echo('Here you can edit, delete, or reset the password for a person in the database.' .
	        '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
	    } 
	    else {
		    echo("<p id=\"error\">You do not have sufficient permissions to add a new person to the database.</p>");
		    include('footer.inc');
		    echo('</div></div></body></html>');
		    die();
	    }
    echo '<br> (<span style="font-size:x-small;color:FF0000">*</span> denotes required information).';
?>
<form method="POST">
    <input type="hidden" name="old_id" value=<?PHP echo("\"" . $id . "\""); ?>>
    <input type="hidden" name="old_pass" value=<?PHP echo("\"" . $person->get_password() . "\""); ?>>
    <input type="hidden" name="_form_submit" value="1">
    <fieldset>
        <legend>Personal information:</legend>
    <?php
        if ($person->get_first_name()=="new")
        	echo '<p>First Name<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="first_name" tabindex="1" value="'.$person->get_first_name().'">';
        else 
        	echo '<p>First Name: '.$person->get_first_name();
    ?>  &nbsp;&nbsp;&nbsp;&nbsp;  Last Name<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="last_name" tabindex="2" value="<?PHP echo($person->get_last_name()) ?>">
<?php     
        
        if ($person->get_first_name()=="new") {
        	echo '<p>Phone<span style="font-size:x-small;color:FF0000">*</span>: ';
        	echo '<input type="text" name="phone" MAXLENGTH=12 tabindex="7" value="'.phone_edit($person->get_phone()).'">';
        }
        else echo '<p>Phone: '.phone_edit($person->get_phone());
        echo '<p>Email address<span style="font-size:x-small;color:FF0000">*</span>: '. '<input type="text" name="email" tabindex="10" value="'.$person->get_email().'">';
?>



<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>
</fieldset>
    <p>
        <?PHP
        echo('<input type="hidden" name="password" value="' . $person->get_password() . ')">');
        echo('<input type="hidden" name="_submit_check" value="1"><p>');
        echo('Hit <input type="submit" value="Submit" name="Submit Edits"> to create this admin account.<br /><br />');
        ?>
</form>