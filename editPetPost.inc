<?php
echo('<p><strong>Edit Pet Post Form</strong><br />');
echo('Fill in all the required fields to create a new pet post. ' .
'<br>When finished, hit <b>Submit</b> at the bottom of this page.');
?>
<form method="POST">
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
        echo '<input type="pet_type" name="pet_type" value="' . $petPost->get_pet_type() . '">';
        echo '<p>Pet Story<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="pet_story" name="pet_story" value="' . $petPost->get_pet_story() . '">';
        echo '<p>Picture of Pet<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="pet_picture" name="pet_picture">';
        ?>
        <script src="lib/jquery-1.9.1.js"></script>
        <script src="lib/jquery-ui.js"></script>
    </fieldset>
    
    <p>
        <?php
        echo('Hit <input type="submit" value="Submit" name="Submit Pet Post"> to submit your post.<br /><br />');
        ?>
    </p>
</form>
