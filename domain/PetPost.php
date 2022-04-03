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
    private $owner_id;
    private $petName;     // pet name as a string
    private $petType;      // pet type -- dog, cat, or other
    private $petStory;  // short story as a string
    private $petPicture;  // image of pet
    private $approved;

    /*
     * makes a pet post object.  from either the db or from the generating form in edit shifts
     */

    function __construct($i, $oi, $pn, $pt, $ps, $pp, $a) {
        $this->id = $i;
        $this->owner_id = $oi;
        $this->petName = $pn;
        $this->petType = $pt;
        $this->petStory = $ps;
        $this->petPicture = $pp;
        $this->approved = $a;
        
    }

    function get_id() {
        return $this->id;
    }

    function get_owner_id() {
        return $this->owner_id;
    }

    function get_pet_name() {
        return $this->petName;
    }

    function get_pet_type() {
        return $this->petType;
    }

    function get_pet_story() {
        return $this->petStory;
    }

    function get_pet_picture() {
        return $this->petPicture;
    }
    
    function get_approved() {
        return $this->approved;
    }

    function set_pet_name($pet_name) {
        $this->petName = $pet_name;
    }

    function set_pet_type($pet_type) {
        $this->petType = $pet_type;
    }

    function set_pet_story($pet_story) {
        $this->petStory = $pet_story;
    }

    function set_pet_picture($pet_picture) {
        $this->petPicture = $pet_picture;
    }
}

?>
