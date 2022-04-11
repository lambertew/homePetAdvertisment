<?php
echo('<p><strong>Pet Post Approval Form</strong><br />');
echo('Testing Pet Post Approval ' .
'<br>If everything looks good, hit <b>Approve</b> at the bottom of this page.' . 
'<br>If somethings looks bad, hit <b>Deny</b> at the bottom of this page.');

?>
<form method="POST">
    <input type="hidden" name="_form_submit" value="1">
    <p>
        <?php
        echo('Hit <input type="submit" value="Approve" name="Choice"> to approve the pet post.<br /><br />');
        echo('Hit <input type="submit" value="Deny" name="Choice"> to deny the pet post.<br /><br />');
        ?>
    </p>
</form>