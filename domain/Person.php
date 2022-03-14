<?php
/*
 * Copyright 2013 by Allen Tucker. 
 * This program is part of RMHC-Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

/*
 * Created on Mar 28, 2008
 * @author Oliver Radwan <oradwan@bowdoin.edu>, Sam Roberts, Allen Tucker
 * @version 3/28/2008, revised 7/1/2015
 */
 class Person {
	private $id;         // id (unique key) = first_name . phone1
	private $first_name; // first name as a string
	private $last_name;  // last name as a string
	private $phone;   // primary phone -- home, cell, or work
	private $email;   // email address as a string
	private $password;     // password for calendar and database access: default = $id


	function __construct($f, $l, $v, $p, $e, 
			$screening_type, $st,
		    $av, $sch, $hrs, $pass) {
		$this->id = $f . $p1;
		$this->first_name = $f;
		$this->last_name = $l;
		$this->zip = $z;
		$this->phone = $p;
		$this->email = $e;
		if ($pass == "")
			$this->password = md5($this->id);
		else
			$this->password = $pass;  // default password == md5($id)
	}

	function get_id() {
		return $this->id;
	}

	function get_first_name() {
		return $this->first_name;
	}

	function get_last_name() {
		return $this->last_name;
	}

	function get_phone() {
		return $this->phone;
	}

	function get_email() {
		return $this->email;
	}

	function get_password() {
		return $this->password;
	}
}
?>