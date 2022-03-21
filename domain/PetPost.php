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

class PetPost {

    private $id;   // id (unique key) = pet_name . phone
    private $name;  // name as a string
    private $email;  // email address as a string
    private $phone:  // phone number as a string
    private $pet_name;     // pet name as a string
    private $pet_type;      // pet type -- dog, cat, or other
    private $pet_story;  // short story as a string
    private $pet_picture;  // image of pet

    /*
     * makes a pet post object.  from either the db or from the generating form in edit shifts
     */

    function __construct($id, $n, $e, $p, $pn, $pt, $ps, $pp) {
        $this->id = $id;
        $this->name = $n;
        $this->email = $e;
        $this->phone = $p;
        $this->pet_name = $pn;
        $this->pet_type = $pt;
        $this->pet_story = $ps;
        $this->pet_picture = $pp;
    }

    function get_id() {
        return $this->id;
    }

    function get_name() {
        return $this->name;
    }

    function get_email() {
        return $this->email;
    }

    function get_phone() {
        return $this->phone;
    }

    function get_pet_name() {
        return $this->pet_name;
    }

    function get_pet_type() {
        return $this->pet_type;
    }

    function get_pet_story() {
        return $this->pet_story;
    }

    function get_pet_picture() {
        return $this->pet_picture;
    }

    function set_name($name) {
        $this->name = $name;
    }

    function set_email($email) {
        $this->email = $email;
    }

    function set_pet_name($pet_name) {
        $this->pet_name = $pet_name;
    }

    function set_pet_type($pet_type) {
        $this->pet_type = $pet_type;
    }

    function set_pet_story($pet_story) {
        $this->pet_story = $pet_story;
    }

    function set_pet_picture($pet_picture) {
        $this->pet_picture = $pet_picture;
    }

}

?>
