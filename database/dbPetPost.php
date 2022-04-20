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
include_once(dirname(__FILE__).'/../domain/PetPost.php');

/*
 * add a person to dbPersons table: if already there, return false
 */

function add_petpost($petpost) {
    #if (!$person instanceof Person)
    #    die("Error: add_person type mismatch");
    $con=connect();
    $query = "SELECT * FROM dbpetpost WHERE owner_id = '" . $petpost->get_owner_id() . "' AND petName = '" . $petpost->get_pet_name() ."' AND petType = '" . $petpost->get_pet_type() . "'";
    $result = mysqli_query($con,$query);
    //if there's no entry for this id, add it
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_query($con,'INSERT INTO dbpetpost VALUES("' .
                $petpost->get_id() . '","' .
                $petpost->get_owner_id() . '","' .
                $petpost->get_pet_name() . '","' .
                $petpost->get_pet_type() . '","' .
                $petpost->get_pet_story() . '","' .
                $petpost->get_pet_picture() . '","' .
                $petpost->get_approved() . '","' .
                $petpost->get_numHighlight() .
                '");');							
        mysqli_close($con);
        return $petpost->get_id();
    }
    $query2 = "SELECT id FROM dbpetpost WHERE owner_id = '" . $petpost->get_owner_id() . "' AND petName = '" . $petpost->get_pet_name() ."' AND petType = '" . $petpost->get_pet_type() . "'";
    $result2 = mysqli_query($con,$query2, MYSQLI_USE_RESULT);
    $row = mysqli_fetch_row($result2);
    $the_id = $row[0];
    mysqli_close($con);
    return $the_id;
}

function remove_petpost($id) {
    $con=connect();
    $query = 'SELECT * FROM dbpetpost WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $query = 'DELETE FROM dbpetpost WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return true;
}

function edit_petpost($petpost) {
    $pet_id = $petpost->get_id();
    $new_pet_name = $petpost->get_pet_name();
    $new_pet_type = $petpost->get_pet_type();
    $new_pet_story = $petpost->get_pet_story();
    $new_pet_picture = $petpost->get_pet_picture();
    
    $con=connect();
    $query = 'UPDATE dbpetpost SET petName="' . $new_pet_name . '" WHERE id = "' . $pet_id .'"';
    $result = mysqli_query($con,$query);
    if (!$result) {
        mysqli_rollback();
        mysqli_close($con);
        return false;
    }
    $query = 'UPDATE dbpetpost SET petType="' . $new_pet_type . '" WHERE id = "' . $pet_id .'"';
    $result = mysqli_query($con,$query);
    if (!$result) {
        mysqli_rollback();
        mysqli_close($con);
        return false;
    }
    $query = 'UPDATE dbpetpost SET petStory="' . $new_pet_story . '" WHERE id = "' . $pet_id .'"';
    $result = mysqli_query($con,$query);
    if (!$result) {
        mysqli_rollback();
        mysqli_close($con);
        return false;
    }
    $query = 'UPDATE dbpetpost SET petPicture="' . $new_pet_picture . '" WHERE id = "' . $pet_id .'"';
    $result = mysqli_query($con,$query);
    if (!$result) {
        mysqli_rollback();
        mysqli_close($con);
        return false;
    }
    mysqli_close($con);
    return true;
}

function retrieve_petpost_by_petid ($id) {
    $con=connect();
    $query = 'SELECT * FROM dbpetpost WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    if (!$result) {
        return null;
    }
    $result_row = mysqli_fetch_assoc($result);
    $the_petpost = make_a_petpost($result_row);
    mysqli_close($con);
    return $the_petpost;
    
}

function retrieve_petpost_by_petname ($name) {
    $petposts = array();
    if (!isset($name) || $name == "" || $name == null) return $petposts;
    $con=connect();
    $query = 'SELECT * FROM dbpetpost WHERE petName = "' . $name . '"';
    $result = mysqli_query($con,$query);
    while ($result_row = mysqli_fetch_assoc($result)) {
        $the_petpost = make_a_petpost($result_row);
        $petposts[] = $the_petpost;
    }
    mysqli_close($con);
    return $petposts;
}

function retrieve_petpost_by_pettype ($pettype) {
    $petposts = array();
    #if (!isset($pettype) || $pettype = "" || $pettype == null) return $petposts;
    $con=connect();
    $query = 'SELECT * FROM dbpetpost WHERE petType = "' . $pettype . '"';
    $result = mysqli_query($con,$query);
    while ($result_row = mysqli_fetch_assoc($result)) {
        $the_petpost = make_a_petpost($result_row);
        $petposts[] = $the_petpost;
    }
    mysqli_close($con);
    return $petposts;
}

function retrieve_all_petposts() {
    $petposts = array();
    $con=connect();
    $query = "SELECT * FROM dbPetPost";
    $result = mysqli_query($con,$query);
    if (!$result) {
        return null;
    }
    while ($result_row = mysqli_fetch_assoc($result)) {
        $the_petpost = make_a_petpost($result_row);
        $petposts[] = $the_petpost;
    }
    mysqli_close($con);
    return $petposts;
}
    
function make_a_petpost($result_row) {
    /*
     ($f, $l, $v, $a, $c, $s, $z, $p1, $p1t, $p2, $p2t, $e, $t,
     $screening_type, $screening_status, $st, $emp, $pos, $hours, $comm, $mot, $spe,
     $convictions, $av, $sch, $hrs, $bd, $sd, $hdyh, $notes, $pass)
     */
    $thePetPost = new PetPost(
        $result_row['id'],
        $result_row['owner_id'],
        $result_row['petName'],
        $result_row['petType'],
        $result_row['petStory'],
        $result_row['petPicture'],
        $result_row['approved'],
        $result_row['numHighlight']);
    return $thePetPost;
}

function retrieve_awaiting_approval() {
    $con=connect();
    $query = 'SELECT * FROM dbPetPost WHERE approved = 0 LIMIT 1';
    $result = mysqli_query($con,$query);
    if (!$result)
    {
        return null;
    }
    $result_row = mysqli_fetch_assoc($result);
    $the_petpost = make_a_petpost($result_row);
    return $the_petpost;
}


function update_approval($id)
{
    $con=connect();
    $query = 'SELECT * FROM dbpetpost WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $query = 'UPDATE dbpetpost SET approved = 1 WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return true;
}

function next_id() {
    $con=connect();
    $query = 'SELECT MAX(id) FROM dbpetpost';
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

function new_highlights()
{
    $petposts = array();
    $con=connect();
    $query = 'SELECT * FROM dbpetpost WHERE approved = 1 ORDER BY numHighlight LIMIT 3';
    $result = mysqli_query($con, $query);
    if (!$result)
    {
        return null;
    }
    while ($result_row = mysqli_fetch_assoc($result)) {
        $the_petpost = make_a_petpost($result_row);
        $petposts[] = $the_petpost;
    }
    mysqli_close($con);
    return $petposts;
}

function update_highlights($id)
{
    $con=connect();
    $query = 'SELECT * FROM dbpetpost WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $query = 'UPDATE dbpetpost SET numHighlight = numHighlight + 1 WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return true;
}
?>
