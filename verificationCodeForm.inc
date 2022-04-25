<?php
echo('<p><strong>Verification Code Form</strong><br />');
echo('When finished, hit <b>Submit</b> at the bottom of this page.');
?>
<form method="POST">
    <input type="hidden" name="_form_submit" value="1">
    <input type="hidden" name="_form_submit_2" value="1">
    <fieldset>
        <legend>Personal information:</legend>
        <?php
        
        echo '<p>Enter Verification Code From Email';
        echo '<p>Verification Code:<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="text" name="codeEntered">';
        ?>
        <script src="lib/jquery-1.9.1.js"></script>
        <script src="lib/jquery-ui.js"></script>
    </fieldset>
    
    <p>
        <?php
        echo('Hit <input type="submit" value="Submit" name="Submit Code"> verify email.<br /><br />');
        ?>
    </p>
</form>