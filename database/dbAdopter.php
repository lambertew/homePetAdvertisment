<?php
/*
 * Copyright 2013 by Jerrick Hoang, Ivy Xing, Sam Roberts, James Cook, 
 * Johnny Coster, Judy Yang, Jackson Moniaga, Oliver Radwan, 
 * Maxwell Palmer, Nolan McNair, Taylor Talmage, and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

/**
 * @version March 1, 2012
 * @author Oliver Radwan and Allen Tucker
 */
include_once('dbinfo.php');
include_once(dirname(__FILE__).'/../domain/Adopter.php');

function add_adopter($adopter) {
    #if (!$person instanceof Person)
    #    die("Error: add_person type mismatch");
    $con=connect();
    $query = "SELECT * FROM dbadopter WHERE name = '" . $adopter->get_name() . "' AND phone = '" . $adopter->get_phone() . "'";
    $result = mysqli_query($con,$query);
    //if there's no entry for this id, add it
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_query($con,'INSERT INTO dbadopter VALUES("' .
                $adopter->get_id() . '","' .
                $adopter->get_name() . '","' .
                $adopter->get_phone() . '","' .
                $adopter->get_email() .
                '");');                         
        mysqli_close($con);
        return $adopter->get_id();
    }
    $query2 = "SELECT id FROM dbadopter WHERE name = '" . $adopter->get_name() . "' AND phone = '" . $adopter->get_phone() . "'";
    $result2 = mysqli_query($con,$query2, MYSQLI_USE_RESULT);
    $row = mysqli_fetch_row($result2);
    $the_id = $row[0];
    mysqli_close($con);
    return $the_id;
}

function retrieve_adopter_by_id ($id) {
    $con=connect();
    $query = 'SELECT * FROM dbadopter WHERE id="' . $id . '" LIMIT 1';
    $result = mysqli_query($con,$query);
    if (!$result)
    {
        return null;
    }
    $result_row = mysqli_fetch_assoc($result);
    $adopter = create_adopter($result_row);
    return $adopter;
}

function edit_user_info ($adopter) {
    $adopter_id = $adopter->get_id();
    $adopter_name = $adopter->get_name();
    $adopter_phone = $adopter->get_phone();
    $adopter_email = $adopter->get_email();
    
    $con=connect();
    $query = 'UPDATE dbadopter SET name="' . $adopter_name . '" WHERE id = "' . $adopter_id .'"';
    $result = mysqli_query($con,$query);
    if (!$result) {
        return false;
    }
    $query = 'UPDATE dbadopter SET phone="' . $adopter_phone . '" WHERE id = "' . $adopter_id .'"';
    $result = mysqli_query($con,$query);
    if (!$result) {
        return false;
    }
    $query = 'UPDATE dbadopter SET email="' . $adopter_email . '" WHERE id = "' . $adopter_id .'"';
    $result = mysqli_query($con,$query);
    if (!$result) {
        return false;
    }
    mysqli_close($con);
    return true;
}

function create_adopter ($result_row) {
    $adopter = new Adopter(
        $result_row['id'],
        $result_row['name'],
        $result_row['phone'],
        $result_row['email']);
    return $adopter;
}

function next_owner_id() {
    $con=connect();
    $query = 'SELECT MAX(id) FROM dbadopter';
    $result = mysqli_query($con,$query, MYSQLI_USE_RESULT);
    if ($result) {
        $row = mysqli_fetch_row($result);
        $the_id = $row[0] + 1;
        return $the_id;
    } else {
        $the_id = 0;
        return $the_id;
    }
}

?>
