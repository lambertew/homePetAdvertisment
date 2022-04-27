<?php
echo('<p><strong>Create Pet Post Form</strong><br />');
echo('Fill in all the required fields to create a new pet post. ' .
'<br>When finished, hit <b>Submit</b> at the bottom of this page.');
?>
<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="old_id" value=<?PHP echo("\"" . $id . "\""); ?>>
    <input type="hidden" name="_form_submit" value="1">
    <fieldset>
        <legend>Pet Post Information:</legend>
        <?php
        echo '<p>Name<span style="font-size:x-small;color:FF0000">*</span>:<input type="text" name="name">';
        echo '<p>Phone Number<span style="font-size:x-small;color:FF0000">*</span>:<input type="text" name="phone">';
        echo '<p>Email Address<span style="font-size:x-small;color:FF0000">*</span>:<input type="text" name="email">';
        echo '<p>Pet Name<span style="font-size:x-small;color:FF0000">*</span>:<input type="text" name="petName">';
        //echo '<p>Pet Type<span style="font-size:x-small;color:FF0000">*</span>:<input type="text" name="petType">';
        echo '<p>Pet Type<span style="font-size:x-small;color:FF0000">*</span>:<select type="text" name="petType">
            <option value="" disabled selected hidden>Select Pet Type</option>
            <option value="Dog">Dog</option>
            <option value="Cat">Cat</option>
            <option value="Other">Other</option>
            </select>';
        echo '<p>Pet Story<span style="font-size:x-small;color:FF0000">*</span>:<textarea rows="5" cols="25 type="text" name="petStory"></textarea>';
        //echo '<p>Picture of Pet<span style="font-size:x-small;color:FF0000">*</span>:<input type="text" name="petPicture">';
        echo '<p>Picture of Pet<span style="font-size:x-small;color:FF0000">*</span>:<input type="file" name="choosefile" id="choosefile"><br><br>';
        ?>
        <script src="lib/jquery-1.9.1.js"></script>
        <script src="lib/jquery-ui.js"></script>
    </fieldset>
    
    <p>
        <?php
        echo('Hit <input type="submit" value="Submit" name="Submit Pet Post"> to create your post.<br /><br />');
        ?>
    </p>
</form>
