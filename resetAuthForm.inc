<?php
echo('<p><strong>Email Authentication Form</strong><br />');
echo('Testting Email Authentication. ' .
'<br>When finished, hit <b>Submit</b> at the bottom of this page.');
?>
<form method="POST">
    <input type="hidden" name="_form_submit" value="1">
    <input type="hidden" name="_form_submit_2" value="0">
    <fieldset>
        <legend>Personal information:</legend>
        <?php
        
        echo '<p>Sending Email Using PHP';
        echo '<p>ID<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="text" name="resetID">';
        echo '<p>Email<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="text" name="resetEmail">';
        ?>
        <script src="lib/jquery-1.9.1.js"></script>
        <script src="lib/jquery-ui.js"></script>
    </fieldset>
    
    <p>
        <?php
        echo('Hit <input type="submit" value="Submit" name="Submit Email"> to send email.<br /><br />');
        ?>
    </p>
</form>
