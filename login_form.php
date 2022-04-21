<?php
/*
 * Copyright 2013 by Allen Tucker. 
 * This program is part of RMHC-Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */
?><?php
/*
 * Created on Mar 28, 2008
 * @author Oliver Radwan <oradwan@bowdoin.edu>, Sam Roberts, Allen Tucker
 * @version 3/28/2008, revised 7/1/2015
 */
 session_start();
?>
<head>
<link rel="stylesheet" href="styles.css" type="text/css" />
</head>
<div id="container">
<div id="content">
    <?PHP
    include_once('database/dbPersons.php');
    include_once('domain/Person.php');
    if (($_SERVER['PHP_SELF']) == "/logout.php") {
        //prevents infinite loop of logging in to the page which logs you out...
        echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
    }
    if(!$_SESSION['logged_in']) {
        $_SESSION['logged_in'] = 0;
        $_SESSION['access_level'] = 0;
    }
    if (!array_key_exists('_submit_check', $_POST)) {
        echo('<div align="left"><p>Administrative access to SPCA requires a Username and a Password. ' .
        '<ul>'
        );
        echo '</ul>';
        echo('<li>If you are an admin logging in for the first time, your Username is your first name followed by your ten digit phone number. ' .
        'After you have logged in, you can change your password.  ');
        echo('<p><table><form method="post"><input type="hidden" name="_submit_check" value="true"><tr><td>Username:</td>
        		<td><input type="text" name="user" tabindex="1"></td></tr>
        		<tr><td>Password:</td><td><input type="password" name="pass" tabindex="2"></td></tr><tr><td colspan="2" align="center"><input type="submit" name="Login" value="Login"></td></tr></table>');
    } else {
        //otherwise authenticate their password
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db_pass = md5($_POST['pass']);
            $db_id = $_POST['user'];
            $person = retrieve_person($db_id);
            if ($person) { //avoids null results
                if ($person->get_password() == $db_pass) { //if the passwords match, login
                    $_SESSION['logged_in'] = 1;
                    date_default_timezone_set ("America/New_York");
                    $_SESSION['access_level'] = 2;
                    $_SESSION['f_name'] = $person->get_first_name();
                    $_SESSION['l_name'] = $person->get_last_name();
                    $_SESSION['_id'] = $_POST['user'];
                    echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                }
                else {
                    echo('<div align="left"><p class="error">Error: invalid username/password<br />if you cannot remember your password, ask another admin to reset it for you.</p><p>Access to Homebase requires a Username and a Password.');
                    echo('<p>If you are a volunteer, your Username is your first name followed by your phone number with no spaces. ' .
                    'For instance, if your first name were John and your phone number were (207)-123-4567, ' .
                    'then your Username would be <strong>John2071234567</strong>.  ');
                    echo('<p><table><form method="post"><input type="hidden" name="_submit_check" value="true"><tr><td>Username:</td><td><input type="text" name="user" tabindex="1"></td></tr><tr><td>Password:</td><td><input type="password" name="pass" tabindex="2"></td></tr><tr><td colspan="2" align="center"><input type="submit" name="Login" value="Login"></td></tr></table>');
                }
            } else {
                //At this point, they failed to authenticate
                echo('<div align="left"><p class="error">Error: invalid username/password<br />');
                echo('If you do not remember your password, please contact an admin user!');
                echo('<p><table><form method="post"><input type="hidden" name="_submit_check" value="true"><tr><td>Username:</td><td><input type="text" name="user" tabindex="1"></td></tr><tr><td>Password:</td><td><input type="password" name="pass" tabindex="2"></td></tr><tr><td colspan="2" align="center"><input type="submit" name="Login" value="Login"></td></tr></table>');
            }
        }
    }
    ?>
</div>
</div>
