<?php
echo('<p><strong>Edit Pet Post Form</strong><br />');
echo('Fill in the fields that you want to edit' .
'<br>When finished, hit <b>Save Changes</b> at the bottom of this page.');
?>
<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_form_submit" value="1">
    <fieldset>
        <legend>Pet Post Information:</legend>
        <?php
        
        echo '<p>Name<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="name" name="name" value="' . $adopter->get_name() . '">';
        echo '<p>Phone Number<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="phone" name="phone" value="' . $adopter->get_phone() . '">';
        echo '<p>Email Address<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="email" name="email" value="' . $adopter->get_email() . '">';
        echo '<p>Pet Name<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="pet_name" name="pet_name" value="' . $petPost->get_pet_name() . '">';
        echo '<p>Pet Type<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<select name="pet_type">
					<option value="" disabled selected hidden>' . $petPost->get_pet_type() . '</option>
					<option value="Dog">Dog</option>
					<option value="Cat">Cat</option>
					<option value="Other">Other</option>
			  </select>';
        echo '<p>Pet Story<span style="font-size:x-small;color:FF0000;">*</span>: ';
        echo '<textarea rows="5" cols="25 type="pet_story" name="pet_story">' . $petPost->get_pet_story() . '</textarea>';
        echo '<p>Picture of Pet<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="file" name="choosefile" id="choosefile"><br><br>';
        echo '<embed style="float:left;" src=' . $petPost->get_pet_picture() . ' width="200" height="200">';
        ?>
        
        <script src="lib/jquery-1.9.1.js"></script>
        <script src="lib/jquery-ui.js"></script>
    </fieldset>
    <p>
        <?php
        echo('Hit <input type="submit" value="Save Changes" name="submit"> to finalize your edits.<br /><br />');
        ?>
    </p>
</form>