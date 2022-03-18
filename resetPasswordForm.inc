<?php
echo('<p><strong>Reset Admin Password Form</strong><br />');
echo('Resetting Admin Password in the database. ' .
'<br>When finished, hit <b>Submit</b> at the bottom of this page.');
?>
<form method="POST">
    <input type="hidden" name="_form_submit" value="1">
    <fieldset>
        <legend>Personal information:</legend>
        <?php
        
        echo '<p>Resetting the password for Admin id '.$person->get_id();
        echo '<p>New Password<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="password" name="new_password">';
        echo '<p>Confirm New Password<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="password" name="confirm_new_password">';
        ?>
        <script src="lib/jquery-1.9.1.js"></script>
        <script src="lib/jquery-ui.js"></script>
    </fieldset>
    
    <p>
        <?php
        echo('Hit <input type="submit" value="Submit" name="Submit New Password"> to reset password.<br /><br />');
        ?>
    </p>
</form>
