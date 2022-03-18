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
        //echo ' Hit <input type="submit" value="submit" name="Submit Edits"> to associate '.$person->get_first_name().' with this screening.<br><br>';
?>



<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>
</fieldset>
    <p>
        <?PHP
        // if ($_SESSION['access_level']==2 && $person->get_status() == "applicant") {
        //     echo "<fieldset>";
        //     echo "<legend>Applicants only: </legend>";
		// 	if ($_SESSION['access_level'] == 2) {
        //     	$screeningType = $person->get_screening_type();
        //         $screening = retrieve_dbApplicantScreenings($screeningType);
        //         $screenings = getall_ApplicantScreenings();
        //         echo('<p> Screening Type:&nbsp; <select name="screening_type">');
        //         if ($person->get_screening_type() == "")
        //             echo('<option value="" SELECTED></option>');
        //         foreach ($screenings as $s) {
        //             if ($s->get_status() == "published") {
        //                 $t = $s->get_type();
        //                 if ($screeningType == $t) {
        //                     echo('<option value ="' . $t . '" SELECTED>' . $t . '</option>');
        //                 } else {
        //                     echo('<option value ="' . $t . '"> ' . $t . '</option>');
        //                 }
        //             }
        //         }
        //         echo('</select>&nbsp;');

        //         // submit button that allows manager to associate person with applicant screening
        //         //echo(' Hit <input type="submit" value="submit" name="Submit Edits"> to associate '.$person->get_first_name().' with this screening.<br><br>');

        //         if ($screening) {
        //             $step_array = $screening->get_steps();
        //             $date_array = $person->get_screening_status();
        //             $step_count = count($step_array);
                
        //         echo("<p><table>");
        //         echo('<tr><td>Completion Date</td> <td>Step</td></tr>');
        //         for ($i = 0; $i < $step_count; $i++) {
        //             $j = $i + 1;
        //             echo "<tr><td>";
        //             echo('<tr><td><input type="text" id="screening_status" name="screening_status[]" value="'.$date_array[$i]. '" size="8" /></td>');
        //             echo('</td><td>' . $j . '. ' . $step_array[$i] . '</td></tr>');
        //         }
        //         echo('</table>');
        //         }
		// 	}    
        //     echo "</fieldset>";
        // }
        echo('<input type="hidden" name="password" value="' . $person->get_password() . ')">');
        echo('<input type="hidden" name="_submit_check" value="1"><p>');
        // if ($_SESSION['access_level'] == 0)
        //     echo('By hitting <input type="submit" value="Submit" name="Submit Edits">, I understand the importance of this volunteer 
        //     		commitment and have answered the application questions honestly and to the best of my knowledge.<br /><br />');
        // else
            echo('Hit <input type="submit" value="Submit" name="Submit Edits"> to create this admin account.<br /><br />');
        // if ($id != 'new' && $_SESSION['access_level'] >= 2) {
        //     echo ('<input type="checkbox" name="deleteMe" value="DELETE"> Check this box and then hit ' .
        //     '<input type="submit" value="Delete" name="Delete Entry"> to delete this entry. <br />' .
        //     '<input type="checkbox" name="reset_pass" value="RESET"> Check this box and then hit ' .
        //     '<input type="submit" value="Reset Password" name="Reset Password"> to reset this person\'s password.</p>');
        // }
        ?>
</form>