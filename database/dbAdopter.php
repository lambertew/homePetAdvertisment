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

function retrieve_adopter_by_name ($name) {
    $con=connect();
    $query = 'SELECT * FROM dbadopter WHERE name="' . $name . '" LIMIT 1';
    $result = mysqli_query($con,$query);
    if (!$result)
    {
        return null;
    }
    $result_row = mysqli_fetch_assoc($result);
    $adopter = create_adopter($result_row);
    return $adopter;
}

function create_adopter ($result_row) {
    $adopter = new Adopter(
        $result_row['id'],
        $result_row['name'],
        $result_row['phone'],
        $result_row['email']);
    return $adopter;
}


?>
