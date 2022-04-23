<?php
/*
 * Copyright 2015 by Adrienne Beebe, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
/*
 * A class to manage a sub call list for a particular shift
 * @version May 1, 2008
 * @author Maxwell Palmer
 */

class Adopter {

    private $id;   // id (unique key) = pet_name . phone
    private $name;
    private $phone;
    private $email;
    
    /*
     * makes a pet post object.  from either the db or from the generating form in edit shifts
     */

    function __construct($i, $n, $p, $e) {
        $this->id = $i;
        $this->name = $n;
        $this->phone = $p;
        $this->email = $e;
    }

    function get_id() {
        return $this->id;
    }

    function get_name() {
        return $this->name;
    }

    function get_phone() {
        return $this->phone;
    }

    function get_email() {
        return $this->email;
    }


    function set_name($name) {
        $this->name = $name;
    }

    function set_phone($phone) {
        $this->phone = $phone;
    }

    function set_email($email) {
        $this->email = $email;
    }
}

?>