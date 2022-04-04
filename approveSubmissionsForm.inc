<?php
echo('<p><strong>Pet Post Approval Form</strong><br />');
echo('Testing Pet Post Approval ' .
'<br>If everything looks good, hit <b>Approve</b> at the bottom of this page.' . 
'<br>If somethings looks bad, hit <b>Deny</b> at the bottom of this page.');

?>
<form method="POST">
    <input type="hidden" name="_form_submit" value="1">
    <fieldset>
        <legend>Pet Post:</legend>
        <div style="float:left;">
		    <img src="<?php echo htmlspecialchars($petpicture); ?>" alt="test" width="200" height="200"/>
		</div>
        <div style="float:left;">
            <?php echo "Pet Post ID: $petpostid"; ?>
            <br><?php echo "Owner ID: $ownerid"; ?>
            <br><?php echo "Pet Name: $petname"; ?>
            <br><?php echo "Pet Type: $pettype\n"; ?>
            <br><?php echo "Pet Story: $petstory\n"; ?>
        </div>
        
        <script src="lib/jquery-1.9.1.js"></script>
        <script src="lib/jquery-ui.js"></script>
    </fieldset>
    
    <p>
        <?php
        echo('Hit <input type="submit" value="Approve" name="Choice"> to approve the pet post.<br /><br />');
        echo('Hit <input type="submit" value="Deny" name="Choice"> to deny the pet post.<br /><br />');
        ?>
    </p>
</form>